<?php
require_once 'BaseModel.php';

class CartModel extends BaseModel
{
    private $cookieName = 'cart';

    public function __construct()
    {
        parent::__construct(null); // No specific table needed
    }

    public function getCartItems()
    {
        return isset($_COOKIE[$this->cookieName]) ? json_decode($_COOKIE[$this->cookieName], true) : [];
    }

    public function addToCart($product)
    {
        $cart = $this->getCartItems();
        $productId = $product['id'];

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += 1;
        } else {
            $cart[$productId] = [
                'id' => $productId,
                'name' => $product['product_name'],
                'price' => $product['price'],
                'image_url' => $product['image_url'],
                'quantity' => 1
            ];
        }

        setcookie($this->cookieName, json_encode($cart), time() + (86400 * 30), "/"); // Set cookie for 30 days
    }

    public function removeFromCart($productId)
    {
        $cart = $this->getCartItems();

        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            setcookie($this->cookieName, json_encode($cart), time() + (86400 * 30), "/");
        }
    }

    public function clearCart()
    {
        setcookie($this->cookieName, "", time() - 3600, "/");
    }
}
