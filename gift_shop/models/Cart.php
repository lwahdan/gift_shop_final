<?php

class Cart {
    public function __construct() {
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }
    }

    // Add item to cart
    public function addItem($productId, $quantity = 1) {
        if (isset($_SESSION['cart'][$productId])) {
            $_SESSION['cart'][$productId] += $quantity;
        } else {
            $_SESSION['cart'][$productId] = $quantity;
        }
    }

    // Remove item from cart
    public function removeItem($productId) {
        if (isset($_SESSION['cart'][$productId])) {
            unset($_SESSION['cart'][$productId]);
        }
    }

    // Update item quantity in cart
    public function updateItem($productId, $quantity) {
        if (isset($_SESSION['cart'][$productId])) {
            if ($quantity > 0) {
                $_SESSION['cart'][$productId] = $quantity;
            } else {
                $this->removeItem($productId);
            }
        }
    }

    // Get all items from cart
    public function getItems() {
        return $_SESSION['cart'];
    }

    // Clear all items from cart
    public function clearCart() {
        $_SESSION['cart'] = [];
    }
}
