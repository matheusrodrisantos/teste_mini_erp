<?php
namespace App\Controller;

use App\Controller\Controller;
use App\Repository\ProductRepository;
use App\Service\ProductService;
use Exception;
use Twig\Environment;

class ProductController extends BaseController implements Controller
{

    public function __construct(
        Environment $twig,
        private ProductRepository $productRepository,
        private ProductService $productService
    ) {
        $this->twig = $twig;
    }

    public function index()
    {
        $products = $this->productRepository->showProducts();
        $msg      = $_SESSION['msg'] ?? null;
        unset($_SESSION['msg']);

        $this->render('product/product.twig',
            ['products' => $products, 'msg' => $msg]
        );
    }

    public function show($id)
    {}

    public function create()
    {}

    public function store($data = [])
    {
        try {
            $this->productService->saveProduct($_POST);
            $_SESSION['msg'] = ['type' => 'success', 'message' => 'Produto cadastrado com sucesso!'];
            header('Location: /product');
            exit;
        } catch (Exception $e) {
            $_SESSION['msg'] = ['type' => 'error', 'message' => 'Erro ao cadastrar produto: ' . $e->getMessage()];
            header('Location: /product');
            exit;
        }
    }

    public function edit($id)
    {}

    public function update()
    {
        try {
            $product = $this->productService->updateProduct($_POST);
            header("Content-Type: application/json");
            http_response_code(200);
            $response = [
                'success' => true,
                'message' => json_encode($product),
            ];
            echo json_encode($response);
        } catch (Exception $e) {
            http_response_code(400);
            $response = [
                'success' => true,
                'error' => json_encode($e->getMessage()),
            ];
            echo json_encode($response);
        }

        exit;
    }

    public function delete($id)
    {}
}
