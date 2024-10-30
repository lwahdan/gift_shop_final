<?php
include_once './config/db.php';

require_once 'BaseModel.php';


require_once 'BaseModel.php';
class UserModel extends BaseModel {
    public function __construct() {
        parent::__construct('users');
    }

    public function register($username, $email, $password, $confirm_password, $first_name, $last_name, $phone_number, $address, $city, $postal_code, $country) {
        if (empty($username) || empty($email) || empty($first_name) || empty($last_name) || 
            empty($phone_number) || empty($address) || empty($password) || empty($confirm_password) || 
            empty($country) || empty($city) || empty($postal_code)) {
            return ['m' => 'error', 'message' => "All fields are required."];
        }

        if ($password !== $confirm_password) {
            return ['m' => 'error', 'message' => "Passwords do not match."];
        }

        if (!$this->isValidPassword($password)) {
            return ['m' => 'error', 'message' => "Password must meet security requirements."];
        }

        // Check existing email
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        if ($stmt->rowCount() > 0) {
            return ['m' => 'error', 'message' => "Email already exists."];
        }

        // Check existing username
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->execute(['username' => $username]);
        if ($stmt->rowCount() > 0) {
            return ['m' => 'error', 'message' => "Username already exists."];
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        
        try {
            $this->create([
                'username' => $username,
                'email' => $email,
                'first_name' => $first_name,
                'last_name' => $last_name,
                'phone_number' => $phone_number,
                'address' => $address,
                'city' => $city,
                'postal_code' => $postal_code,
                'country' => $country,
                'password' => $hashedPassword,
                'status' => 1
            ]);
            return ['m' => 'success', 'message' => "Registration successful!"];
        } catch (PDOException $e) {
            return ['m' => 'error', 'message' => "Registration failed. Please try again."];
        }
    }

    public function login($email, $password) {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = :email LIMIT 1");
        $stmt->execute(['email' => $email]);

        if ($stmt->rowCount() > 0) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if ((int)$user['status'] !== 1) {
                return ['m' => 'error', 'message' => "Your account is disabled."];
            }
            if (password_verify($password, $user['password'])) {
                return ['m' => 'success', 'message' => "Login successful!"];
            }
            return ['m' => 'error', 'message' => "Incorrect password."];
        }
        return ['m' => 'error', 'message' => "Email not found."];
    }

    public function getUserByEmail($email) {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = :email LIMIT 1");
        $stmt->execute(['email' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    private function isValidPassword($password) {
        return preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/', $password);
    }
}
?>