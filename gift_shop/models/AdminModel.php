<?php
require_once 'BaseModel.php';

class AdminModel extends BaseModel
{
    protected $table = 'admins';

    public function __construct()
    {
        parent::__construct('admins'); // Set table name to "admins"
    }
    public function findByUsername($username)
    {
        $sql = "SELECT * FROM {$this->table} WHERE username = :username LIMIT 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function findByEmail($email)
    {
        $sql = "SELECT * FROM {$this->table} WHERE email = :email LIMIT 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function verifyPassword($password, $hashedPassword)
    {
        return password_verify($password, $hashedPassword);
    }
    public function getAdminsByRole($roleId)
    {
        $statement = $this->pdo->prepare("SELECT * FROM $this->table WHERE role_id = :role_id");
        $statement->bindValue(':role_id', $roleId);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTotalAdmins() {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) AS total FROM admins");
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }
}
