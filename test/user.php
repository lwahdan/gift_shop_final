<?php
include_once 'Database.php';

class User {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->dbConnection();
    }

    public function register($username, $email, $password, $confirm_password, $first_name, $last_name, $phone_number, $address, $city, $postal_code, $country) {
        // Validate inputs
        if (empty($username) || empty($email) || empty($first_name) || empty($last_name) || empty($phone_number) || empty($address) || empty($password) || empty($confirm_password) || empty($country) || empty($city) || empty($postal_code)) {
            return ['m' => 'error', 'message' => "All fields are required."];
        }

        // Trim the password inputs
        $password = trim($password);
        $confirm_password = trim($confirm_password);

        // Password and Confirm Password validation
        if ($password !== $confirm_password) {
            error_log("Passwords: [$password] vs [$confirm_password]");
            return ['m' => 'error', 'message' => "Passwords do not match."];
        }

        // Check if the password is valid
        if (!$this->isValidPassword($password)) {
            return ['m' => 'error', 'message' => "Password must be at least 8 characters long, contain at least 1 number, 1 lowercase letter, 1 uppercase letter, and 1 special character."];
        }

        // Check if email already exists
        $query = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        
        if ($stmt->rowCount() > 0) {
            return ['m' => 'error', 'message' => "Email already exists."];
        }
        $query = "SELECT * FROM users WHERE username = :username";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        
        if ($stmt->rowCount() > 0) {
            return ['m' => 'error', 'message' => "Username already exists."];
        }

        // Insert user into database
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $query = "INSERT INTO users (username, email, first_name, last_name, phone_number, address, city,postal_code, country,  password) 
          VALUES (:username, :email, :first_name, :last_name, :phone_number, :address, :city, :postal_code,:country, :password)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':first_name', $first_name);
        $stmt->bindParam(':last_name', $last_name);
        $stmt->bindParam(':phone_number', $phone_number);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':city', $city);
        $stmt->bindParam(':country', $country);
        $stmt->bindParam(':postal_code', $postal_code);
        $stmt->bindParam(':password', $hashedPassword);
        

        if ($stmt->execute()) {
            return ['m' => 'success', 'message' => "Registration successful!"];
        } else {
            return ['m' => 'error', 'message' => "Registration failed. Please try again."];
        }
    }

    public function login($email, $password) {
        $query = "SELECT * FROM users WHERE email = :email LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($user['status'] !== 1) {
                return ['m' => 'error', 'message' => "Your account is disabled. Please contact support."];
            }
            if (password_verify($password, $user['password'])) {
                return ['m' => 'success', 'message' => "Login successful!", 'username' => $user['username']]; // Changed 'name' to 'username'
            } else {
                return ['m' => 'error', 'message' => "Incorrect password."];
            }
        } else {
            return ['m' => 'error', 'message' => "Email not found."];
        }
    }

    private function isValidPassword($password) {
        // Log the password being validated for debugging
        error_log("Validating password: '" . $password . "'");

        // Perform regex check
        return preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/', $password);
    }

    public function sendPasswordResetEmail($email) {
        // Check if email exists
        $query = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
    
        if ($stmt->rowCount() > 0) {
            // Generate a unique token
            $token = bin2hex(random_bytes(50));
            $expires = date("Y-m-d H:i:s", strtotime("+1 hour"));
    
            // Store token in the database
            $query = "INSERT INTO password_resets (email, token, expires) VALUES (:email, :token, :expires)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':token', $token);
            $stmt->bindParam(':expires', $expires);
            $stmt->execute();
    
            // Send email
            $resetLink = "http://yourdomain.com/reset_password.php?token=$token"; // Change to your domain
            mail($email, "Password Reset Request", "Click this link to reset your password: $resetLink");
    
            return ['m' => 'success', 'message' => "A password reset link has been sent to your email."];
        } else {
            return ['m' => 'error', 'message' => "Email does not exist."];
        }
    }
    
    public function resetPassword($token, $newPassword) {
        // Validate the token
        $query = "SELECT * FROM password_resets WHERE token = :token AND expires > NOW() LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':token', $token);
        $stmt->execute();
    
        if ($stmt->rowCount() > 0) {
            $reset = $stmt->fetch(PDO::FETCH_ASSOC);
            $email = $reset['email'];
    
            // Update the password
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            $query = "UPDATE users SET password = :password WHERE email = :email";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':password', $hashedPassword);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
    
            // Delete the token
            $query = "DELETE FROM password_resets WHERE token = :token";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':token', $token);
            $stmt->execute();
    
            return ['m' => 'success', 'message' => "Password has been reset successfully."];
        } else {
            return ['m' => 'error', 'message' => "Invalid or expired token."];
        }
    }
}

?>
