<?php
include_once './models/UserModel.php';
include_once './models/Order.php';

class ProfileController extends Controller {
    private $userModel;
    private $orderModel;

    public function __construct() {
        $this->userModel = $this->model('UserModel');
        $this->orderModel = new Order('orders');
    }

    // Method to view the user profile
    public function viewProfile() {
        // Check if the user is logged in
        if (!isset($_SESSION['user_id'])) {
            header('Location: /customers/login');
            exit();
        }
    
        // Get user ID from session
        $userId = $_SESSION['user_id'];
        
        // Fetch user data
        $userData = $this->userModel->getUserById($userId); // Assuming you have this method to fetch user data by ID
        $orders = $this->orderModel->getOrdersByUser($userId);
        
        // Fetch address details
        $addressData = $this->userModel->getUserAddressById($userId);
    
        // Load the profile view with user data, including the username
        $this->view('customers/profile', [
            'user' => $userData, // Now contains the username
            'orders' => $orders,
            'address' => $addressData
        ]);
    }
    
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
            $_SESSION['success_message'] = "Profile updated successfully.";
        } else {
            $_SESSION['message'] = "Profile update failed. Please try again.";
        }

        header('Location: /home');
        exit();
    }
}

// Method to update the profile with optional image upload
public function updateProfile() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Prepare data for update
        $data = [
            'email' => htmlspecialchars(trim($_POST['email'])),
            'username' => htmlspecialchars(trim($_POST['username'])),
           
            'first_name' => htmlspecialchars(trim($_POST['first_name'])),
            'last_name' => htmlspecialchars(trim($_POST['last_name'])),
            'phone_number' => htmlspecialchars(trim($_POST['phone_number'])),
            'address' => htmlspecialchars(trim($_POST['address'])),
            'city' => htmlspecialchars(trim($_POST['city'])),
            'country' => htmlspecialchars(trim($_POST['country'])),
            'postal_code' => htmlspecialchars(trim($_POST['postal_code'])),
        ];

      

        // Attempt to update user profile in the database
        $result = $this->userModel->updateUserProfile($_SESSION['username'], $data);

        // Provide feedback on the operation
        if ($result) {
            $_SESSION['success_message'] = "Profile updated successfully.";
        } else {
            $_SESSION['message'] = "Profile update failed. Please try again.";
        }

        header('Location: /customers/profile');
        exit();
    }
}

    public function changePassword()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Get the current user's data
        $userId = $_SESSION['user_id']; // Assuming user ID is stored in session
        $userModel = new UserModel();
        $user = $userModel->getUserById($userId);

        // Retrieve form data
        $currentPassword = $_POST['current_password'];
        $newPassword = $_POST['new_password'];
        $confirmPassword = $_POST['confirm_new_password'];

        // Validate current password
        if (!password_verify($currentPassword, $user['password'])) {
            $_SESSION['message'] = 'Current password is incorrect.';
            header('Location: /customers/profile'); // Redirect back to the profile page
            exit;
        }

        // Validate new password match
        if ($newPassword !== $confirmPassword) {
            $_SESSION['message'] = 'New passwords do not match.';
            header('Location: /customers/profile');
            exit;
        }

        // Validate new password strength
        if (!$this->isValidPassword($newPassword)) {
            $_SESSION['message'] = 'New password must meet security requirements.';
            header('Location: /customers/profile');
            exit;
        }

        // Hash the new password
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        // Update the password in the database
        if ($userModel->updatePassword($userId, $hashedPassword)) {
            $_SESSION['success_message'] = 'Password changed successfully.';
        } else {
            $_SESSION['message'] = 'Password change failed. Please try again.';
        }

        header('Location: /customers/profile');
        exit();
    }
}
private function isValidPassword($password) {
    return preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/', $password);
}




}
