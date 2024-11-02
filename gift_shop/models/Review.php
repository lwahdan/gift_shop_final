<?php
require_once 'BaseModel.php';

class Review extends BaseModel
{
    public function __construct()
    {
        // Initialize BaseModel with the "reviews" table name
        parent::__construct("reviews");
    }

    // Method to create a new review
    public function create($data)
{
    try {
        $keys = implode(',', array_keys($data));
        $tags = ':' . implode(', :', array_keys($data));
        $sql = "INSERT INTO $this->table ($keys) VALUES ($tags)";
        $statement = $this->pdo->prepare($sql);

        // Log the SQL and data being executed
        error_log("Executing SQL: $sql with data: " . print_r($data, true));

        if (!$statement->execute($data)) {
            throw new Exception("Failed to execute statement: " . implode(", ", $statement->errorInfo()));
        }
        
        return true; // Indicate success
    } catch (PDOException $e) {
        error_log("PDO error: " . $e->getMessage()); // Log PDO exception
        throw new Exception("Database error: " . $e->getMessage());
    }
}

    public function findById($userId)
    {
        $stmt = $this->pdo->prepare("SELECT username, email FROM users WHERE id = :id");
        $stmt->bindParam(':id', $userId);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC); // Return the user data
    }
   
    public function getReviewsByProductId($productId) {
        $stmt = $this->pdo->prepare("SELECT * FROM reviews WHERE product_id = :product_id AND status = 'approved'");
        $stmt->bindParam(':product_id', $productId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
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
    
        
    
        // Hash the new password
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
    
        // Update password in the database
        $stmt = $this->pdo->prepare("UPDATE users SET password = :password WHERE id = :id");
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->bindParam(':id', $userId, PDO::PARAM_INT);
    
        return $stmt->execute() ? 
            ['status' => 'success', 'message' => "Password changed successfully."] : 
            ['status' => 'error', 'message' => "Password change failed. Please try again."];
    }
    // Fetch user data by ID
public function getUserById($userId) {
    $stmt = $this->pdo->prepare("SELECT * FROM users WHERE id = :id LIMIT 1");
    $stmt->bindParam(':id', $userId, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC); // Return user data or false if not found
}

    
    
    

}
