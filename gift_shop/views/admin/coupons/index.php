<?php
$coupon_active = "active";

require $_SERVER['DOCUMENT_ROOT'] . "/views/admin/partials/header.php";
?>

<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Coupons</h2>
        <a href="/admin/coupons/create" class="btn btn-primary">Add New Coupon</a>
    </div>

    <!-- Filter Form -->
    <form method="GET" action="/admin/coupons" class="mb-4">
        <div class="row">
            <div class="col-md-3">
                <label for="status" class="form-label">Status</label>
                <select name="status" id="status" class="form-select">
                    <option value="">All</option>
                    <option value="1" <?php echo isset($_GET['status']) && $_GET['status'] == 1 ? 'selected' : ''; ?>>Active</option>
                    <option value="0" <?php echo isset($_GET['status']) && $_GET['status'] == 0 ? 'selected' : ''; ?>>Inactive</option>
                </select>
            </div>
            <div class="col-md-3">
                <label for="discount" class="form-label">Min Discount</label>
                <input type="number" name="discount" id="discount" class="form-control" value="<?php echo isset($_GET['discount']) ? htmlspecialchars($_GET['discount']) : ''; ?>" />
            </div>
            <div class="col-md-3">
                <label for="date" class="form-label">Updated After</label>
                <input type="date" name="date" id="date" class="form-control" value="<?php echo isset($_GET['date']) ? htmlspecialchars($_GET['date']) : ''; ?>" />
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-primary mt-4">Filter</button>
            </div>
        </div>
    </form>

    <!-- Coupon List -->
    <div class="row g-4">
        <?php
        if (isset($coupons)) {
            foreach ($coupons as $coupon) {
                echo '
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5 class="card-title mb-0">Code: ' . htmlspecialchars($coupon['code']) . '</h5>
                                <span class="badge ' . ($coupon['is_active'] ? 'bg-success' : 'bg-danger') . '"><ion-icon name="pricetags-outline"></ion-icon></span>
                            </div>
                            <p class="card-text">Discount: ' . htmlspecialchars($coupon['discount_value']) . '</p>
                            <p class="card-text">Updated: ' . htmlspecialchars($coupon['updated_at']) . '</p>
                        </div>
                        <div class="card-footer d-flex justify-content-end">
                            <a href="/admin/coupons/edit/' . $coupon['id'] . '" class="btn btn-primary me-2">Edit</a>
                            <a href="/admin/coupons/toggleStatus/' . $coupon['id'] . '/' . ($coupon['is_active'] ? 0 : 1) . '" class="btn ' . ($coupon['is_active'] ? 'btn-danger' : 'btn-success') . '">' . ($coupon['is_active'] ? 'Deactivate' : 'Activate') . '</a>
                        </div>
                    </div>
                </div>';
            }
        } else {
            echo '<p>No coupons found.</p>';
        }
        ?>
    </div>
</div>

<?php
require $_SERVER['DOCUMENT_ROOT'] . "/views/admin/partials/footer.php";
?>