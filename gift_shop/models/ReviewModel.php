<?php
require_once 'BaseModel.php';

class ReviewModel extends BaseModel {
    public function __construct() {
        parent::__construct('reviews');
    }

    public function all() {
        $stmt = $this->pdo->query("SELECT * FROM reviews");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM reviews WHERE id = $id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data) {
        $stmt = $this->pdo->prepare("
            INSERT INTO reviews (username, comment, rating, is_approved, created_at)
            VALUES (:username, :comment, :rating, :is_approved, :created_at)
        ");
        return $stmt->execute($data);
    }

    public function update($id, $data) {
        $sql = "UPDATE reviews SET ";
        $params = [];

        foreach ($data as $key => $value) {
            $sql .= "$key = :$key, ";
            $params[$key] = $value;
        }
        $sql = rtrim($sql, ', ') . " WHERE id = :id";
        $params['id'] = $id;

        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($params);
    }
}
?>
