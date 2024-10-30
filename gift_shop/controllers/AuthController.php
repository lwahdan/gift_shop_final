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
            $email = $_POST['email'];
            $password = $_POST['password'];

            $result = $this->userModel->login($email, $password);

            if ($result['m'] === 'success') {
                $userData = $this->userModel->getUserByEmail($email);
                if ($userData) {
                    foreach ($userData as $key => $value) {
                        $_SESSION[$key] = $value;
                    }
                    header('Location:/customers/index');
                    exit();
                }
            }
            $data['message'] = $result['message'];
            $data['email'] = $email;
        }

        $this->view('customers/login', $data);  // Updated view path
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
}
?>
