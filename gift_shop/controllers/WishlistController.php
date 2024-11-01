<?php

require_once 'models/Wishlist.php';
require_once __DIR__ . '/../models/Wishlist.php';

class WishlistController
{
    private $wishlistModel;

    public function __construct()
    {
        $this->wishlistModel = new Wishlist();
    }

    // Show all items in the user's wishlist
    public function index()
    {
        // $userId = $_SESSION['user_id']; // Ensure user is authenticated and session is set
        $userId = 1;
        $wishlistItems = $this->wishlistModel->getWishlistByUser($userId);
        require 'views/wishlist/index.php';  // Load the view
    }

    // Add an item to the wishlist
    public function add($productId)
    {
        $userId = $_SESSION['user_id'];
        $this->wishlistModel->create([
            'user_id' => $userId,
            'product_id' => $productId,
            'added_at' => date('Y-m-d H:i:s')
        ]);
        header("Location: /customers/wishlist"); // Redirect to wishlist page
    }

    // Remove an item from the wishlist
    public function remove($wishlistId)
    {
        $this->wishlistModel->delete($wishlistId);
        header("Location: /customers/wishlist"); // Redirect to wishlist page
    }
}
