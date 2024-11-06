<?php
include_once './models/UserModel.php';

class AuthController extends Controller {
    private $userModel;

    public function __construct() {
        $this->userModel = $this->model('UserModel');
        
    }

    public function login() {
        // Redirect if already logged in
        if (isset($_SESSION['user_id'])) {
            header('Location: /home');
            exit();
        }

        $data = [
            'email' => '',
            'message' => ''
        ];

        // Handle form submission
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email']) ?? '';
            $password = trim($_POST['password']) ?? '';

            $result = $this->userModel->login($email, $password);

            if ($result['status'] === 'success') {
                $_SESSION['user_id'] = $result['user_id']; 
                $_SESSION['username'] = $result['username'];
                $_SESSION['flash_message'] = 'Login successful!'; // Set flash message
                header('Location: /home');
                exit();
            } else {
                $_SESSION['flash_message'] = $result['message']; // Error flash message
            }
        }

        $this->view('/customers/login', $data);
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
            'message' => '',
            'registration_success' => false
        ];
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'username' => trim($_POST['username'] ?? ''),
                'email' => trim($_POST['email'] ?? ''),
                'first_name' => trim($_POST['first_name'] ?? ''),
                'last_name' => trim($_POST['last_name'] ?? ''),
                'phone_number' => trim($_POST['phone_number'] ?? ''),
                'address' => trim($_POST['address'] ?? ''),
                'city' => trim($_POST['city'] ?? ''),
                'country' => trim($_POST['country'] ?? ''),
                'postal_code' => trim($_POST['postal_code'] ?? ''),
                'password' => trim($_POST['password'] ?? ''),
                'confirm_password' => trim($_POST['confirm_password'] ?? ''),
                'message' => ''
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
    
            if ($result['status'] === 'success') {
                $_SESSION['flash_message'] = 'Registration successful! Please log in.';
                header('Location: /customers/login'); // Redirect to login
                exit();
            } else {
                $data['message'] = $result['message'];
            }
        }
    
        $this->view('/customers/register', $data);
    }
    
    public function logout() {
        session_start();
        unset($_SESSION['user_id'], $_SESSION['username']);
        $_SESSION['flash_message'] = 'You have logged out successfully.';
        session_destroy();
        header('Location: /customers/login');
        exit();
    }
}
