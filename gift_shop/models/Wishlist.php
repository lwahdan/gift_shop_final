<?php

require_once __DIR__.'/../models/Order.php';
require_once 'BaseModel.php';

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
}

