<?php
include_once './models/UserModel.php';

class AuthController extends Controller {
    private $userModel;
   

    public function __construct() {
        $this->userModel = $this->model('UserModel');
  
    }
    

    public function login() {
        $data = [
            'email' => '',
            'message' => ''
        ];
    
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
    
            $result = $this->userModel->login($email, $password);
    
            // Check the response from the login method
            if ($result['status'] === 'success') {
                // Login was successful, set session variables
                $_SESSION['user_id'] = $result['user_id']; // Ensure you retrieve the user ID from the model if needed
                $_SESSION['username'] = $result['username']; // Ensure you retrieve the username or any necessary info
    
                // Redirect to profile page
                header('Location: /customers/profile');
                exit();
            } else {
                // Login failed, set the message
                $data['message'] = $result['message'];
            }
        }
    
        $this->view('customers/login', $data); // Updated view path
    }
    

    public function register() {
        $data = [
            'username' => '',
            'email' => '',
            'first_name' => '',
            'last_name' => '',
            'phone_number' => '',
            'address' => '',
            'city' => '',
            'country' => '',
            'postal_code' => '',
            'message' => ''
        ];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'username' => $_POST['username'] ?? '',
                'email' => $_POST['email'] ?? '',
                'first_name' => $_POST['first_name'] ?? '',
                'last_name' => $_POST['last_name'] ?? '',
                'phone_number' => $_POST['phone_number'] ?? '',
                'address' => $_POST['address'] ?? '',
                'city' => $_POST['city'] ?? '',
                'country' => $_POST['country'] ?? '',
                'postal_code' => $_POST['postal_code'] ?? '',
                'password' => $_POST['password'] ?? '',
                'confirm_password' => $_POST['confirm_password'] ?? ''
            ];

            $result = $this->userModel->register(
                $data['username'], 
                $data['email'],
                $data['password'],
                $data['confirm_password'],
                $data['first_name'],
                $data['last_name'],
                $data['phone_number'],
                $data['address'],
                $data['city'],
                $data['postal_code'],
                $data['country']
            );

            if ($result['m'] === 'success') {
                $_SESSION['username'] = $data['username'];
                header('Location:/customers/login');
               
                exit();
            }
            
            $data['message'] = $result['message'];
        }

        $this->view('/customers/register', $data);  // Updated view path
    }

public function logout() {
    session_start(); // Start the session
    session_unset(); // Unset all session variables
    session_destroy(); // Destroy the session

    // Redirect to the login page
    header('Location: /customers/login');
    exit();
}  
public function changePassword() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $currentPassword = $_POST['current_password'];
        $newPassword = $_POST['new_password'];
        $confirmNewPassword = $_POST['confirm_new_password'];

        // Validate the new password
        if (!$this->isValidPassword($newPassword)) {
            $_SESSION['message'] = "New password must meet security requirements.";
            header('Location: /customers/profile');
            exit();
        }

        // Check if new passwords match
        if ($newPassword !== $confirmNewPassword) {
            $_SESSION['message'] = "New passwords do not match.";
            header('Location: /customers/profile');
            exit();
        }

        // Verify current password
        $userId = $_SESSION['user_id'];
        $userData = $this->userModel->getUserById($userId); // You need to create this method

        if (!password_verify($currentPassword, $userData['password'])) {
            $_SESSION['message'] = "Current password is incorrect.";
            header('Location: /customers/profile');
            exit();
        }

        // Hash new password and update the database
        $hashedNewPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $result = $this->userModel->updatePassword($userId, $hashedNewPassword); // You need to create this method

        if ($result) {
            $_SESSION['message'] = "Password changed successfully.";
        } else {
            $_SESSION['message'] = "Failed to change password. Please try again.";
        }

        // Redirect to profile page
        header('Location: /customers/profile');
        exit();
    }

}
// Method to validate password strength
    private function isValidPassword($password) {
        return preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/', $password);
    }
}


?>  