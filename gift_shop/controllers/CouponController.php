<?php
require_once 'BaseController.php';
require_once __DIR__ . '/../models/CouponModel.php';
require_once __DIR__ . '/../models/CartModel.php';

class CouponController extends Controller
{
    private $model;

    public function __construct()
    {

        $this->model = $this->model('CouponModel');
    }

    public function index() {
        if (!isset($_SESSION["admin_id"])) {
            header('Location: /admin/login');
            exit();
        }
        // Get filters from the GET request
        $filters = [];
        if (isset($_GET['status']) && $_GET['status'] !== '') {
            $filters['status'] = $_GET['status'];
        }
        if (isset($_GET['discount']) && $_GET['discount'] !== '') {
            $filters['discount'] = $_GET['discount'];
        }
        if (isset($_GET['date']) && $_GET['date'] !== '') {
            $filters['date'] = $_GET['date'];
        }

        // Fetch coupons with the filters
        $coupons = $this->model->getCoupons($filters);

        // Include the view and pass the coupons data
        $this->view('admin/coupons/index', ['coupons' => $coupons]);
    }

    public function create()
    {
        if (!isset($_SESSION["admin_id"])) {
            header('Location: /admin/login');
            exit();
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'code' => $_POST['code'],
                'discount_value' => $_POST['discount_value'],
                'expiration_date' => $_POST['expiration_date'],
                'is_active' => isset($_POST['is_active']) ? 1 : 0,

            ];
            $this->model->create($data);
            header("Location: /views/admin/coupons");
            exit;
        }

        include 'views/admin/coupons/add.php';
    }

    public function edit($id)
    {
        if (!isset($_SESSION["admin_id"])) {
            header('Location: /admin/login');
            exit();
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'code' => $_POST['code'],
                'discount_value' => $_POST['discount_value'],
                'expiration_date' => $_POST['expiration_date'],
                'is_active' => isset($_POST['is_active']) ? 1 : 0,

            ];
            $this->model->update($id, $data);
            header("Location: /admin/coupons");
            exit;
        }

        $coupon = $this->model->find($id);
        include 'views/admin/coupons/edit.php';
    }

    public function delete($id)
    {
        if (!isset($_SESSION["admin_id"])) {
            header('Location: /admin/login');
            exit();
        }
        $this->model->delete($id);
        header("Location: /admin/coupons");
        exit;
    }

    public function toggleStatus($id, $status)
    {
        if (!isset($_SESSION["admin_id"])) {
            header('Location: /admin/login');
            exit();
        }
        $this->model->update($id, ['is_active' => $status]);
        header("Location: /admin/coupons");
        exit;
    }
}