<?php
include_once './models/UserModel.php';

class ProfileController extends Controller {
    private $userModel;

    public function __construct() {
        $this->userModel = $this->model('UserModel');
    }

    // Method to view the user profile
    public function viewProfile() {
        // Check if user is logged in
        if (!isset($_SESSION['username'])) {
            header('Location: /customers/login');
            exit();
        }

        // Get user data from the model
        $username = $_SESSION['username'];
        $userData = $this->userModel->getUserByUsername($username);

        // Pass data to the view
        $this->view('customers/profile', ['user' => $userData]);
    }

    // Method to save (update) the user profile
    public function saveProfile() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userId = $_SESSION['user_id'];
            $data = [
                'username' => htmlspecialchars(trim($_POST['username'])),
                'email' => htmlspecialchars(trim($_POST['email'])),
                'first_name' => htmlspecialchars(trim($_POST['first_name'])),
                'last_name' => htmlspecialchars(trim($_POST['last_name'])),
                'phone_number' => htmlspecialchars(trim($_POST['phone_number'])),
                'address' => htmlspecialchars(trim($_POST['address'])),
                'city' => htmlspecialchars(trim($_POST['city'])),
                'postal_code' => htmlspecialchars(trim($_POST['postal_code'])),
                'country' => htmlspecialchars(trim($_POST['country']))
            ];
    
            // Update profile and get result
            $result = $this->userModel->updateUser($userId, $data['username'], $data['email'], $data['first_name'], $data['last_name'], $data['phone_number'], $data['address']);
    
            // Show feedback
            $_SESSION['message'] = $result ? "Profile updated successfully." : "Profile update failed. Please try again.";
    
            // Update session data if successful
            if ($result) {
                foreach ($data as $key => $value) {
                    $_SESSION[$key] = $value;
                }
            }
    
            // Redirect back to profile page
            header('Location: /customers/profile');
            exit();
        }
    }
}
