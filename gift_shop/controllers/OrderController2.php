<?php

class OrderController2 extends Controller
{
    private $orderModel;

    public function __construct()
    {
        $this->orderModel = $this->model('OrderModel');
    }

    // Display all orders
    public function index()
    {
        // Get all orders from the database
        $orders = $this->orderModel->all();

        // Load the view with orders data
        $this->view('admin/orders/index', ['orders' => $orders]);
    }

    // Show a specific order
    public function show($id)
    {
        // Get the order by ID
        $order = $this->orderModel->find($id);

        if (!$order) {
            // Handle order not found
            header('Location: /admin/orders');
            exit();
        }

        // Load the view with order data
        $this->view('admin/orders/show', ['order' => $order]);
    }

    // Display edit form for an order
    public function edit($id)
    {
        // Get the order by ID
        $order = $this->orderModel->find($id);

        if (!$order) {
            // Handle order not found
            header('Location: /admin/orders');
            exit();
        }

        // Load the edit view with order data
        $this->view('admin/orders/edit', ['order' => $order]);
    }

    // Update an order
    public function update($id)
    {
        // Validate and sanitize POST data
        $data = [
            'user_id' => filter_input(INPUT_POST, 'user_id', FILTER_SANITIZE_NUMBER_INT),
            'total_price' => filter_input(INPUT_POST, 'total_price', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION),
            'status' => filter_input(INPUT_POST, 'status', FILTER_SANITIZE_SPECIAL_CHARS),
            'shipping_address' => filter_input(INPUT_POST, 'shipping_address', FILTER_SANITIZE_SPECIAL_CHARS),
            'city' => filter_input(INPUT_POST, 'city', FILTER_SANITIZE_SPECIAL_CHARS),
            'postal_code' => filter_input(INPUT_POST, 'postal_code', FILTER_SANITIZE_SPECIAL_CHARS),
            'country' => filter_input(INPUT_POST, 'country', FILTER_SANITIZE_SPECIAL_CHARS)
        ];

        // Validate required fields
        if (empty($data['user_id']) || empty($data['total_price']) || empty($data['status'])) {
            // Handle validation error
            $_SESSION['error'] = 'All required fields must be filled out';
            header("Location: /admin/orders/edit/$id");
            exit();
        }

        // Update the order
        if ($this->orderModel->update($id, $data)) {
            $_SESSION['success'] = 'Order updated successfully';
        } else {
            $_SESSION['error'] = 'Error updating order';
        }

        // Redirect back to orders list
        header('Location: /admin/orders');
        exit();
    }

    // Delete an order
    public function delete($id)
    {
        // Get the order first to check if it exists
        $order = $this->orderModel->find($id);

        if (!$order) {
            $_SESSION['error'] = 'Order not found';
            header('Location: /admin/orders');
            exit();
        }

        // Delete the order
        if ($this->orderModel->delete($id)) {
            $_SESSION['success'] = 'Order deleted successfully';
        } else {
            $_SESSION['error'] = 'Error deleting order';
        }

        // Redirect back to orders list
        header('Location: /admin/orders');
        exit();
    }

    // Get total number of orders
    public function getTotalOrders()
    {
        return $this->orderModel->getTotalUsers();
    }
}