
<!--// models/CommentModel.php-->
<?php
require_once 'BaseModel.php';

class CommentModel extends BaseModel {
    public function __construct() {
        parent::__construct('reviews');
    }

    public function getTotalComments() {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) AS total FROM reviews");
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }

    public function getAllComments() {
        $stmt = $this->pdo->prepare("SELECT * FROM reviews ORDER BY updated_at DESC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function activeReviews()
    {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) AS total_active FROM reviews WHERE status = 1");
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total_active'] ?? 0;
    }
    public function totalDisActiveReviews()
    {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) AS total_inactive FROM reviews WHERE status = 0");
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total_inactive'] ?? 0;
    }
}

