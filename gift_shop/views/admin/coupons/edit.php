<?php
$coupon_active = "active";

require $_SERVER['DOCUMENT_ROOT'] . "/views/admin/partials/header.php";
?>
<div class="container mt-4">
    <h2 class="form-title text-center mb-4">Edit Coupon</h2>

    <form method="POST" class="coupon-form">
        <!-- Coupon Code -->
        <div class="mb-3">
            <label for="code" class="form-label">Code:</label>
            <input type="text" name="code" id="code" class="form-control" value="<?php if (isset($coupon)) {
                echo htmlspecialchars($coupon['code']);
            } ?>" required>
        </div>

        <!-- Discount Value -->
        <div class="mb-3">
            <label for="discount_value" class="form-label">Discount Value:</label>
            <input type="number" name="discount_value" id="discount_value" class="form-control" value="<?php echo htmlspecialchars($coupon['discount_value']); ?>" required>
        </div>

        <!-- Expiration Date -->
        <div class="mb-3">
            <label for="expiration_date" class="form-label">Expiration Date:</label>
            <input type="date" name="expiration_date" id="expiration_date" class="form-control" value="<?php echo htmlspecialchars($coupon['expiration_date']); ?>">
        </div>

        <!-- Is Active -->
        <div class="mb-3 form-check">
            <input type="checkbox" name="is_active" value="1" class="form-check-input" id="is_active" <?php echo $coupon['is_active'] ? 'checked' : ''; ?>>
            <label class="form-check-label" for="is_active">Is Active</label>
        </div>

        <!-- Submit Button -->
        <div class="text-center">
            <button type="submit" class="btn btn-primary">Update Coupon</button>
        </div>
    </form>
</div>

<?php
require $_SERVER['DOCUMENT_ROOT'] . "/views/admin/partials/footer.php";
?>
