<?php
$coupon_active = "active";

require $_SERVER['DOCUMENT_ROOT'] . "/views/admin/partials/header.php";
?>
<!-- Navbar -->
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Admin</a></li>
                <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Coupons</li>
            </ol>
            <h6 class="font-weight-bolder mb-0">Coupons</h6>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
            <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                <!-- Search Input -->
                <div class="input-group me-3">
                    <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                    <input type="text" class="form-control" placeholder="Search by Code or Discount" id="couponSearchInput" onkeyup="filterCoupons()">
                </div>
                <!-- Status Filter Dropdown -->
                <select class="form-select" id="statusFilter" onchange="filterCoupons()">
                    <option value="all">All</option>
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
                <!-- Min Discount Filter -->
                <input type="number" class="form-control ms-2" id="minDiscount" placeholder="Min Discount" oninput="filterCoupons()">
                <!-- Updated After Filter -->
                <input type="date" class="form-control ms-2" id="updatedAfter" onchange="filterCoupons()">
            </div>
            <ul class="navbar-nav justify-content-end">
                <li class="nav-item d-flex align-items-center">
                    <a href="/admin/logout" class="nav-link text-body font-weight-bold px-0">
                        <i class="fa fa-user me-sm-1"></i>
                        <span class="d-sm-inline d-none">Sign Out</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- End Navbar -->

<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Coupons</h2>
        <a href="/admin/coupons/create" class="btn btn-primary">Add New Coupon</a>
    </div>

    <!-- Coupon List -->
    <div class="row g-4" id="couponsContainer">
        <?php
        if (isset($coupons)) {
            foreach ($coupons as $coupon) {
                echo '
                <div class="col-md-6 col-lg-4 coupon-card" data-status="' . ($coupon['is_active'] ? 'active' : 'inactive') . '" data-discount="' . $coupon['discount_value'] . '" data-updated="' . $coupon['updated_at'] . '">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5 class="card-title mb-0">Code: ' . htmlspecialchars($coupon['code']) . '</h5>
                                <span class="badge ' . ($coupon['is_active'] ? 'bg-success' : 'bg-danger') . '"><ion-icon name="pricetags-outline"></ion-icon></span>
                            </div>
                            <p class="card-text">Discount: ' . htmlspecialchars($coupon['discount_value']) . '%</p>
                            <p class="card-text">Updated: ' . htmlspecialchars($coupon['updated_at']) . '</p>
                        </div>
                        <div class="card-footer d-flex justify-content-end">
                            <a href="/admin/coupons/edit/' . $coupon['id'] . '" class="d-flex align-items-center justify-content-center status-badge status-blue">Edit</a> | |
                            <a href="/admin/coupons/toggleStatus/' . $coupon['id'] . '/' . ($coupon['is_active'] ? 0 : 1) . '" class="d-flex align-items-center justify-content-center status-badge  '. ($coupon['is_active'] ? 'status-disabled' : 'status-enabled') .'">' . ($coupon['is_active'] ? 'Deactivate' : 'Activate') . '</a>
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

<script>
    // Function to filter coupons
    function filterCoupons() {
        const searchInput = document.getElementById("couponSearchInput").value.toLowerCase();
        const statusFilter = document.getElementById("statusFilter").value;
        const minDiscount = document.getElementById("minDiscount").value;
        const updatedAfter = document.getElementById("updatedAfter").value;
        const coupons = document.querySelectorAll(".coupon-card");

        coupons.forEach(coupon => {
            const code = coupon.querySelector(".card-title").textContent.toLowerCase();
            const discount = parseFloat(coupon.getAttribute("data-discount"));
            const updated = coupon.getAttribute("data-updated");
            const status = coupon.getAttribute("data-status");

            // Apply filters
            const matchesSearch = code.includes(searchInput);
            const matchesStatus = (statusFilter === "all" || status === statusFilter);
            const matchesMinDiscount = (minDiscount === "" || discount >= parseFloat(minDiscount));
            const matchesUpdatedAfter = (updatedAfter === "" || new Date(updated) >= new Date(updatedAfter));

            // Show or hide coupon based on filters
            if (matchesSearch && matchesStatus && matchesMinDiscount && matchesUpdatedAfter) {
                coupon.style.display = "block";
            } else {
                coupon.style.display = "none";
            }
        });
    }
</script>

<?php
require $_SERVER['DOCUMENT_ROOT'] . "/views/admin/partials/footer.php";
?>
