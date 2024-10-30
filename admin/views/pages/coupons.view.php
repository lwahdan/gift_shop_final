<div class="container-table">
    <button class="btn-blue" onclick="toggleForm('CouponForm')">+ Add New Coupon</button>
    <br>
    <br>
 </div>
<?php require 'dashboard.php';
$comment= new dashboard();
$comment->displayAllCoupons();
?>