<?php
include_once './models/UserModel.php';

class ProfileController extends Controller {
    private $userModel;

    public function __construct() {
        $this->userModel = $this->model('UserModel');
    }

    // Method to view the user profile
    public function viewProfile() {
        // Check if the user is logged in
        if (!isset($_SESSION['username'])) {
            header('Location: /customers/login');
            exit();
        }

        // Get user data by username
        $username = $_SESSION['username'];
        $userData = $this->userModel->getUserByUsername($username);

        // Load the profile view with user data
        $this->view('customers/profile', ['user' => $userData]);
    }

    // Method to save (update) the user profile
    public function saveProfile() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Assuming the user ID is stored in the session
            $userId = $_SESSION['user_id'];

            // Prepare data for update
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

            // Attempt to update the user profile
            $result = $this->userModel->updateUser(
                $userId,
                $data['username'],
                $data['email'],
                $data['first_name'],
                $data['last_name'],
                $data['phone_number'],
                $data['address']
            );

            // Provide feedback on the operation
            if ($result) {
                $_SESSION['username'] = $data['username'];
                $_SESSION['email'] = $data['email'];
                $_SESSION['message'] = "Profile updated successfully.";
            } else {
                $_SESSION['message'] = "Profile update failed. Please try again.";
            }

            // Redirect back to profile page
            header('Location: /customers/profile');
            exit();
        }
    }

    // Method to update the profile with optional image upload
    public function updateProfile() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Prepare data for update
            $data = [
                'first_name' => htmlspecialchars(trim($_POST['first_name'])),
                'last_name' => htmlspecialchars(trim($_POST['last_name'])),
                'phone_number' => htmlspecialchars(trim($_POST['phone_number'])),
                'address' => htmlspecialchars(trim($_POST['address'])),
                'city' => htmlspecialchars(trim($_POST['city'])),
                'country' => htmlspecialchars(trim($_POST['country'])),
                'postal_code' => htmlspecialchars(trim($_POST['postal_code'])),
            ];

            // Check for optional profile image upload
            if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === UPLOAD_ERR_OK) {
                $targetDir = __DIR__ . '/../public/images/profile/';
                $fileName = time() . '_' . basename($_FILES['profile_image']['name']);
                $targetFilePath = $targetDir . $fileName;

                // Move uploaded file to target directory
                if (move_uploaded_file($_FILES['profile_image']['tmp_name'], $targetFilePath)) {
                    $data['profile_image'] = $fileName; // Save image name for the database update
                }
            }

            // Attempt to update user profile in the database
            $result = $this->userModel->updateUserProfile($_SESSION['username'], $data);

            // Provide feedback on the operation
            if ($result) {
                $_SESSION['message'] = "Profile updated successfully.";
            } else {
                $_SESSION['message'] = "Profile update failed. Please try again.";
            }

            header('Location: /customers/profile');
            exit();
        }
    }
    public function changePassword() {
        $userId = $_SESSION['user_id'];
        $data = [
            'current_password' => '',
            'new_password' => '',
            'confirm_password' => '',
            'message' => ''
        ];
    
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $currentPassword = $_POST['current_password'] ?? '';
            $newPassword = $_POST['new_password'] ?? '';
            $confirmPassword = $_POST['confirm_password'] ?? '';
    
            // Check if new passwords match
            if ($newPassword !== $confirmPassword) {
                $data['message'] = "New passwords do not match.";
            } else {
                $userId = $_SESSION['user_id'] ?? null;
                if ($userId) {
                    // Attempt to change password
                    $result = $this->userModel->changePassword($userId, $currentPassword, $newPassword);
                    if ($result['status'] === 'success') {
                        header('Location: /customers/profile'); // Redirect to profile
                        exit();
                    } else {
                        $data['message'] = $result['message'];
                    }
                } else {
                    $data['message'] = "User not found.";
                }
            }
        }
    
        $this->view('customers/changePassword', $data); // Update with actual view path
    }


}
