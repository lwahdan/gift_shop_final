
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
}

