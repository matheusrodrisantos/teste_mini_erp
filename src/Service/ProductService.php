<?php
namespace App\Service;

use App\Model\Inventory;
use App\Model\Product;
use App\Model\Variation;
use App\Repository\ProductRepository;

class ProductService
{

    public function __construct(private ProductRepository $productRepository)
    {}

    public function updateProduct(array $data): Product
    {
        $product = new Product(name: $data['name'],
            price: $data['price']
        );
        $product->setId($data['price']);

        $stockQtd  = $data['stock'];
        $variation = new Variation($data['variation'], $product);
        $variation->setId($data['variation_id']);
        $inventory = new Inventory($variation, $stockQtd);
        $inventory->setId($data['stock_id']);
        $variation->setIventory($inventory);
        $product->addVariation($variation);

        $this->productRepository->update($product);

        return $product;
    }

    public function saveProduct(array $data): Product
    {

        $product = new Product(
            name: $data['name'],
            price: $data['price']
        );

        if (isset($data['variation'])) {
            $variations = $data['variation'];
            $stockQtd   = $data['stock'];

            foreach ($variations as $index => $var) {
                $qtd       = $stockQtd[$index];
                $variation = new Variation($var, $product);
                $inventory = new Inventory($variation, $qtd);
                $variation->setIventory($inventory);
                $product->addVariation($variation);
            }
            $this->productRepository->save($product);

            return $product;
        }

        $stockQtd  = $_POST['stock'];
        $variation = new Variation('PADRÃO', $product);
        $inventory = new Inventory($variation, $stockQtd);
        $variation->setIventory($inventory);
        $product->addVariation($variation);
        $this->productRepository->save($product);

        return $product;
    }
}
