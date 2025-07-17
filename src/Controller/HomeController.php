<?php
namespace App\Controller;

class HomeController extends BaseController 
{
    public function index(): void
    {     
        $this->render('home.twig', [
            'title' => 'Bem-vindo ao Mini ERP!',
        ]);
    }
}
