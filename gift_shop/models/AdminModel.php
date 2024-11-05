<?php
require_once 'BaseModel.php';

class AdminModel extends BaseModel
{
    public function __construct()
    {
        parent::__construct('admins'); // Set table name to "admins"
    }

    // Any admin-specific methods can be added here
    // For example, a method to find admins by role:
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
