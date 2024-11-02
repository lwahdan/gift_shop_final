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
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Assuming user_id is stored in the session
            $user_id = $_SESSION['user_id'];
            $current_password = $_POST['current_password'] ?? '';
            $new_password = $_POST['new_password'] ?? '';
            $confirm_password = $_POST['confirm_password'] ?? '';

            $errors = [];

            // Validate current password
            $user = (new UserModel())->getUserById($user_id); // Fetch user details
            if (!password_verify($current_password, $user['password'])) {
                $errors[] = 'Current password is incorrect.';
            }

            // Validate new password
            if (strlen($new_password) < 8 || 
                !preg_match('/[A-Z]/', $new_password) || 
                !preg_match('/[a-z]/', $new_password) || 
                !preg_match('/[0-9]/', $new_password) || 
                !preg_match('/[\W_]/', $new_password)) {
                $errors[] = 'New password must be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, one number, and one special character.';
            }

            // Check if new passwords match
            if ($new_password !== $confirm_password) {
                $errors[] = 'New password and confirm password do not match.';
            }

            if (empty($errors)) {
                // Update the password in the database
                $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
                (new UserModel())->updatePassword($user_id, $hashed_password);
                
                // Redirect or show a success message
                header('Location: /customers/profile?success=Password changed successfully.');
                exit;
            }

            // Pass errors to the view
            $this->view('customers/profile', ['errors' => $errors, 'user' => $user]);
        } else {
            // Redirect to the profile view
            header('Location: /customers /profile');
            exit;
        }
    }


}
