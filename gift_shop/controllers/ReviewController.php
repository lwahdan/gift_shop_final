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

    public function create()
    {
        // Enable error reporting for debugging
        error_reporting(E_ALL);
        ini_set('display_errors', 1);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Retrieve data from POST request
            $productId = $_POST['product_id'] ?? null;
            $rating = $_POST['rating'] ?? null;
            $reviewText = $_POST['review_text'] ?? '';
            $userId = $_SESSION['user_id'] ?? null;

            // Initialize an array for error messages
            $errorMessages = [];

            // Check for missing values and populate error messages
            if (!$userId) {
                $errorMessages[] = "User ID is missing.";
            }
            if (!$productId) {
                $errorMessages[] = "Product ID is missing.";
            }
            if (!$rating) {
                $errorMessages[] = "Rating is missing.";
            }
            if (empty($reviewText)) {
                $errorMessages[] = "Review content is missing.";
            }

            // If there are any error messages, set them in the session and redirect
            if (!empty($errorMessages)) {
                $_SESSION['error_message'] = "Error: " . implode(" ", $errorMessages);
                header("Location: /product/details?id=$productId");
                exit();
            }

            // Prepare the data for the review
            $data = [
                'user_id' => $userId,
                'product_id' => $productId,
                'rating' => $rating,
                'review_text' => $reviewText
            ];

            // Call the create method from Review model
            try {
                if ($this->reviewModel->create($data)) {
                    $_SESSION['success_message'] = "Your review has been submitted successfully!";
                } else {
                    $_SESSION['error_message'] = "There was an error submitting your review. Please try again.";
                }
            } catch (Exception $e) {
                $_SESSION['error_message'] = "Error: " . $e->getMessage();
            }

            // Redirect back to the product details page
            header("Location: /product/details?id=$productId");
            exit();
        }
    }

    public function showReviews($productId)
    {
        // Fetch reviews for the specified product
        $reviews = $this->reviewModel->getReviewsByProductId($productId);

        // Check if the reviews were successfully retrieved
        if ($reviews === false) {
            $_SESSION['error_message'] = "Could not retrieve reviews for this product.";
            return [];
        }

        // Return the reviews to be displayed in the view
        return $reviews;
    }
}