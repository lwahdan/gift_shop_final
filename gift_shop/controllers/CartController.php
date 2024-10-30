<?php

require_once __DIR__.'/../models/Cart.php';

class CartController {
    private $cart;

    public function __construct() {
        $this->cart = new Cart();
    }

    public function add($productId, $quantity = 1) {
        $this->cart->addItem($productId, $quantity);
        header("Location: /cart/show"); // Redirect to the cart view after adding
    }

    public function remove($productId) {
        $this->cart->removeItem($productId);
        header("Location: /cart/show"); // Redirect to the cart view after removing
    }

    public function update($productId, $quantity) {
        $this->cart->updateItem($productId, $quantity);
        header("Location: /cart/show"); // Redirect to the cart view after updating
    }

    public function show() {
        $items = $this->cart->getItems();
        require 'cart_view.php'; // Load the cart view
    }

    public function clear() {
        $this->cart->clearCart();
        header("Location: /cart/show"); // Redirect to the cart view after clearing
    }
}
