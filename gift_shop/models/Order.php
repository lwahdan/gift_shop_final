<?php

require_once 'BaseModel.php';

class Order extends BaseModel {
    protected $table = 'orders';

    // Retrieve all orders placed by a specific user
    public function getOrdersByUser($userId) {
        $sql = "SELECT * FROM {$this->table} WHERE user_id = :user_id ORDER BY order_date DESC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Retrieve the status of a specific order by order ID
    public function getOrderStatus($orderId) {
        $sql = "SELECT status FROM {$this->table} WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $orderId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)['status'] ?? null;
    }

    // Cancel an order by setting its status to 'cancelled'
    public function cancelOrder($orderId) {
        $sql = "UPDATE {$this->table} SET status = 'cancelled' WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $orderId, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Update the status of an order (e.g., from 'pending' to 'shipped')
    public function updateStatus($orderId, $newStatus) {
        $sql = "UPDATE {$this->table} SET status = :status WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':status', $newStatus, PDO::PARAM_STR);
        $stmt->bindParam(':id', $orderId, PDO::PARAM_INT);
        return $stmt->execute();
    }
    public function addOrderItem($data)
    {
        $orderItemModel = new BaseModel('order_items');
        $orderItemModel->create($data);
    }
}
?>
