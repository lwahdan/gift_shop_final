<?php
require_once 'BaseController.php';
class ContactController extends Controller
{
    // controllers/ContactController.php
public function submitContactForm()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $userId = $_SESSION['user_id'] ?? null;
        $name = htmlspecialchars(trim($_POST['name']));
        $email = filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL);
        $phone_number = htmlspecialchars(trim($_POST['phone_number'] ?? ''));
        $message = htmlspecialchars(trim($_POST['message']));

        if ($name && $email && $message) {
            $data = [
                'user_id' => $userId,
                'name' => $name,
                'email' => $email,
                'phone_number' => $phone_number,
                'message' => $message,
            ];

            $contactMessageModel = $this->model('ContactMessage');
            
            // Check if message was saved successfully
            if ($contactMessageModel->saveMessage($data)) {
                echo "Message sent successfully!";

            } else {
                echo "Failed to send message. Please try again.";
            }
        } else {
            echo "Please fill in all required fields correctly.";
        }
    } else {
        header('Location: /contact');
        exit;
    }
}

}
