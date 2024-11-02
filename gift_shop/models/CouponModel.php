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

    public function toggleStatus($id, $status) {
        $stmt = $this->pdo->prepare("UPDATE coupons SET status = :status WHERE id = :id");
        return $stmt->execute(['status' => $status, 'id' => $id]);
    }

    public function getCouponByCode($code) {
        $statement = $this->pdo->prepare("SELECT * FROM coupons WHERE code = :code AND is_active = 1 AND expiration_date >= CURDATE()");
        $statement->execute([':code' => $code]);
        return $statement->fetch(PDO::FETCH_ASSOC);
    }
}

