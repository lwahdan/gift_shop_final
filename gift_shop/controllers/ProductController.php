<?php
// File: controllers/ProductController.php

require_once 'BaseController.php';

class ProductController extends Controller
{
    private $productModel;
    private $reviewModel;

    public function __construct()
    {
        // Load the Product model and Review model
        $this->productModel = $this->model('Product');
        $this->reviewModel = $this->model('Review');
    }

    public function index()
    {
        $products = $this->productModel->all();
        $this->view('products/index', ['products' => $products]);
    }

    public function getProductsByCategory($categoryId) 
    {
        $products = $this->productModel->getProductsByCategory($categoryId);
        $this->view('products/index', ['products' => $products]); 
    }

    public function search() 
    {
        $products = $this->productModel->searchProductsByName($_GET['search']);
        $this->view('products/index', ['products' => $products]); 
    }

    public function home()
    {
        $products = $this->productModel->all();
        $this->view('customers/index', ['products' => $products]);
    }

    public function details()
    {
        $productId = $_GET['id'] ?? null;

        if ($productId) {
            $product = $this->productModel->find($productId);

            if ($product) {
                // Fetch reviews associated with this product
                $reviews = $this->reviewModel->getReviewsByProductId($productId);

                // Define the image directory path
                $dir = "../public/images/product/";

                // Load the product details view, passing product, reviews, and directory as data
                $this->view('products/details', [
                    'product' => $product,
                    'reviews' => $reviews,
                    'product_id' => $productId, // Ensure product ID is passed
                    'dir' => $dir
                ]);
            } else {
                header("Location: /products"); // Redirect if product not found
                exit();
            }
        } else {
            header("Location: /products"); // Redirect if no product ID is provided
            exit();
        }
    }
}
?>
