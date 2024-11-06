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
    public function getAverageRating($product_id) {
        $sql = "SELECT COALESCE(AVG(rating), 0) AS average_rating
                FROM reviews
                WHERE product_id = :product_id";
    
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':product_id', $product_id, PDO::PARAM_INT);
        $stmt->execute();
    
        return $stmt->fetchColumn();  // Returns the average rating
    }
    
    public function getFilteredProducts($category, $price_min, $price_max, $sort) {
        $sql = "SELECT * FROM products WHERE 1=1";
    
        if ($category) {
            $sql .= " AND category_id = :category";
        }
        if ($price_min) {
            $sql .= " AND price >= :price_min";
        }
        if ($price_max) {
            $sql .= " AND price <= :price_max";
        }
    
        switch ($sort) {
            case 'price_asc':
                $sql .= " ORDER BY price ASC";
                break;
            case 'price_desc':
                $sql .= " ORDER BY price DESC";
                break;
            default:
                $sql .= " ORDER BY created_at DESC";
                break;
        }
    
        $stmt = $this->pdo->prepare($sql);
        if ($category) $stmt->bindValue(':category', $category, PDO::PARAM_INT);
        if ($price_min) $stmt->bindValue(':price_min', $price_min, PDO::PARAM_INT);
        if ($price_max) $stmt->bindValue(':price_max', $price_max, PDO::PARAM_INT);
    
        $stmt->execute();
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        // Calculate average rating for each product
        foreach ($products as &$product) {
            $product['average_rating'] = $this->getAverageRating($product['id']);
        }
    
        // Sort products by average rating if needed
        if ($sort === 'rating') {
            usort($products, function($a, $b) {
                return $b['average_rating'] <=> $a['average_rating'];
            });
        }
    
        return $products;
    }
    
    
    
}
?>
