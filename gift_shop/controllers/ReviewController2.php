<?php
require_once 'BaseController.php';
require_once 'models/Review.php';
class ReviewController2 extends Controller {
    private $reviewModel;

    public function __construct() {
        $this->reviewModel = $this->model('ReviewModel');
    }

    public function index() {
        if (!isset($_SESSION["admin_id"])) {
            header('Location: /admin/login');
            exit();
        }
        $reviews = $this->reviewModel->all();
        $this->view('admin/reviews/index', ['reviews' => $reviews]);
    }

    public function toggleStatus($id, $status) {
        if (!isset($_SESSION["admin_id"])) {
            header('Location: /admin/login');
            exit();
        }
        try {
            $this->reviewModel->update($id, ['status' => $status]);
            $_SESSION['success'] = 'Review status updated successfully';
        } catch (Exception $e) {
            $_SESSION['error'] = 'Error updating review status: ' . $e->getMessage();
        }
        header('Location: /admin/comments');
        exit();
    }

    public function creates() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $reviewData = [
                'username' => $_POST['username'],
                'comment' => $_POST['comment'],
                'rating' => $_POST['rating'],
                'is_approved' => 1,
                'created_at' => date('Y-m-d H:i:s')
            ];

            $this->reviewModel->create($reviewData);
            $_SESSION['success'] = 'Review added successfully';
            header('Location: /admin/reviews');
            exit();
        } else {
            $this->view('admin/reviews/create');
        }
    }

    public function edit($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $reviewData = [
                'username' => $_POST['username'],
                'comment' => $_POST['comment'],
                'rating' => $_POST['rating'],
                'updated_at' => date('Y-m-d H:i:s')
            ];

            $this->reviewModel->update($id, $reviewData);
            $_SESSION['success'] = 'Review updated successfully';
            header('Location: /admin/reviews');
            exit();
        } else {
            $review = $this->reviewModel->findById($id);
            $this->view('admin/reviews/edit', ['review' => $review]);
        }
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
                header("Location: /products/details?id=$productId");
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
            header("Location: /products/details?id=$productId");
            exit();
        }
    }

}
?>
