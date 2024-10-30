
<!--// controllers/DashboardController.php-->
<?php
require_once 'BaseController.php';

class DashboardController extends Controller {
    private $userModel;
    private $productModel;
    private $commentModel;
    private $couponModel;

    public function __construct() {
        $this->userModel = $this->model('UserModel');
        $this->productModel = $this->model('ProductModel');
        $this->commentModel = $this->model('CommentModel');
        $this->couponModel = $this->model('CouponModel');
    }

    public function index() {
        $data = [
            'totalUsers' => $this->userModel->getTotalUsers(),
            'totalProducts' => $this->productModel->getTotalProducts(),
            'totalComments' => $this->commentModel->getTotalComments(),
            'totalCoupons' => $this->couponModel->getTotalCoupons()
        ];

        $this->view('admin/dashboard/index', $data);
    }
}
