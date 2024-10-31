
<?php
require_once 'BaseModel.php';

class UserModel extends BaseModel {
    public function __construct() {
        parent::__construct('users');
    }

    public function getTotalUsers() {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) AS total FROM users");
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }

    public function toggleStatus($id, $status) {
        $stmt = $this->pdo->prepare("UPDATE users SET status = :status WHERE id = :id");
        return $stmt->execute(['status' => $status, 'id' => $id]);
    }
}
