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
}
?>
