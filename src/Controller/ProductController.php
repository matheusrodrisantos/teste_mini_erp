<?php

namespace App\Controller;

use App\Controller\Controller;
use App\Model\Product;
use App\Repository\ProductRepository;
use Twig\Environment;

class ProductController extends BaseController implements Controller
{

    public function __construct(
        Environment $twig,
        private ProductRepository $productRepository
    ) {
        $this->twig = $twig;
    }

    public function index()
    {
        $this->productRepository->showProducts();   
        $this->render('product/product.twig');
    }

    public function show($id) {}

    public function create() {}

    public function store($data = [])
    {
        $product = new Product(
            name: $_POST['name'],
            price: $_POST['price']
        );

        $this->productRepository->save($product);

        header('Location: /product');
    }

    public function edit($id) {}

    public function update($id, $data) {}

    public function delete($id) {}
}
