<?php
header('Content-Type: application/json');

require '../config/db.php';
require '../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

// Fetch the coupon code from JSON input or URL parameter for testing in the browser
$data = json_decode(file_get_contents('php://input'), true);
$couponCode = $data['code'] ?? $_GET['code'] ?? null;

if (!$couponCode) {
    echo json_encode(['success' => false, 'message' => 'Coupon code is required.']);
    exit;
}

// Initialize database connection
$db = new db();
$pdo = $db->getConnection();

try {
    // Check for a valid coupon
    $stmt = $pdo->prepare("SELECT * FROM coupons WHERE code = :code AND is_active = 1 AND expiration_date >= CURDATE()");
    $stmt->execute(['code' => $couponCode]);
    $coupon = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($coupon) {
        // Prepare a response with discount details
        echo json_encode([
            'success' => true,
            'discount_value' => $coupon['discount_value']
        ]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid or expired coupon.']);
    }
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Error processing the coupon.']);
}
