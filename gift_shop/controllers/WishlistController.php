<?php

require_once 'models/Wishlist.php';
require_once __DIR__ . '/../models/Wishlist.php';
require_once __DIR__ . '/../models/Product.php';

class WishlistController extends Controller
{
    private $wishlistModel;
    private $productModel;

    public function __construct()
    {
        $this->wishlistModel = new Wishlist();
        $this->productModel = new Product();
    }

    // Show all items in the user's wishlist
    public function index()
    {
        if (!isset($_SESSION['user_id'])) {
            header("Location: /customers/login");  // Redirect if not logged in
            exit();
        }
        $userId = $_SESSION['user_id']; // Ensure user is authenticated and session is set
            $wishlistItems = $this->wishlistModel->getWishlistByUser($userId);
            $this->view('customers/wishlist', [
            'wishlistItems' => $wishlistItems,
            'productModel' => $this->productModel,
            'dir' => "../public/images/product/"
        ]);
        
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
        header("Location: /wishlist"); // Redirect to wishlist page
    }

    // Remove an item from the wishlist
    public function remove($wishlistId)
    {
        $this->wishlistModel->delete($wishlistId);
        header("Location: /wishlist"); // Redirect to wishlist page
    }
}
