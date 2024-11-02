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

        if ($productId) {
            $product = $this->productModel->find($productId);

            if ($product) {
                $this->cartModel->addToCart($product);
                header("Location: /customers/cart");
                exit();
            }
        }

        header("Location: /customers/index");
        exit();
    }

    public function index()
    {
    $cartItems = $this->cartModel->getCartItems();
    $dir = "/gift_shop/public/images/product/default/";
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

        setcookie('discount', $discountAmount, time() + (86400 * 30), "/"); 

       
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
