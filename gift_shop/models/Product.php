<?php

require_once 'BaseModel.php';

class Product extends BaseModel
{
    public function __construct()
    {
        // Initialize BaseModel with "products" table name
        parent::__construct("products");
    }

    public function getTotalProducts()
    {
        $statement = $this->pdo->query("SELECT COUNT(*) as total FROM products");
        return $statement->fetch(PDO::FETCH_ASSOC)['total'];
    }

    public function getProductsByCategory($categoryId)
    {
        $statement = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE category_id = :categoryId");
        $statement->bindParam(':categoryId', $categoryId, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function searchProductsByName($search)
    {
        $statement = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE product_name LIKE :search");
        $search = "%$search%";
        $statement->bindParam(':search', $search, PDO::PARAM_STR);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    // New method to get the stock of a specific product by ID
    public function getStock($productId)
    {
        $statement = $this->pdo->prepare("SELECT stock_quantity FROM {$this->table} WHERE id = :productId");
        $statement->bindParam(':productId', $productId, PDO::PARAM_INT);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result ? $result['stock_quantity'] : null;  // Return null if product not found
    }

    // New method to update the stock of a specific product by ID
    public function updateStock($productId, $newStock)
    {
        $statement = $this->pdo->prepare("UPDATE {$this->table} SET stock_quantity = :newStock WHERE id = :productId");
        $statement->bindParam(':newStock', $newStock, PDO::PARAM_INT);
        $statement->bindParam(':productId', $productId, PDO::PARAM_INT);
        return $statement->execute();
    }
}
?>
