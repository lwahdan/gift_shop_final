<?php

require_once __DIR__.'/../models/Order.php';

class OrderController {
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
}
?>
