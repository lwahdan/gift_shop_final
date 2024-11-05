<?php
require $_SERVER['DOCUMENT_ROOT'] . "/views/admin/partials/header.php";
?>
<div class="cont">

<br><br>
<a href="/admin/coupons/create" class="btn-blue">Add New Coupon</a>

    <h2>Coupons</h2>
</div>
<?php
echo '<div class="cardBox">';
if (isset($coupons)) {
    foreach ($coupons as $coupon) {
        echo '
            <div class="card">
                <div>
                    <div class="numbers2">
                        <h1>' . htmlspecialchars($coupon['discount_value']) . '</h1>
                        <h3>code ' . htmlspecialchars($coupon['id']) . ' : ' . htmlspecialchars($coupon['code']) . '</h3>
                    </div>
                    <div class="cardName">' . htmlspecialchars($coupon['updated_at']) . '</div>
                </div>
                <div class="iconBx">
                    <ion-icon name="pricetags-outline"></ion-icon>
                    <a href="/admin/coupons/edit/' . $coupon['id'] . '" class="btn-blue">Edit</a>
                    <a href="/admin/coupons/toggleStatus/' . $coupon['id'] . '/' . ($coupon['is_active'] ? 0 : 1) . '" class="' . ($coupon['is_active'] == 1 ? 'btn-danger' : 'btn-Green') . '">
    ' . ($coupon['is_active'] ? 'Deactivate' : 'Activate') . '
</a>

                </div>
            </div>';
    }
}
echo '</div>';
?>

<?php
require $_SERVER['DOCUMENT_ROOT'] . "/views/admin/partials/footer.php";
?>
