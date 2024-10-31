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
        // Get the product ID from the URL
        $productId = $_GET['id'] ?? null;

        if ($productId) {
            // Fetch the product using the find method in the Product model
            $product = $this->productModel->find($productId);

            if ($product) {
                // Define the image directory path
                $dir = "/path/to/your/image/directory/";

                // Load the product details view, passing product and directory as data
                $this->view('products/details', ['product' => $product, 'dir' => $dir]);
            } else {
                // Redirect or display an error if the product is not found
                header("Location: /products");
                exit();
            }
        } else {
            // Redirect to the products list if no ID is provided
            header("Location: /products");
            exit();
        }
    }
}
?>
