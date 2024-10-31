
<!--// controllers/DashboardController.php-->
<?php
require_once 'BaseController.php';

class DashboardController extends Controller {
    private $userModel;
    private $productModel;
    private $commentModel;
    private $couponModel;
    private $data;

    public function __construct() {
        $this->userModel = $this->model('UserModel');
        $this->productModel = $this->model('Product');
        $this->commentModel = $this->model('CommentModel');
        $this->couponModel = $this->model('CouponModel');
        $this->data = [
            'totalUsers' => $this->userModel->getTotalUsers(),
            'totalProducts' => $this->productModel->all(),
            'totalComments' => $this->commentModel->getTotalComments(),
            'totalCoupons' => $this->couponModel->getTotalCoupons()
        ];

    }

    public function index() {
        // $data = [
        //     'totalUsers' => $this->userModel->getTotalUsers(),
        //     'totalProducts' => $this->productModel->all(),
        //     'totalComments' => $this->commentModel->getTotalComments(),
        //     'totalCoupons' => $this->couponModel->getTotalCoupons()
        // ];
        $data = $this->data;
        $this->view('admin/dashboard/index', $data);
    }
}
