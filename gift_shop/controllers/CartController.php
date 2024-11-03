<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
require_once 'BaseController.php';
require_once __DIR__ . '/../models/ProductModel.php';
require_once __DIR__ . '/../models/CartModel.php';
require_once __DIR__ . '/../models/CouponModel.php';

class CartController extends Controller
{
    private $cartModel;
    private $productModel;

    public function __construct()
    {
        $this->cartModel = new CartModel();
        $this->productModel = new ProductModel();
    }

    public function add()
{
    $productId = $_POST['product_id'] ?? null;
    $quantity = $_POST['quantity'] ?? 1; // Default quantity to 1 if not specified

    $cart = isset($_COOKIE['cart']) ? json_decode($_COOKIE['cart'], true) : [];
    $productModel = new ProductModel();
    $product = $productModel->find($productId);

    if ($product) {
        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $quantity;
        } else {
            $cart[$productId] = [
                'id' => $productId,
                'name' => $product['product_name'],
                'price' => $product['price'],
                'quantity' => $quantity,
                'image_url' => $product['image_url']
            ];
        }

        // Update the cart cookie
        setcookie('cart', json_encode($cart), time() + 86400, "/"); // 1 day expiration

        // Return JSON response for AJAX
        echo json_encode(['success' => true, 'cartCount' => count($cart)]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Product not found']);
    }

    exit(); // Ensure no further output is sent
    }

    public function update()
{
    $data = json_decode(file_get_contents("php://input"), true);
    $productId = $data['product_id'] ?? null;
    $quantity = $data['quantity'] ?? 1;

    // Get the current cart from the cookie
    $cart = isset($_COOKIE['cart']) ? json_decode($_COOKIE['cart'], true) : [];

    // Update quantity if the item is in the cart
    if (isset($cart[$productId])) {
        $cart[$productId]['quantity'] = $quantity;

        // Save the updated cart back to the cookie
        setcookie('cart', json_encode($cart), time() + 86400, "/");

        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Product not found in cart']);
    }

    exit();
}



    public function index()
    {
    $cartItems = $this->cartModel->getCartItems();
    $dir = "../public/images/product/";
    $this->view('customers/cart', ['cartItems' => $cartItems, 'dir' => $dir]);
    }


    public function remove()
    {
        $productId = $_POST['product_id'] ?? null;

        if ($productId) {
            $this->cartModel->removeFromCart($productId);
        }

        header("Location: /customers/cart");
        exit();
    }

    public function calculateTotals()
    {
    $subtotal = $this->cartModel->calculateSubtotal();
    $shipping = 50.00;
    $total = $subtotal + $shipping;

    $totals = [
        'subtotal' => $subtotal,
        'shipping' => $shipping,
        'total' => $total,
    ];

    header('Content-Type: application/json');
    echo json_encode($totals);
    exit();
    }

    public function applyCoupon()
{
    $couponCode = $_POST['coupon_code'] ?? '';
    $couponModel = new CouponModel();
    $coupon = $couponModel->getCouponByCode($couponCode);

    if ($coupon) {
      
        $subtotal = $this->cartModel->calculateSubtotal();
        $discountPercentage = (float) rtrim($coupon['discount_value'], '%');
        $discountAmount = $subtotal * ($discountPercentage / 100);

        setcookie('discount', $discountAmount, time() + 300, "/"); 

       
        $shipping = 50.00;
        $newTotal = $subtotal - $discountAmount + $shipping;

      
        $response = [
            'success' => true,
            'message' => 'Coupon applied successfully',
            'subtotal' => $subtotal,
            'discount' => $discountAmount,
            'newTotal' => $newTotal,
        ];
    } else {
       
        setcookie('discount', '', time() - 3600, "/"); 

     
        $response = [
            'success' => false,
            'message' => 'Invalid or expired coupon code',
        ];
    }


    header('Content-Type: application/json');
    echo json_encode($response);
    exit();
}

}
