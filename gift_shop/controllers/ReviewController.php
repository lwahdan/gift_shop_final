<?php
require_once 'BaseController.php';
require_once 'models/Review.php';

class ReviewController extends Controller
{
    private $reviewModel;

    public function __construct()
    {
        // Load the Review model
        $this->reviewModel = $this->model('Review');
    }


    public function index($productId) {
        // Retrieve reviews for the specified product
        $reviews = $this->reviewModel->getReviewsByProductId($productId);
        
        // Pass reviews to the view for display
        $this->view('customers/products/details', ['reviews' => $reviews, 'product_id' => $productId]);
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Retrieve data from POST request
            $productId = $_POST['product_id'] ?? null;
            $rating = $_POST['rating'] ?? null;
            $reviewText = $_POST['review_text'] ?? '';
            $userId = $_SESSION['user_id'] ?? null;

            $errorMessages = [];

           
            if (!$productId) $errorMessages[] = "Product ID is missing.";
            if (!$rating) $errorMessages[] = "Rating is missing.";
            if (empty($reviewText)) $errorMessages[] = "Review content is missing.";

            if (!empty($errorMessages)) {
                $_SESSION['error_message'] = implode(" ", $errorMessages);
                header("Location: /product/details?id=$productId");
                exit();
            }

            // Prepare data for creating a new review
            $data = [
                'user_id' => $userId,
                'product_id' => $productId,
                'rating' => $rating,
                'review_text' => $reviewText
            ];

            try {
                if ($this->reviewModel->create($data)) {
                    $_SESSION['success_message'] = "Your review has been submitted successfully!";
                } else {
                    $_SESSION['error_message'] = "There was an error submitting your review. Please try again.";
                }
            } catch (Exception $e) {
                $_SESSION['error_message'] = "Error: " . $e->getMessage();
            }

            header("Location: /product/details?id=$productId");
            exit();
        }
    }

    public function showReviews($productId)
    {
        $reviews = $this->reviewModel->getReviewsByProductId($productId);
        if ($reviews === false) {
            $_SESSION['error_message'] = "Could not retrieve reviews for this product.";
            return [];
        }
        return $reviews;
    }

    
}
