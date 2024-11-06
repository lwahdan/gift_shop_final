<?php
require_once 'BaseModel.php';


class OrderModel extends BaseModel
{
    public function __construct()
    {
        parent::__construct('orders'); // Specifies 'orders' table for BaseModel
    }

    // Additional methods specific to orders can be added here
    public function getTotalUsers() {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) AS total FROM orders");
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }

    public function toggleStatus($id, $status) {
        $stmt = $this->pdo->prepare("UPDATE users SET status = :status WHERE id = :id");
        return $stmt->execute(['status' => $status, 'id' => $id]);
    }

}
