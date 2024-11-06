<?php
require_once 'BaseController.php';
require_once 'models/Review.php';

class ReviewController extends Controller
{
    private $reviewModel;

    public function __construct()
    {
        $this->reviewModel = $this->model('Review');
    }

    public function index($productId)
    {
        // Retrieve reviews for the specified product
        $reviews = $this->reviewModel->getReviewsByProductId($productId);
        
        // Pass reviews to the view for display
        $this->view('customers/products/details', ['reviews' => $reviews, 'product_id' => $productId]);
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $productId = $_POST['product_id'] ?? null;
            $rating = $_POST['rating'] ?? null;
            $reviewText = $_POST['review_text'] ?? '';
            $userId = $_SESSION['user_id'] ?? null;

            if (!$productId || !$rating || empty($reviewText)) {
                $_SESSION['error_message'] = "All fields are required.";
                header("Location: /product/details?id=$productId");
                exit();
            }

            $data = [
                'user_id' => $userId,
                'product_id' => $productId,
                'rating' => $rating,
                'review_text' => $reviewText
            ];

            try {
                if ($this->reviewModel->create($data)) {
                    $_SESSION['success_message'] = "Your review has been submitted!";
                } else {
                    $_SESSION['error_message'] = "Failed to submit review.";
                }
            } catch (Exception $e) {
                $_SESSION['error_message'] = "Error: " . $e->getMessage();
            }

            header("Location: /product/details?id=$productId");
            exit();
        }
    }

    public function delete($reviewId) {
        if (isset($_SESSION['user_id'])) {
            $reviewModel = new Review();
            $review = $reviewModel->getReviewById($reviewId);
    
            // Ensure the logged-in user is the owner of the review
            if ($review && $review['user_id'] == $_SESSION['user_id']) {
                $reviewModel->deleteReview($reviewId);
                $_SESSION['success_message'] = 'Review deleted successfully.';
            } else {
                $_SESSION['error_message'] = 'You can only delete your own reviews.';
            }
    
            // Redirect back to the product details page with the correct product ID
            $productId = $review['product_id'];
            header("Location: /product/details?id=$productId");
            exit();
        } else {
            $_SESSION['error_message'] = 'You must be logged in to delete a review.';
            header("Location: /login");  // Redirect to login if not logged in
            exit();
        }
    }
    

   
    
}
?>
