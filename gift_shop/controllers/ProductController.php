<?php
// File: controllers/ProductController.php

require_once 'BaseController.php';
require_once __DIR__ . '/../models/Category.php';
require_once __DIR__ . '/../controllers/CategoryController.php';

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

    public function getProductsByCategory($categoryId) {
        $products = $this->productModel->getProductsByCategory($categoryId);
        $this->view('products/index', ['products' => $products]); 
    }

        public function search() {
        $products = $this->productModel->searchProductsByName($_GET['search']);
        $this->view('products/index', ['products' => $products]); 
    }

    public function home()
    {
        // Retrieve all products
        $products = $this->productModel->all();
    
        // Retrieve all categories via CategoryController
        $categoryController = new CategoryController();
        $categories = $categoryController->getCategories();
    
        // Load the main index view with both products and categories
        $this->view('customers/index', [
            'products' => $products,
            'categories' => $categories
        ]);
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
                $dir = "../public/images/product/";

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
