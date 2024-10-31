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

    // Add any product-specific methods here if needed in the future
}
?>
