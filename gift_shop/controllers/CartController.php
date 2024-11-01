<?php
require_once 'BaseController.php';
require_once __DIR__ . '/../models/ProductModel.php';
require_once __DIR__ . '/../models/CartModel.php';

class CartController extends Controller
{
    private $cartModel;
    private $productModel;

    public function __construct()
    {
        $this->cartModel = new CartModel();
        $this->productModel = new ProductModel();
    }

    public function add()
    {
        $productId = $_POST['product_id'] ?? null;

        if ($productId) {
            $product = $this->productModel->find($productId);

            if ($product) {
                $this->cartModel->addToCart($product);
                header("Location: /customers/cart"); // Redirect to cart page after adding
                exit();
            }
        }

        header("Location: /customers/index");
        exit();
    }

    public function index()
    {
    $cartItems = $this->cartModel->getCartItems();
    $dir = "/gift_shop/public/images/product/default/";  // Define the image directory path
    $this->view('customers/cart', ['cartItems' => $cartItems, 'dir' => $dir]);
    }


    public function remove()
    {
        $productId = $_POST['product_id'] ?? null;

        if ($productId) {
            $this->cartModel->removeFromCart($productId);
        }

        header("Location: /customers/cart");
        exit();
    }
}
