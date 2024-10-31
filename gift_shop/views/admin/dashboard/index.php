
<!--// views/admin/dashboard/index.php-->
<?php
require $_SERVER['DOCUMENT_ROOT'] . "/views/admin/partials/header.php";
?>
<div class="cardBox">
    <div class="card">
        <div>
            <div class="numbers"><?php echo $totalUsers; ?></div>
            <div class="cardName">Total Users</div>
        </div>
        <div class="iconBx">
            <ion-icon name="people-outline"></ion-icon>
        </div>
    </div>

    <div class="card">
        <div>
            <div class="numbers"><?php echo $totalProducts; ?></div>
            <div class="cardName">Total Products</div>
        </div>
        <div class="iconBx">
            <ion-icon name="cube-outline"></ion-icon>
        </div>
    </div>

    <div class="card">
        <div>
            <div class="numbers"><?php echo $totalComments; ?></div>
            <div class="cardName">Total Comments</div>
        </div>
        <div class="iconBx">
            <ion-icon name="chatbubbles-outline"></ion-icon>
        </div>
    </div>

    <div class="card">
        <div>
            <div class="numbers"><?php echo $totalCoupons; ?></div>
            <div class="cardName">Total Coupons</div>
        </div>
        <div class="iconBx">
            <ion-icon name="pricetags-outline"></ion-icon>
        </div>
    </div>
</div>

<?php
require $_SERVER['DOCUMENT_ROOT'] . "/views/admin/partials/footer.php";
?>