<?php

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

    public function isInWishlist($productId){
        return $this->wishlistModel->isInWishlist($productId);
    }

    public function count(){
        $count = $this->wishlistModel->getWishlistCount($_SESSION['user_id']);
        
        header('Content-Type: application/json');
        echo json_encode(['count' => $count]);
    }

    public function addProduct($productId)
    {
        $inWishlist = !$this->isInWishlist($productId);
        if ($inWishlist) {
            $userId = $_SESSION['user_id'];
            $this->wishlistModel->create([
            'user_id' => $userId,
            'product_id' => $productId,
            'added_at' => date('Y-m-d H:i:s')
        ]);
        }
        header("Location: /wishlist"); // Redirect to wishlist page
    }

    public function add($productId)
    {
        if (!isset($_SESSION['user_id'])) {
            header("Location: /customers/login");  // Redirect if not logged in
            exit();
        }
        $userId = $_SESSION['user_id'];
        $this->wishlistModel->create([
            'user_id' => $userId,
            'product_id' => $productId,
            'added_at' => date('Y-m-d H:i:s')
        ]);

    }

    // Remove an item from the wishlist
    public function remove($productId)
    {
        if (!isset($_SESSION['user_id'])) {
            header("Location: /customers/login");  // Redirect if not logged in
            exit();
        }
        $this->wishlistModel->removeByProductId($productId, $_SESSION['user_id']);
    }

    public function delete($wishlistId)
    {
        $this->wishlistModel->delete($wishlistId);
        header("Location: /wishlist"); // Redirect to wishlist page
    }

    public function addOrRemove($productId) {
        $inWishlist = !$this->isInWishlist($productId);
        if ($inWishlist) {
            $this->add($productId);
        } else {
            $this->remove($productId, $_SESSION['user_id']);
        }
        echo json_encode([
            'count' => $this->wishlistModel->getWishlistCount($_SESSION['user_id']),
            'isInWishlist' => $inWishlist
        ]);
    }

    public function getWishlistProductIds()
    {
        if (!isset($_SESSION['user_id'])) {
            header("Location: /customers/login");  // Redirect if not logged in
            exit();
        }
        $userId = $_SESSION['user_id'];
        $wishlistItems = $this->wishlistModel->getWishlistByUser($userId);

        // Return only the product IDs in JSON format
        $productIds = array_column($wishlistItems, 'product_id');
        header('Content-Type: application/json');
        echo json_encode(['wishlistProductIds' => $productIds]);
    }

}
?>
