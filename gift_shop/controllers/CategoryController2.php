<?php
require_once __DIR__ . '/../models/Category.php';
require_once __DIR__ . '/../models/Product.php';

class CategoryController2 extends Controller {
    public $categoryModel;

    public function __construct() {
        $this->categoryModel = $this->model('Category');
    }

    // Show main categories page
    public function index() {
        if (!isset($_SESSION["admin_id"])) {
            header('Location: /admin/login');
            exit();
        }
        $categories = $this->categoryModel->all();
        $this->view('admin/Categories/index', ['categories' => $categories]);
    }

    public function create() {
        if (!isset($_SESSION["admin_id"])) {
            header('Location: /admin/login');
            exit();
        }
        $this->view('admin/Categories/create');
    }

    public function store() {
        if (!isset($_SESSION["admin_id"])) {
            header('Location: /admin/login');
            exit();
        }
        $data = [
            'category_name' => $_POST['name'],
            'description' => $_POST['description'],
            'image_url' => $_POST['image_url']
        ];
        $this->categoryModel->create($data);

        $categories = $this->categoryModel->all();
        $this->view('admin/Categories/index', ['categories' => $categories]);
    }
    public function edit($id) {
        if (!isset($_SESSION["admin_id"])) {
            header('Location: /admin/login');
            exit();
        }
        $categories = $this->categoryModel->all();
        $this->view('admin/Categories/index', ['categories' => $categories]);
    }


    // Handle update form submission
    public function update($id) {
        if (!isset($_SESSION["admin_id"])) {
            header('Location: /admin/login');
            exit();
        }
        $data = [
            'category_name' => $_POST['name'],
            'description' => $_POST['description'],
            'image_url' => $_POST['image_url']
        ];
        $this->categoryModel->update($id, $data);
        $categories = $this->categoryModel->all();
        $this->view('admin/Categories/index', ['categories' => $categories]);
    }

    // Delete a category
    public function delete($id) {
        if (!isset($_SESSION["admin_id"])) {
            header('Location: /admin/login');
            exit();
        }
        $this->categoryModel->delete($id);
        $categories = $this->categoryModel->all();
        $this->view('admin/Categories/index', ['categories' => $categories]);
    }


    public function getProductsByCategory($categoryId) {
        if (!isset($_SESSION["admin_id"])) {
            header('Location: /admin/login');
            exit();
        }
        $productModel = new Product();
        $products = $productModel->getProductsByCategory($categoryId);
        $this->view('products/index', ['products' => $products]);
    }
    public function show($id)
    {
        if (!isset($_SESSION["admin_id"])) {
            header('Location: /admin/login');
            exit();
        }
        $categoryModel = new Category();
        $category = $categoryModel->find($id);
        $this->view('categories/show', ['category' => $category]);
    }


}
