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
            // Validate the input data (basic validation, can be expanded)
            if (!isset($data['product_id'], $data['user_id'], $data['rating'], $data['review_text'])) {
                throw new Exception("Missing required fields.");
            }
            if ($data['rating'] < 1 || $data['rating'] > 5) {
                throw new Exception("Rating must be between 1 and 5.");
            }

            // Prepare the SQL query for insert
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
        } catch (Exception $e) {
            throw new Exception("Error: " . $e->getMessage());
        }
    }

    public function getReviewsByProductId($productId)
    {
        $stmt = $this->pdo->prepare("
            SELECT r.*, u.username 
            FROM reviews r 
            LEFT JOIN users u ON r.user_id = u.id 
            WHERE r.product_id = :product_id AND r.status = 1 
            ORDER BY r.created_at DESC
        ");
        $stmt->execute(['product_id' => $productId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateReview($id, $data)
    {
        return parent::update($id, $data); 
    }

    public function deleteReview($id)
    {
        return parent::delete($id); 
    }

    public function getReviewById($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM reviews WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    
   public function getAverageRating($productId)
{
    // Prepare the query to calculate the average rating
    $stmt = $this->pdo->prepare("
        SELECT AVG(rating) AS average_rating 
        FROM reviews 
        WHERE product_id = :product_id AND status = 1
    ");
    $stmt->execute(['product_id' => $productId]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    // Debugging output
    if ($result['average_rating'] === null) {
        error_log("No ratings found for product ID: $productId");
        return 0;  // No ratings exist, return 0
    } else {
        error_log("Average Rating for product $productId: " . $result['average_rating']);
        return round($result['average_rating'], 1);
    }
}

}

?>
