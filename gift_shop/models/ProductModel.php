<?php
require_once 'BaseModel.php';

class ProductModel extends BaseModel {
    public function __construct()
    {
        parent::__construct('products');
    }

    public function getTotalProducts() {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) AS total FROM products");
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }
    public function getProductsByCategory($categoryId) {
        $sql = "SELECT * FROM products WHERE category_id = :category_id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':category_id', $categoryId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
   
}
?>
