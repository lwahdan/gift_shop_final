<?php
include_once './config/db.php';
require_once 'BaseModel.php';

class UserModel extends BaseModel {
    public function __construct() {
        parent::__construct('users');
    }

    public function getTotalUsers() {
        return $this->all();
    }

    // Method for user registration
    public function register($username, $email, $password, $confirm_password, $first_name, $last_name, $phone_number, $address, $city, $postal_code, $country) {
        // Validate required fields
        if (empty($username) || empty($email) || empty($first_name) || empty($last_name) || 
            empty($phone_number) || empty($address) || empty($password) || empty($confirm_password) || 
            empty($country) || empty($city) || empty($postal_code)) {
            return ['status' => 'error', 'message' => "All fields are required."];
        }

        // Check if passwords match
        if ($password !== $confirm_password) {
            return ['status' => 'error', 'message' => "Passwords do not match."];
        }

        // Validate password strength
        if (!$this->isValidPassword($password)) {
            return ['status' => 'error', 'message' => "Password must meet security requirements."];
        }

        // Check if email already exists
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        if ($stmt->rowCount() > 0) {
            return ['status' => 'error', 'message' => "Email already exists."];
        }

        // Check if username already exists
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->execute(['username' => $username]);
        if ($stmt->rowCount() > 0) {
            return ['status' => 'error', 'message' => "Username already exists."];
        }

        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        
        try {
            $this->pdo->beginTransaction();

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
            
            $this->pdo->commit();
            return ['status' => 'success', 'message' => "Registration successful!"];
        } catch (PDOException $e) {
            $this->pdo->rollBack();
            return ['status' => 'error', 'message' => "Registration failed. Please try again."];
        }
    }

    // Method for user login
    public function login($email, $password) {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = :email LIMIT 1");
        $stmt->execute(['email' => $email]);
    
        if ($stmt->rowCount() > 0) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if ((int)$user['status'] !== 1) {
                return ['status' => 'error', 'message' => "Your account is disabled."];
            }
            if (password_verify($password, $user['password'])) {
                // Set session variables
                $_SESSION['user_id'] = $user['id']; // Ensure this line is executed
                $_SESSION['username'] = $user['username']; // Set username or any other necessary info
    
                return [
                    'status' => 'success', 
                    'user_id' => $user['id'],  // Include user ID
                    'username' => $user['username'] // Include username if needed
                ];
            }
            return ['status' => 'error', 'message' => "Incorrect password."];
        }
        return ['status' => 'error', 'message' => "Email not found."];
    }
    
    

    // Method to validate password strength
    private function isValidPassword($password) {
        return preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/', $password);
    }

    // Fetch user data by username
    public function getUserByUsername($username) {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Fetch user data by email
    public function getUserByEmail($email) {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    // Update user profile
    public function updateUserProfile($username, $data) {
        // Prepare the base SQL statement
        $sql = "UPDATE users SET first_name = :first_name, last_name = :last_name, phone_number = :phone_number, 
                address = :address, city = :city, country = :country, postal_code = :postal_code";
        
        $params = [
            ':first_name' => $data['first_name'],
            ':last_name' => $data['last_name'],
            ':phone_number' => $data['phone_number'],
            ':address' => $data['address'],
            ':city' => $data['city'],
            ':country' => $data['country'],
            ':postal_code' => $data['postal_code'],
        ];
        
        // Include username and email in the update if they are set
        if (isset($data['username'])) {
            $sql .= ", username = :username";
            $params[':username'] = $data['username'];
        }
        if (isset($data['email'])) {
            $sql .= ", email = :email";
            $params[':email'] = $data['email'];
        }
        
        $sql .= " WHERE username = :current_username";
        $params[':current_username'] = $username;
        
        // Prepare and execute the statement
        $stmt = $this->pdo->prepare($sql);
        
        return $stmt->execute($params) ? ['status' => 'success', 'message' => "Profile updated successfully."] : ['status' => 'error', 'message' => "Profile update failed."];
    }

    // Fetch user data by ID
    public function getUserById($userId) {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE id = :id LIMIT 1");
        $stmt->bindParam(':id', $userId, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC); // Return user data or false if not found
    }

    // Method to change password
    public function changePassword($userId, $currentPassword, $newPassword) {
        // Get the current user by ID
        $user = $this->getUserById($userId);

        if (!$user) {
            return ['status' => 'error', 'message' => "User not found."];
        }

        // Verify the current password
        if (!password_verify($currentPassword, $user['password'])) {
            return ['status' => 'error', 'message' => "Current password is incorrect."];
        }

        // Validate new password strength
        if (!$this->isValidPassword($newPassword)) {
            return ['status' => 'error', 'message' => "New password does not meet security requirements."];
        }

        // Hash the new password
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        // Update password in the database
        $stmt = $this->pdo->prepare("UPDATE users SET password = :password WHERE id = :id");
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->bindParam(':id', $userId, PDO::PARAM_INT);

        return $stmt->execute() ? ['status' => 'success', 'message' => "Password changed successfully."] : ['status' => 'error', 'message' => "Password change failed. Please try again."];
    }
}
