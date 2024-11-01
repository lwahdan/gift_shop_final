
<!--// models/ProductModel.php-->
<?php
require_once 'BaseModel.php';

class ProductModel extends BaseModel {
    public function __construct() {
        parent::__construct('products');
    }

    public function getTotalProducts() {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) AS total FROM products");
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }

    public function getProductById($id)
    {
        $stmt = $this->pdo->prepare("SELECT id, product_name, price, image_url FROM products WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

