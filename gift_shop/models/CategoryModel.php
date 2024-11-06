<?php
require_once 'BaseModel.php';

class CategoryModel extends BaseModel
{
    public function __construct()
    {
        parent::__construct('categories');
    }

    public function update($id, $data) {
        $sql = "UPDATE categories SET category_name = :name, description = :description, image_url = :image_url WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':name', $data['category_name']);
        $stmt->bindParam(':description', $data['description']);
        $stmt->bindParam(':image_url', $data['image_url']);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    // Delete a category
    public function delete($id) {
        $sql = "DELETE FROM categories WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
