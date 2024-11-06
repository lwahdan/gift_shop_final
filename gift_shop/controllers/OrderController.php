<?php

require_once __DIR__.'/../models/Order.php';
require_once __DIR__.'/../models/Product.php';


class OrderController extends Controller{
    private $orderModel;
    private $productModel;

    public function __construct() {
        $this->orderModel = new Order('orders');
        $this->productModel = new Product('products');
    }

    // Display orders and handle actions

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
    
        // Add each item to order_items and update stock
        foreach ($cartData as $item) {
            $orderItemData = [
                'order_id' => $orderId,
                'product_id' => $item['id'],
                'quantity' => $item['quantity'],
                'price' => $item['price']
            ];
            $this->orderModel->addOrderItem($orderItemData);
    
            // Update product stock
            $productId = $item['id'];
            $orderedQuantity = $item['quantity'];
    
            // Fetch current stock from product model
            $currentStock = $this->productModel->getStock($productId);
            if ($currentStock < $orderedQuantity) {
                echo "Not enough stock for product ID: " . $productId;
                return;
            }
    
            // Calculate new stock and update it
            $newStock = $currentStock - $orderedQuantity;
            $this->productModel->updateStock($productId, $newStock);
        }
    
        // Clear cart and discount cookies
        setcookie("cart", "", time() - 3600, "/");
        setcookie("discount", "", time() - 3600, "/");
    
        // Redirect to confirmation page
        header("Location: /home");
        exit();
    }
    

}
?>
