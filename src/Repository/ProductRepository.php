<?php

namespace App\Repository;

use App\Model\Product;
use Doctrine\DBAL\Connection;

class ProductRepository
{

    public function __construct(private Connection $conn) {}

    public function showTables(): array
    {
        $result = $this->conn->executeQuery('SHOW TABLES');
        return $result->fetchFirstColumn();
    }

    public function showProducts(): array
    {
        $stmt = $this->conn->executeQuery('select * from products');
        $results = $stmt->fetchAllAssociative();

        $products = [];
        foreach ($results as $result) {

            $product = new Product(
                $result['name'],
                $result['price']
            );
            $product->setId($result['id']);

            $products[] = $product;
        }

        return $products;
    }

    public function save(Product $product): void
    {
        $this->conn->insert('products', [
            'name'  => $product->getName(),
            'price' => $product->getPrice(),
        ]);
    }
}
