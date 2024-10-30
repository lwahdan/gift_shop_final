
<?php
require_once 'BaseController.php';

class UserController extends Controller {
    private $userModel;

    public function __construct() {
        $this->userModel = $this->model('UserModel');
    }

    public function index() {
        $users = $this->userModel->all();
        $this->view('admin/users/index', ['users' => $users]);
    }



    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->userModel->create($_POST);
            header('Location: /admin/users');
        }
    }



    public function add() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validate input
            $errors = [];

            if (empty($_POST['username'])) {
                $errors['username'] = 'Username is required';
            }
            if (empty($_POST['email'])) {
                $errors['email'] = 'Email is required';
            } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = 'Invalid email format';
            }
            if (empty($_POST['password'])) {
                $errors['password'] = 'Password is required';
            } elseif (strlen($_POST['password']) < 6) {
                $errors['password'] = 'Password must be at least 6 characters';
            }

            if (empty($errors)) {
                $userData = [
                    'username' => $_POST['username'],
                    'email' => $_POST['email'],
                    'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
                    'first_name' => $_POST['first_name'],
                    'last_name' => $_POST['last_name'],
                    'phone_number' => $_POST['phone_number'],
                    'address' => $_POST['address'],
                    'city' => $_POST['city'],
                    'postal_code' => $_POST['postal_code'],
                    'country' => $_POST['country'],
                    'status' => 1,
                    'created_at' => date('Y-m-d H:i:s')
                ];

                try {
                    $this->userModel->create($userData);
                    $_SESSION['success'] = 'User added successfully';
                    header('Location: /admin/users');
                    exit();
                } catch (Exception $e) {
                    $errors['general'] = 'Error adding user: ' . $e->getMessage();
                }
            }

            // If there are errors, pass them to the view
            $data['errors'] = $errors;
            $data['old'] = $_POST; // Preserve old input
            $this->view('admin/users/add', $data);
        } else {
            // Display the add user form
            $this->view('admin/users/add');
        }
    }

    public function toggleStatus($id, $status) {
        try {
            $this->userModel->toggleStatus($id, $status);
            $_SESSION['success'] = 'User status updated successfully';
        } catch (Exception $e) {
            $_SESSION['error'] = 'Error updating user status: ' . $e->getMessage();
        }

        header('Location: /admin/users');
        exit();
    }

}
