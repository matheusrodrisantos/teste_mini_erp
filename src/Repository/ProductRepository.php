<?php
namespace App\Repository;

use App\Model\Product;
use Doctrine\DBAL\Connection;

class ProductRepository
{

    public function __construct(private Connection $conn)
    {}

    public function showTables(): array
    {
        $result = $this->conn->executeQuery('SHOW TABLES');
        return $result->fetchFirstColumn();
    }

    public function update(Product $product)
    {
        $this->conn->beginTransaction();
        try {
            $this->conn->update('products', [
                'name'  => $product->getName(),
                'price' => $product->getPrice(),
            ], ['id' => $product->getId()]);

            $variations = $product->getVariations();

            foreach ($variations as $variation) {
                $this->conn->update('variations', [
                    'description' => $variation->getDescription()
                ],['id'=>$variation->getId()]);

                $inventory   = $variation->getInventory();
                $this->conn->update('inventory', [
                    'variation_id' => $variation->getId(),
                    'quantity'     => $inventory->getQuantity(),
                ],['id'=>$inventory->getId()]);
            }

            $this->conn->commit();
        } catch (\Exception $e) {
            $this->conn->rollBack();
            throw $e; 
        }

    }



    public function showProducts(): array
    {
        $stmt = $this->conn->executeQuery("
            SELECT p.id,p.name,p.price,
                v.description as variation,
                v.id as variation_id,
                v.product_id,
                i.id as stock_id,
                i.quantity as stock
            FROM products p
            INNER JOIN variations v on p.id =v.product_id
            INNER JOIN inventory i on i.variation_id =v.id"
        );

        return $stmt->fetchAllAssociative();
    }

    public function save(Product $product): void
    {
        $this->conn->beginTransaction();
        try {
            $this->conn->insert('products', [
                'name'  => $product->getName(),
                'price' => $product->getPrice(),
            ]);

            $productId = (int) $this->conn->lastInsertId();

            $variations = $product->getVariations();

            foreach ($variations as $variation) {
                $this->conn->insert('variations', [
                    'description' => $variation->getDescription(),
                    'product_id'  => $productId,
                ]);

                $variationId = (int) $this->conn->lastInsertId();
                $inventory   = $variation->getInventory();
                $this->conn->insert('inventory', [
                    'variation_id' => $variationId,
                    'quantity'     => $inventory->getQuantity(),
                ]);
            }

            $this->conn->commit();

        } catch (\Exception $e) {
            $this->conn->rollBack();
            throw $e; 
        }

    }
}
