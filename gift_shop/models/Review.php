<?php
require_once 'BaseModel.php';

class Review extends BaseModel
{
    public function __construct()
    {
        parent::__construct("reviews");
    }

    public function create($data)
    {
        try {
            $keys = implode(',', array_keys($data));
            $tags = ':' . implode(', :', array_keys($data));
            $sql = "INSERT INTO $this->table ($keys) VALUES ($tags)";
            $statement = $this->pdo->prepare($sql);

            if (!$statement->execute($data)) {
                throw new Exception("Failed to execute statement: " . implode(", ", $statement->errorInfo()));
            }
            return true;
        } catch (PDOException $e) {
            error_log("PDO error: " . $e->getMessage());
            throw new Exception("Database error: " . $e->getMessage());
        }
    }

    public function getReviewsByProductId($productId)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM reviews WHERE product_id = :product_id ORDER BY created_at DESC");
        $stmt->execute(['product_id' => $productId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
