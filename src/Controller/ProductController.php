<?php 

namespace App\Controller;

use App\Controller\Controller;


class ProductController extends BaseController
{
    public function index()
    {

        echo "asdda";
         $this->render('product.twig', [
            'title' => 'Bem-vindo ao Mini ERP!',
        ]);
    }

    public function show($id)
    {   
    }

    public function create()
    {
        
    }

    public function store($data)
    {
        
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