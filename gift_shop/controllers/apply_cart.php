<?php
header('Content-Type: application/json');

require '../config/db.php';
require '../models/ProductModel.php';
require '../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

// Get the product ID from JSON input or URL query (for testing in the browser)
$data = json_decode(file_get_contents('php://input'), true);
$productId = $data['product_id'] ?? $_GET['product_id'] ?? null;

if (!$productId) {
    echo json_encode(['success' => false, 'message' => 'Product ID is required.']);
    exit;
}

// Initialize database and product model
$db = new db();
$pdo = $db->getConnection();
$productModel = new ProductModel();

// Fetch product details by ID
$product = $productModel->getProductById($productId);

// Set placeholder image if no image URL is found in the database
$product['image_url'] = $product['image_url'] ?? 'gift_shop/public/images/icons/icon_about1.jpg'; // Adjust to your actual placeholder path

if ($product) {
    echo json_encode(['success' => true, 'product' => $product]);
} else {
    echo json_encode(['success' => false, 'message' => 'Product not found.']);
}
