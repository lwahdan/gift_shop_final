<?php
// File: controllers/ProductController.php

require_once 'models/Product.php';

class ProductController
{
    public $productModel;

    public function __construct()
    {
        $this->productModel = new Product();
    }

    public function index()
    {
        // Fetch all products
        $products = $this->productModel->all();

        // Define the directory path for images
        $dir = '../public/images/imgs/';

        // Pass data to the view
        include __DIR__.'/../views/customers/index.php';

    }
}
?>
