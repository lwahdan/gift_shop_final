<?php
include_once './models/UserModel.php';
class ProfileController extends Controller{
    private $userModel;

    public function __construct() {
       
        $this->userModel = $this->model('UserModel');
    }

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
        $this->view('/customers/profile', $userData); 
        
    }

   public function saveProfile() {
    if (!isset($_POST['username'], $_POST['email'], $_POST['first_name'], $_POST['last_name'], $_POST['phone_number'], $_POST['address'])) {
        echo "Some fields are missing.";
        exit();
    }

    // Get user ID from the session
    $userId = $_SESSION['user_id'];

    // Get form input
    $username = $_POST['username'];
    $email = $_POST['email'];
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $phoneNumber = $_POST['phone_number'];
    $address = $_POST['address'];

    // Update user profile in the database
    $this->userModel->updateProfile($userId, $username, $email, $firstName, $lastName, $phoneNumber, $address);

    // Redirect back to the profile page
    header('Location: /customers/profile');
    exit();
}

    
    
}
  

   
