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
        if ($this->getUserByEmail($email)) {
            return ['status' => 'error', 'message' => "Email already exists."];
        }

        // Check if username already exists
        if ($this->getUserByUsername($username)) {
            return ['status' => 'error', 'message' => "Username already exists."];
        }

        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        
        try {
            $this->pdo->beginTransaction();

           
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
            
            $this->pdo->commit();
            return ['status' => 'success', 'message' => ""]; 
        } catch (PDOException $e) {
            $this->pdo->rollBack();
            return ['status' => 'error', 'message' => "Registration failed. Please try again."];
        }
    }

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
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];

                return [
                    'status' => 'success', 
                    'user_id' => $user['id'],
                    'username' => $user['username']
                ];
            }
            return ['status' => 'error', 'message' => "Incorrect password."];
        }
        return ['status' => 'error', 'message' => "Email not found."];
    }

    private function isValidPassword($password) {
        return preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/', $password);
    }

    public function getUserByUsername($username) {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getUserByEmail($email) {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function updateUserProfile($username, $data) {
        $sql = "UPDATE users SET username= :username, email=:email, first_name = :first_name, last_name = :last_name, phone_number = :phone_number, 
                address = :address, city = :city, country = :country, postal_code = :postal_code";
        
        $params = [
            ':username' => $data['username'],
            ':email' => $data['email'],
            ':first_name' => $data['first_name'],
            ':last_name' => $data['last_name'],
            ':phone_number' => $data['phone_number'],
            ':address' => $data['address'],
            ':city' => $data['city'],
            ':country' => $data['country'],
            ':postal_code' => $data['postal_code'],
        ];
        
        if (!empty($data['username'])) {
            $sql .= ", username = :username";
            $params[':username'] = $data['username'];
        }
        if (!empty($data['email'])) {
            $sql .= ", email = :email";
            $params[':email'] = $data['email'];
        }
        
        $sql .= " WHERE username = :current_username";
        $params[':current_username'] = $username;
        
        $stmt = $this->pdo->prepare($sql);
        
        return $stmt->execute($params) ? ['status' => 'success', 'message' => "Profile updated successfully."] : ['status' => 'error', 'message' => "Profile update failed."];
    }

    public function getUserById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch() ?: null; // Return null if no user is found
    }

    public function updatePassword($userId, $newPassword) {
        $stmt = $this->pdo->prepare("UPDATE users SET password = :password WHERE id = :id");
        $stmt->bindParam(':password', $newPassword);
        $stmt->bindParam(':id', $userId);
        return $stmt->execute();
    }

    public function changePassword($userId, $currentPassword, $newPassword) {
        $user = $this->getUserById($userId);

        if (!$user) {
            return ['status' => 'error', 'message' => "User not found."];
        }

        if (!password_verify($currentPassword, $user['password'])) {
            return ['status' => 'error', 'message' => "Current password is incorrect."];
        }

        if (!$this->isValidPassword($newPassword)) {
            return ['status' => 'error', 'message' => "New password does not meet security requirements."];
        }

        if ($currentPassword === $newPassword) {
            return ['status' => 'error', 'message' => "New password cannot be the same as the current password."];
        }

        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        return $this->updatePassword($userId, $hashedPassword) ? ['status' => 'success', 'message' => "Password changed successfully."] : ['status' => 'error', 'message' => "Password change failed. Please try again."];
    }

    public function getUserAddressById($userId) {
        $stmt = $this->pdo->prepare("SELECT address, city, postal_code, country FROM users WHERE id = :id");
        $stmt->execute(['id' => $userId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
