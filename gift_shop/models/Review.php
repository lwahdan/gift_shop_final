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
}
