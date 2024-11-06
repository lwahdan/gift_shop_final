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

    public function index()
    {
        $coupons = $this->model->all();
        include 'views/admin/coupons/index.php';
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'code' => $_POST['code'],
                'discount_value' => $_POST['discount_value'],
                'expiration_date' => $_POST['expiration_date'],
                'is_active' => isset($_POST['is_active']) ? 1 : 0,

            ];
            $this->model->create($data);

            $coupons = $this->model->all();
            include 'views/admin/coupons/index.php';

            exit;
        }

        include 'views/admin/coupons/add.php';
    }

    public function edit($id)
    {
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
        $this->model->delete($id);
        header("Location: /admin/coupons");
        exit;
    }

    public function toggleStatus($id, $status)
    {
        $this->model->update($id, ['is_active' => $status]);
        header("Location: /admin/coupons");
        exit;
    }
}