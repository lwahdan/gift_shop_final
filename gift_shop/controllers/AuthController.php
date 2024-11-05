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
    
            if ($result['status'] === 'success') {
                $_SESSION['user_id'] = $result['user_id']; 
                $_SESSION['username'] = $result['username']; 
    
                header('Location: /home?login=success');
                exit();
            } else {
                $data['message'] = $result['message'];
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
                'confirm_password' => $_POST['confirm_password'] ?? '',
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
                $data['registration_success'] = true; // Set flag for SweetAlert
            } else {
                $data['message'] = $result['message'];
            }
        }

        $this->view('/customers/register', $data);
    }

    public function logout() {
        unset($_SESSION['user_id']);
        unset($_SESSION['username']);
        session_destroy();
        header('Location: /customers/login');
        exit();
    }
}
?>
