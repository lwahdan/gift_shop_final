<?php
require $_SERVER['DOCUMENT_ROOT'] . "/views/admin/partials/header.php";
?>
<div class="cont">
    <br>
    <h2 class="form-title">Edit Coupon</h2>
    <br>
</div>
<form method="POST" class="coupon-form">
    <div class="form-group">
        <label class="form-label">Code:</label>
        <input type="text" name="code" class="form-control" value="<?php if (isset($coupon)) {
            echo htmlspecialchars($coupon['code']);
        } ?>" required>
    </div>

    <div class="form-group">
        <label class="form-label">Discount Value:</label>
        <input type="number" name="discount_value" class="form-control" value="<?php echo htmlspecialchars($coupon['discount_value']); ?>" required>
    </div>

    <div class="form-group">
        <label class="form-label">Expiration Date:</label>
        <input type="date" name="expiration_date" class="form-control" value="<?php echo htmlspecialchars($coupon['expiration_date']); ?>">
    </div>

    <div class="form-group2">
        <label class="form-label">Is Active:</label>
        <input type="checkbox" name="is_active" class="form-checkbox" value="1" <?php echo $coupon['is_active'] ? 'checked' : ''; ?>>
    </div>

    <button type="submit" class="form-button">Update Coupon</button>
</form>
<?php
require $_SERVER['DOCUMENT_ROOT'] . "/views/admin/partials/footer.php";
?>
