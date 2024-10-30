
<!--// models/CategoryModel.php-->
<?php
require_once 'BaseModel.php';

class CategoryModel extends BaseModel {
    public function __construct() {
        parent::__construct('categories');
    }

    public function getAllCategories() {
        $stmt = $this->pdo->prepare("SELECT * FROM categories ORDER BY created_at ASC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

