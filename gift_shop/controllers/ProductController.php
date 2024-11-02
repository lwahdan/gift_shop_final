<?php
// File: controllers/ProductController.php

require_once 'BaseController.php';

class ProductController extends Controller
{
    private $productModel;

    public function __construct()
    {
        // Load the Product model using the base Controller's model method
        $this->productModel = $this->model('Product');
    }

    public function index()
    {
        // Retrieve all products from the model
        $products = $this->productModel->all();
        
        // Load the index view and pass products as data
        $this->view('products/index', ['products' => $products]);
    }

    public function home()
    {
        // Retrieve all products from the model
        $products = $this->productModel->all();
        
        // Load the index view and pass products as data
        $this->view('customers/index', ['products' => $products]);
    }

    public function details()
{
    // Get the product ID from the query string
    $productId = isset($_GET['id']) ? $_GET['id'] : null;

    if ($productId) {
        $product = $this->productModel->find($productId);

        if ($product) {
            $dir = "/path/to/your/image/directory/";
            $this->view('products/details', [
                'product' => $product,
                'dir' => $dir,
                'productId' => $productId
            ]);
        } else {
            header("Location: /products");
            exit();
        }
    } else {
        header("Location: /products");
        exit();
    }
}

    
}
?>
