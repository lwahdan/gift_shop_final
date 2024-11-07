<?php
$coupon_active = "active";
require $_SERVER['DOCUMENT_ROOT'] . "/views/admin/partials/header.php";
?>

<div class="container mt-4">
    <h2 class="form-title text-center mb-4">Add Coupon</h2>

    <form id="addCouponForm" method="POST" class="coupon-form">
        <!-- Coupon Code -->
        <div class="mb-3">
            <label for="code" class="form-label">Code:</label>
            <input type="text" name="code" id="code" class="form-control" required>
        </div>

        <!-- Discount Type -->
        <div class="mb-3">
            <label for="discount_type" class="form-label">Discount Type:</label>
            <select name="discount_type" id="discount_type" class="form-select">
                <option value="Percentage">Percentage</option>
            </select>
        </div>

        <!-- Discount Value -->
        <div class="mb-3">
            <label for="discount_value" class="form-label">Discount Value:</label>
            <input type="number" name="discount_value" id="discount_value" class="form-control" required>
        </div>

        <!-- Expiration Date -->
        <div class="mb-3">
            <label for="expiration_date" class="form-label">Expiration Date:</label>
            <input type="date" name="expiration_date" id="expiration_date" class="form-control">
        </div>

        <!-- Is Active -->
        <div class="mb-3 form-check">
            <input type="checkbox" name="is_active" value="1" class="form-check-input" id="is_active" checked>
            <label class="form-check-label" for="is_active">Is Active</label>
        </div>

        <!-- Submit Button -->
        <div class="text-center">
            <button type="submit" class="btn btn-primary save-coupon-btn">Save Coupon</button>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
    const saveCouponButton = document.querySelector('.save-coupon-btn');
    const addCouponForm = document.getElementById('addCouponForm');

    if (saveCouponButton && addCouponForm) {
        saveCouponButton.addEventListener('click', function(event) {
            event.preventDefault();
            Swal.fire({
                title: 'Coupon added successfully!',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    addCouponForm.submit();
                }
            });
        });
    }
});

</script>
<?php
require $_SERVER['DOCUMENT_ROOT'] . "/views/admin/partials/footer.php";
?>
