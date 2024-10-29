<?php

class CreateUsersTable{
    public function up(){
        return "CREATE TABLE orders (
        order_id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT,
        order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        status ENUM('Pending', 'Processing', 'Completed', 'Cancelled') DEFAULT 'Pending',
        total_price DECIMAL(10,2) NOT NULL,
        coupon_id INT,
        payment_method ENUM('Cash on Delivery', 'Credit Card', 'Bank Transfer', 'PayPal') DEFAULT 'Cash on Delivery',
        shipping_address TEXT,
        city VARCHAR(100),
        postal_code VARCHAR(20),
        country VARCHAR(100)
        );";
    }

    public function down(){
        return "DROP TABLE orders";
    }
}