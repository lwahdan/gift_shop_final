<?php
$coupon_active = "active";
require $_SERVER['DOCUMENT_ROOT'] . "/views/admin/partials/header.php";
?>
<div class="cont">
<br>
<h2 class="form-title">Add Coupon</h2>
<br>
</div>
<form method="POST" class="coupon-form">
    <div class="form-group">
        <label class="form-label">Code:</label>
        <input type="text" name="code" class="form-control" required>
    </div>

    <div class="form-group">
        <label class="form-label">Discount Type:</label>
        <select name="discount_type" class="form-control">
            <option value="Percentage">Percentage</option>

        </select>
    </div>

    <div class="form-group">
        <label class="form-label">Discount Value:</label>
        <input type="number" name="discount_value" class="form-control" required>
    </div>

    <div class="form-group">
        <label class="form-label">Expiration Date:</label>
        <input type="date" name="expiration_date" class="form-control">
    </div>

    <div class="form-group2">
        <label class="form-label">Is Active:</label>
        <input type="checkbox" name="is_active" value="1" class="form-checkbox" checked>
    </div>

    <button type="submit" class="form-button">Save Coupon</button>
</form>
<?php
require $_SERVER['DOCUMENT_ROOT'] . "/views/admin/partials/footer.php";
?>
