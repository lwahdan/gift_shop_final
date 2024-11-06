<?php


class CustomerController extends Controller
{

    private $categoryModel;

    public function __construct()
    {

        $this->categoryModel = $this->model('Category');
    }





    public function home()
    {


        // Get all categories
        $categories = $this->categoryModel->all();

        // Load the view with both products and categories
        $this->view('customers/about-us', [

            'categories' => $categories
        ]);
    } public function home2()
    {


        // Get all categories
        $categories = $this->categoryModel->all();

        // Load the view with both products and categories
        $this->view('customers/contact-us', [

            'categories' => $categories
        ]);
    }
 public function _404(){
   $this->view('customers/_404');
 }

public function about(){
    $this->view('customers/about-us');
}

public function cart(){
    $this->view('customers/cart');
 }


 public function checkout(){
    // Check if the 'cart' cookie is set and contains items
    if (!isset($_COOKIE['cart']) || empty(json_decode($_COOKIE['cart'], true))) {
        header('Location: /customers/cart');
        exit();
    }
    $this->view('customers/checkout');
}

public function contact(){
    $this->view('customers/contact-us');
 }

public function faq(){
    $this->view('customers/faq');
}

public function index(){
    $this->view('customers/index');
 }

public function login()
{
    $this->view('customers/login');
}

public function account(){
    $this->view('customers/my-account');
}

public function privacy(){
    $this->view('customers/privacy');
}

public function product(){
    $this->view('customers/product-details-default');
 }

 public function wishlist(){
     $this->view('customers/wishlist');
 }


}