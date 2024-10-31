<?php

require_once 'Controller.php';
require_once __DIR__ . '/../models/Category.php';

class CategoryController extends Controller
{
    public function index()
    {
        $categoryModel = new Category();
        $categories = $categoryModel->all();
        $this->view('categories/index', ['categories' => $categories]);
    }

    public function create()
    {
        $this->view('categories/create');
    }

    public function store()
    {
        $data = [
            'name' => $_POST['name']
        ];
        $categoryModel = new Category();
        $categoryModel->create($data);
        header("Location: /categories"); // Redirect to categories index
    }

    public function edit($id)
    {
        $categoryModel = new Category();
        $category = $categoryModel->find($id);
        $this->view('categories/edit', ['category' => $category]);
    }

    public function update($id)
    {
        $data = [
            'name' => $_POST['name']
        ];
        $categoryModel = new Category();
        $categoryModel->update($id, $data);
        header("Location: /categories");
    }

    public function delete($id)
    {
        $categoryModel = new Category();
        $categoryModel->delete($id);
        header("Location: /categories");
    }
}
