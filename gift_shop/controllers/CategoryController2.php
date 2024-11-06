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
        $categories = $this->categoryModel->all();
        $this->view('admin/Categories/index', ['categories' => $categories]);
    }

    public function create() {
        $this->view('admin/Categories/create');
    }

    public function store() {
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
        $category = $this->categoryModel->find($id);
        $this->view('admin/Categories/edit', ['category' => $category]);
    }


    // Handle update form submission
    public function update($id) {
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
        $this->categoryModel->delete($id);
        $categories = $this->categoryModel->all();
        $this->view('admin/Categories/index', ['categories' => $categories]);
    }


    public function getProductsByCategory($categoryId) {
        $productModel = new Product();
        $products = $productModel->getProductsByCategory($categoryId);
        $this->view('products/index', ['products' => $products]);
    }
    public function show($id)
    {
        $categoryModel = new Category();
        $category = $categoryModel->find($id);
        $this->view('categories/show', ['category' => $category]);
    }


}
