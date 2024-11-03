<?php

require_once __DIR__.'/../models/Order.php';


class OrderController extends Controller{
    private $orderModel;

    public function __construct() {
        $this->orderModel = new Order('orders');
    }

    // Display orders and handle actions
    public function manageOrders($userId) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Handle form submissions
            if (isset($_POST['action'])) {
                switch ($_POST['action']) {
                    case 'cancel':
                        $this->orderModel->cancelOrder($_POST['order_id']);
                        break;
                    case 'update':
                        $this->orderModel->updateStatus($_POST['order_id'], $_POST['status']);
                        break;
                    case 'create':
                        $this->orderModel->create($_POST); // Pass the entire $_POST array for creating an order
                        break;
                }
            }
        }
        $orders = $this->orderModel->getOrdersByUser($userId);
        require 'order_manage.php'; // Load a single view for managing orders
    }

public function submitOrder()
{
    // Retrieve cart data from cookies
    $cartData = isset($_COOKIE['cart']) ? json_decode($_COOKIE['cart'], true) : [];
    $couponDiscount = isset($_COOKIE['discount']) ? $_COOKIE['discount'] : 0;

    if (empty($cartData)) {
        echo "Cart is empty.";
        return;
    }

    // Calculate the total price
    $subtotal = 0;
    foreach ($cartData as $item) {
        $subtotal += $item['price'] * $item['quantity'];
    }
    $totalPrice = $subtotal - $couponDiscount + 50;

    // Retrieve shipping and address details from GET request
    $shippingAddress = $_GET['shipping_address'];
    $city = $_GET['city'];
    $postalCode = $_GET['postal_code'];
    $country = $_GET['country'];

    // Create the main order
    $orderData = [
        'user_id' => $_SESSION['user_id'] ?? null,
        'total_price' => $totalPrice,
        'status' => 'Pending',
        'shipping_address' => $shippingAddress,
        'city' => $city,
        'postal_code' => $postalCode,
        'country' => $country,
    ];
    $orderId = $this->orderModel->create($orderData);

    // Add each item to order_items
    foreach ($cartData as $item) {
        $orderItemData = [
            'order_id' => $orderId,
            'product_id' => $item['id'],
            'quantity' => $item['quantity'],
            'price' => $item['price']
        ];
        $this->orderModel->addOrderItem($orderItemData);
    }

    // Clear cart and discount cookies
    setcookie("cart", "", time() - 3600, "/");
    setcookie("discount", "", time() - 3600, "/");


    // Redirect to confirmation page
    $this->view('customers/index');
}

}
?>
