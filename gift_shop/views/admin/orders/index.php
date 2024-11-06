<?php
$order_active = "active";
require $_SERVER['DOCUMENT_ROOT'] . "/views/admin/partials/header.php";
?>
<!-- Navbar -->
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Admin</a></li>
                <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Orders</li>
            </ol>
            <h6 class="font-weight-bolder mb-0">Orders</h6>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
            <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                <!-- Search Input -->
                <div class="input-group me-3">
                    <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                    <input type="text" class="form-control" placeholder="Search by ID, User ID, Total Price, or Status" id="orderSearchInput" onkeyup="searchOrders()">
                </div>
                <!-- Status Filter Dropdown -->
                <select class="form-select ms-2" id="statusFilter" onchange="searchOrders()">
                    <option value="all">All Status</option>
                    <option value="Pending">Pending</option>
                    <option value="Completed">Completed</option>
                    <option value="Cancelled">Cancelled</option>
                </select>
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

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <!-- Card Header -->
                <div class="card-header pb-0 p-3 d-flex justify-content-between align-items-center">
                    <h6 class="mb-0">All Orders</h6>
                </div>

                <!-- Orders Table -->
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0 table-striped table-bordered">
                            <thead class="thead-dark">
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ID</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">User ID</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Total Price</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Actions</th>
                            </tr>
                            </thead>
                            <tbody id="ordersTableBody">
                            <?php if (isset($orders)) {
                                foreach ($orders as $order): ?>
                                    <tr class="order-row" data-id="<?= htmlspecialchars($order['id']) ?>" data-user-id="<?= htmlspecialchars($order['user_id']) ?>" data-status="<?= htmlspecialchars($order['status']) ?>" data-price="<?= htmlspecialchars($order['total_price']) ?>">
                                        <td class="ps-4">
                                            <p class="text-xs font-weight-bold mb-0"><?= htmlspecialchars($order['id']) ?></p>
                                        </td>
                                        <td class="ps-4">
                                            <p class="text-xs font-weight-bold mb-0"><?= htmlspecialchars($order['user_id']) ?></p>
                                        </td>
                                        <td class="ps-4">
                                            <p class="text-xs font-weight-bold mb-0">$<?= htmlspecialchars($order['total_price']) ?></p>
                                        </td>
                                        <td class="ps-4">
                                            <p class="text-xs font-weight-bold mb-0"><?= htmlspecialchars($order['status']) ?></p>
                                        </td>
                                        <td class="ps-4">
                                            <a href="/admin/orders/show/<?= $order['id'] ?>" class="status-badge status-blue">View</a> |
                                            <a href="/admin/orders/edit/<?= $order['id'] ?>" class="status-badge status-enabled">Edit</a> |
                                            <a href="/admin/orders/delete/<?= $order['id'] ?>" class="status-badge status-disabled" onclick="return confirm('Are you sure?')">Delete</a>
                                        </td>
                                    </tr>
                                <?php endforeach;
                            } else { ?>
                                <tr>
                                    <td colspan="5" class="text-center">No orders found.</td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Footer -->
                <div class="card-footer">
                    <div class="d-flex justify-content-center">
                        <p class="text-xs mb-0">End of Orders List</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Function to filter and search orders
    function searchOrders() {
        const searchInput = document.getElementById("orderSearchInput").value.toLowerCase();
        const statusFilter = document.getElementById("statusFilter").value;
        const rows = document.querySelectorAll(".order-row");

        rows.forEach(row => {
            const orderId = row.getAttribute("data-id").toLowerCase();
            const userId = row.getAttribute("data-user-id").toLowerCase();
            const status = row.getAttribute("data-status").toLowerCase();
            const price = row.getAttribute("data-price").toLowerCase();

            // Apply filters
            const matchesSearch = orderId.includes(searchInput) || userId.includes(searchInput) || price.includes(searchInput);
            const matchesStatus = (statusFilter === "all" || status === statusFilter);

            // Show or hide order row based on filters
            if (matchesSearch && matchesStatus) {
                row.style.display = "table-row";
            } else {
                row.style.display = "none";
            }
        });
    }
</script>

<?php
require $_SERVER['DOCUMENT_ROOT'] . "/views/admin/partials/footer.php";
?>
