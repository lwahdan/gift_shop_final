<?php
// File: models/Product.php

require_once 'BaseModel.php';

class Product extends BaseModel
{
    public function __construct()
    {
        // Initialize BaseModel with "products" table name
        parent::__construct("products");
    }

    public function getTotalProducts() {
        $statement = $this->pdo->query("SELECT COUNT(*) as total FROM products");
        return $statement->fetch(PDO::FETCH_ASSOC)['total'];
    }

   
    public function getProductsByCategory($categoryId) {
        $statement = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE category_id = :categoryId");
        $statement->bindParam(':categoryId', $categoryId, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchAll(\pdo::FETCH_ASSOC);
    }

    public function searchProductsByName($search) {
        $statement = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE product_name like '%$search%'");
        $statement->execute();
        return $statement->fetchAll(\pdo::FETCH_ASSOC);
    }

}
?>