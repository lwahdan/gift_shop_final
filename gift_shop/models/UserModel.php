<?php
include_once './config/db.php';
require_once 'BaseModel.php';

class UserModel extends BaseModel {
    public function __construct() {
        parent::__construct('users');
    }

    // Method for user registration
    public function register($username, $email, $password, $confirm_password, $first_name, $last_name, $phone_number, $address, $city, $postal_code, $country) {
        // Validate required fields
        if (empty($username) || empty($email) || empty($first_name) || empty($last_name) || 
            empty($phone_number) || empty($address) || empty($password) || empty($confirm_password) || 
            empty($country) || empty($city) || empty($postal_code)) {
            return ['m' => 'error', 'message' => "All fields are required."];
        }

        // Check if passwords match
        if ($password !== $confirm_password) {
            return ['m' => 'error', 'message' => "Passwords do not match."];
        }

        // Validate password strength
        if (!$this->isValidPassword($password)) {
            return ['m' => 'error', 'message' => "Password must meet security requirements."];
        }

        // Check if email already exists
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        if ($stmt->rowCount() > 0) {
            return ['m' => 'error', 'message' => "Email already exists."];
        }

        // Check if username already exists
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->execute(['username' => $username]);
        if ($stmt->rowCount() > 0) {
            return ['m' => 'error', 'message' => "Username already exists."];
        }

        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        
        try {
            // Insert the new user into the database
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
                'status' => 1 // Assuming status 1 means active
            ]);
            return ['m' => 'success', 'message' => "Registration successful!"];
        } catch (PDOException $e) {
            return ['m' => 'error', 'message' => "Registration failed. Please try again."];
        }
    }

    // Method for user login
    public function login($email, $password) {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = :email LIMIT 1");
        $stmt->execute(['email' => $email]);

        if ($stmt->rowCount() > 0) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            // Check if the account is disabled
            if ((int)$user['status'] !== 1) {
                return ['m' => 'error', 'message' => "Your account is disabled."];
            }
            // Verify the password
            if (password_verify($password, $user['password'])) {
                return ['m' => 'success', 'message' => "Login successful!"];
            }
            return ['m' => 'error', 'message' => "Incorrect password."];
        }
        return ['m' => 'error', 'message' => "Email not found."];
    }

    // Method to get user by email
    public function getUserByEmail($email) {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = :email LIMIT 1");
        $stmt->execute(['email' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Method to validate password strength
    private function isValidPassword($password) {
        return preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/', $password);
    }

    // Method to get user by username
    public function getUserByUsername($username) {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

  
    public function updateUser($userId, $username, $email, $firstName, $lastName, $phoneNumber, $address) {
        // Prepare the SQL statement
        $stmt = $this->pdo->prepare("UPDATE users SET username = ?, email = ?, first_name = ?, last_name = ?, phone_number = ?, address = ? WHERE id = ?");
        
        // Bind parameters to the statement
        $stmt->bindParam("sssssii", $username, $email, $firstName, $lastName, $phoneNumber, $address, $userId);
        
        // Execute the statement and check for success
        if ($stmt->execute()) {
            return true; // Return true if the update was successful
        } else {
            return false; // Return false if there was an error
        }
    }
    
}
