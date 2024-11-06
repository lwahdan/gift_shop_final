<?php
// File: controllers/ProductController.php

require_once 'BaseController.php';
require_once __DIR__ . '/../models/Category.php';
require_once __DIR__ . '/../controllers/CategoryController.php';

class ProductController extends Controller
{
    private $productModel;
    private $reviewModel;
    private $categoryModel;

    public function __construct()
    {
        // Load the Product model and Review model
        $this->productModel = $this->model('Product');
        $this->reviewModel = $this->model('Review');
        $this->categoryModel = $this->model('Category');
    }





    public function home()
    {
        // Get all products
        $products = $this->productModel->all();

        // Get all categories
        $categories = $this->categoryModel->all();

        // Load the view with both products and categories
        $this->view('customers/index', [
            'products' => $products,
            'categories' => $categories
        ]);
    }

    public function getProductsByCategory($categoryId)
    {
        // Get the products for this category
        $products = $this->productModel->getProductsByCategory($categoryId);

        // Get all categories for the navigation menu
        $categories = $this->categoryModel->all();

        // Get the current category name
        $currentCategory = $this->categoryModel->find($categoryId);
        $categoryName = $currentCategory ? $currentCategory['category_name'] : 'Products';

        // Pass everything to the view
        $this->view('products/index', [
            'products' => $products,
            'categories' => $categories,
            'categoryName' => $categoryName
        ]);
    }

    

    public function search() 
    {
        $products = $this->productModel->searchProductsByName($_GET['search']);
        $this->view('products/index', ['products' => $products]); 
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
    public function show($categoryId) {
        if (!isset($_SESSION["admin_id"])) {
            header('Location: /admin/login');
            exit();
        }
        // Retrieve products by category ID
        $products = $this->productModel->find($categoryId);

        // Load the view for showing products in a category
        $this->view('admin/categories/show', ['products' => $products]);
    }

}
?>
