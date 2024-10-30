
<!--// models/CouponModel.php-->
<?php
require_once 'BaseModel.php';

class CouponModel extends BaseModel {
    public function __construct() {
        parent::__construct('coupons');
    }

    public function getTotalCoupons() {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) AS total FROM coupons");
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }

    public function getAllCoupons() {
        $stmt = $this->pdo->prepare("SELECT * FROM coupons ORDER BY updated_at DESC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function toggleStatus($id, $status) {
        $stmt = $this->pdo->prepare("UPDATE coupons SET status = :status WHERE id = :id");
        return $stmt->execute(['status' => $status, 'id' => $id]);
    }
}

