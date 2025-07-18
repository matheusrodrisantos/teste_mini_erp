<?php
namespace App\Controller;

use App\Controller\Controller;
use App\Model\Product;

class ProductController extends BaseController implements Controller
{
    public function index()
    {
        $this->render('product/product.twig');
    }

    public function show($id)
    {
    }

    public function create()
    {

    }

    public function store($data = [])
    {

        $product = new Product(name: $_POST['name'], 
        price: $_POST['price']);

        print_r($product);
    }

    public function edit($id)
    {

    }

    public function update($id, $data)
    {

    }

    public function delete($id)
    {

    }
}
