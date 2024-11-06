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
    public function getCoupons($filters = []) {
        $sql = "SELECT * FROM coupons WHERE 1=1";

        // Apply filters to the SQL query
        if (isset($filters['status'])) {
            $sql .= " AND is_active = :status";
        }
        if (isset($filters['discount'])) {
            $sql .= " AND discount_value >= :discount";
        }
        if (isset($filters['date'])) {
            $sql .= " AND updated_at >= :date";
        }

        $stmt = $this->pdo->prepare($sql);

        // Bind parameters to the query
        if (isset($filters['status'])) {
            $stmt->bindParam(':status', $filters['status'], PDO::PARAM_INT);
        }
        if (isset($filters['discount'])) {
            $stmt->bindParam(':discount', $filters['discount'], PDO::PARAM_INT);
        }
        if (isset($filters['date'])) {
            $stmt->bindParam(':date', $filters['date'], PDO::PARAM_STR);
        }

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

