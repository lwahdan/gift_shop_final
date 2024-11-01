<?php
// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Set header for JSON response
header('Content-Type: application/json');

// Load .env
require '../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

// Initialize database connection
require '../config/db.php';
$db = new db();
$pdo = $db->getConnection();

// Get the product ID from the request
$data = json_decode(file_get_contents('php://input'), true);
$productId = $data['product_id'] ?? $_GET['product_id'] ?? null;

if (!$productId) {
    // Respond with error if no product ID is provided
    echo json_encode(['success' => false, 'message' => 'Product ID is required.']);
    exit;
}

// Fetch product details
require '../models/ProductModel.php';
$productModel = new ProductModel();
$product = $productModel->getProductById($productId);

if ($product) {
    // Send the product details as JSON
    echo json_encode(['success' => true, 'product' => $product]);
} else {
    // Respond with error if the product is not found
    echo json_encode(['success' => false, 'message' => 'Product not found.']);
}
