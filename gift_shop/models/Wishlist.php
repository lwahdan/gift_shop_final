<?php

require_once __DIR__ . '/../models/BaseModel.php';
require_once __DIR__ . '/../models/Order.php';

class Wishlist extends BaseModel
{
    public function __construct()
    {
        parent::__construct('wishlist'); // Pass the table name 'wishlist' to BaseModel
    }

    // Get all wishlist items for a specific user
    public function getWishlistByUser($userId)
    {
        $statement = $this->pdo->prepare("SELECT * FROM $this->table WHERE user_id = :user_id");
        $statement->bindValue(':user_id', $userId);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getWishlistCount($userId) {
        $statement = $this->pdo->prepare("SELECT COUNT(*) as count FROM $this->table WHERE user_id = :user_id");
        $statement->bindValue(':user_id', $userId);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result['count'];
    }

    public function isInWishlist($productId){
        $statement = $this->pdo->prepare("SELECT COUNT(*) as count FROM $this->table WHERE product_id = :product_id");
        $statement->bindValue(':product_id', $productId);
        $statement->execute();
        $count = $statement->fetch(PDO::FETCH_ASSOC);
        
        return $count['count'] > 0;
    }

    public function removeByProductId($productId, $userId) {
        $statement = $this->pdo->prepare("DELETE FROM $this->table WHERE product_id = :product_id AND user_id = :user_id");
        $statement->bindValue(':product_id', $productId);
        $statement->bindValue(':user_id', $userId);
        $statement->execute();
        return $statement->rowCount(); // Return affected rows count
    }
}
?>
