<?php

class BaseModel
{
    protected $pdo;
    protected $table;
    protected $timestampColumn;


    public function __construct($table, $timestampColumn = 'created_at')
    {
        $this->timestampColumn = $timestampColumn;
        $this->table = $table;
        $server_name = $_ENV['DB_SERVER'];
        $database_name = $_ENV['DB_DATABASE'];
        $username = $_ENV['DB_USERNAME'];
        $password = $_ENV['DB_PASSWORD'];

        $dsn = "mysql:host=$server_name;dbname=$database_name";

        try {
            $this->pdo = new PDO($dsn, $username, $password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public function all()
    {
        $sql = "SELECT * FROM $this->table ORDER BY id  DESC";
        $statement = $this->pdo->prepare($sql);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find($id)
    {
        $statement = $this->pdo->prepare("SELECT * FROM $this->table WHERE id = :id");
        $statement -> bindValue(':id', $id);
        $statement->execute();
        return $statement->fetch(\pdo::FETCH_ASSOC);

    }

    public function create($data)
    {
        $keys = implode(',', array_keys($data));
        $tags = ':' . implode(', :', array_keys($data));  // Fixed spacing issue here
        $sql = "INSERT INTO $this->table ($keys) VALUES ($tags)";
        $statement = $this->pdo->prepare($sql);
        $statement->execute($data);
        return $this->pdo->lastInsertId();
    }

    public function update($id, $data) {
        // Build the SET part of the query dynamically based on the keys in $data
        $fields = [];
        foreach ($data as $key => $value) {
            $fields[] = "$key = :$key";
        }
        $fields = implode(", ", $fields);
    
        // Prepare the SQL statement
        $sql = "UPDATE {$this->table} SET $fields WHERE id = :id";
        $statement = $this->pdo->prepare($sql);
    
        // Bind each parameter from the $data array
        foreach ($data as $key => $value) {
            $statement->bindValue(":$key", $value);
        }
    
        // Bind the ID parameter
        $statement->bindValue(":id", $id);
    
        // Execute the statement
        return $statement->execute();
    }
    

    public function delete($id)
    {
        $statement = $this->pdo->prepare( "DELETE FROM $this->table WHERE id = :id");
        $statement -> bindValue(':id', $id);
        $statement->execute();

    }
    public function getAllByUserId($userId) {
        $stmt = $this->pdo->prepare("SELECT * FROM $this->table WHERE user_id = :user_id");
        $stmt->execute(['user_id' => $userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Use fetchAll to get multiple records
    }

}