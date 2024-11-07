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

    public function index() {
        // Retrieve filter parameters from the GET request
        $category = isset($_GET['category']) ? $_GET['category'] : null;
        $price_min = isset($_GET['price_min']) ? $_GET['price_min'] : null;
        $price_max = isset($_GET['price_max']) ? $_GET['price_max'] : null;
        $sort = isset($_GET['sort']) ? $_GET['sort'] : null;

        // Fetch products based on the filters using the model
        $products = $this->productModel->getFilteredProducts($category, $price_min, $price_max, $sort);
        
        // Fetch categories for the filter dropdown (assuming a `getCategories` method exists in the model)
        $categories = $this->categoryModel->all();

        // Pass products and categories to the view
        $this->view('products/index', [
            'products' => $products,
            'categories' => $categories
        ]);
        $products = $this->productModel->getAllProducts(); // or your specific query to fetch products

        // For each product, fetch the average rating
        foreach ($products as &$product) {
            $product['average_rating'] = $this->productModel->getProductAverageRating($product['id']);
        }
    
        // Pass products to the view
        $this->view('home/index', ['products' => $products]);
    }



    public function getProductsByCategory($categoryId) {
        // Retrieve products by category ID
        $products = $this->productModel->getProductsByCategory($categoryId);
    
        // Retrieve category name
        $categoryModel = new Category();
        $category = $categoryModel->find($categoryId);
        $categoryName = $category ? $category['category_name'] : 'Products';
    
        // Pass both products and category name to the view
        $this->view('products/index', [
            'products' => $products,
            'categoryName' => $categoryName
        ]);
    }
    

    public function search() 
    {
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


    public function details() {
        $productId = $_GET['id'] ?? null;
    
        if ($productId) {
            // Fetch product details
            $product = $this->productModel->find($productId);
    
            if ($product) {
                // Fetch reviews for this product
                $reviews = $this->reviewModel->getReviewsByProductId($productId);
    
                // Get average rating
                $averageRating = $this->reviewModel->getAverageRating($productId);
    
                // Pass to view
                $this->view('products/details', [
                    'product' => $product,
                    'reviews' => $reviews,
                    'averageRating' => $averageRating
                ]);
            } else {
                header("Location: /products");
                exit();
            }
        } else {
            header("Location: /products");
            exit();
        }}
    

    public function show($categoryId) {
        if (!isset($_SESSION["admin_id"])) {
            header('Location: /admin/login');
            exit();
        }
        // Retrieve products by category ID
        $products = $this->productModel->getProductsByCategory($categoryId);

        // Load the view for showing products in a category
        $this->view('admin/categories/show', ['products' => $products]);
    }
    
    public function category($category_id) {
        // Fetch products for the given category
        $products = $this->productModel->getProductsByCategory($category_id); // Adjust to fetch products for category
    
        // For each product, fetch the average rating
        foreach ($products as &$product) {
            $product['average_rating'] = $this->productModel->getProductAverageRating($product['id']);
        }
    
        // Pass products and category to the view
        $this->view('category/index', ['products' => $products, 'category_id' => $category_id]);
    }
    
}
?>
