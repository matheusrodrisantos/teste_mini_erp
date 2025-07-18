<?php
namespace App\Repository;

use App\Model\Product;
use Doctrine\DBAL\Connection;

class ProductRepository{
    private Connection $conn;

    public function __construct(Connection $conn)
    {
        $this->conn = $conn;
    }
    
    public function save(Product $product): void
    {
        $this->conn->insert('products', [
            'name'  => $product->getName(),
            'price' => $product->getPrice(),
        ]);
    }
}