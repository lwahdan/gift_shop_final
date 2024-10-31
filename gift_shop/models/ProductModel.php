<?php
require_once 'BaseModel.php';
class ProductModel extends BaseModel
{
    public function __construct()
    {
        parent::__construct('products');
    }

    // Method to fetch product details by ID
    public function getProductById($id)
    {
        $stmt = $this->pdo->prepare("SELECT id, product_name, price, image_url FROM products WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
