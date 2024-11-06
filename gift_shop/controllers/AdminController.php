<?php
require_once 'models/AdminModel.php';

class AdminController extends Controller
{
    private $adminModel;

    public function __construct()
    {
        $this->adminModel = new AdminModel();
    }

    // Show the admin dashboard
    public function dashboard()
    {
        // Logic to retrieve and display admin dashboard data
        $this->view('customers/dashbord'); // Render the admin dashboard view
    }

    // Show the login form with an optional error parameter
    public function showSignInForm($error = null)
    {
        // Pass the error to the view if it's set
        $this->view('admin/login/index', ['error' => $error]);
    }

    // Process login form submission
    public function signIn()
    {
        $email = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        // Attempt to find the admin by username
        $admin = $this->adminModel->findByEmail($email);

        if ($admin && $this->adminModel->verifyPassword($password, $admin['password'])) {
            // Store admin's ID in session
            session_start();
            $_SESSION['admin_id'] = $admin['id'];
            header('Location: /admin');  // Redirect to the dashboard
            exit();
        } else {
            // Redirect back to the login page with an error message
            $error = "Invalid username or password.";
            $this->showSignInForm($error);  // Pass the error to the view
        }
    }

    // Log out the admin
    public function logout()
    {
        session_start();
        unset($_SESSION['admin_id']);
        session_destroy();
        header('Location: /admin/login');  // Redirect to sign-in page after logout
        exit();
    }
}
