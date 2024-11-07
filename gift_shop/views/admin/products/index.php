<?php
$Product_active = "active";
require $_SERVER['DOCUMENT_ROOT'] . "/views/admin/partials/header.php"; ?>

<!-- Navbar -->
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Admin</a></li>
                <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Products</li>
            </ol>
            <h6 class="font-weight-bolder mb-0">Products</h6>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
            <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                <div class="input-group">
                    <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                    <input type="text" class="form-control" placeholder="Search by ID, Product Name, or Price" id="productSearchInput" onkeyup="searchProducts()">
                </div>
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
<div class="container py-5 text-center">

    <a href="/Categories/createProduct" class="btn btn-primary mb-4">Add New Product</a>

    <h2 class="mb-4 text-center">Products in this Category</h2>

    <div class="row" id="productsContainer">
        <?php if (!empty($products)): ?>
            <?php foreach ($products as $product): ?>
                <div class="col-md-4 mb-4 product-card">
                    <div class="card h-100 shadow-sm">
                        <img src="/public/images/product/<?= htmlspecialchars($product['image_url']); ?>" alt="<?= htmlspecialchars($product['product_name']); ?>" class="card-img-top" style="height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($product['product_name']); ?></h5>
                            <p class="text-muted">ID: <?= htmlspecialchars($product['id']); ?></p>
                            <p class="card-text">Price: $<?= htmlspecialchars($product['price']); ?></p>
                        </div>
                        <div class="card-footer text-center">
                            <a href="/admin/Categories/edit/<?= htmlspecialchars($product['id']) ?>" class="status-badge status-blue">Edit</a>
                            <a href="/product/delete/<?= htmlspecialchars($product['id']) ?>" class="status-badge status-disabled ">Delete</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-center">No products found in this category.</p>
        <?php endif; ?>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteModalLabel">Confirm Deletion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this product? This action cannot be undone.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteButton">Delete</button>
            </div>
        </div>
    </div>
</div>

<script>
    function confirmDelete(productId) {
        // Show the modal confirmation dialog
        var modal = new bootstrap.Modal(document.getElementById('confirmDeleteModal'));
        modal.show();

        // When the user clicks the confirm button, redirect to delete the product
        document.getElementById('confirmDeleteButton').onclick = function() {
            window.location.href = '/product/delete/' + productId;
        };
    }
</script>



<script>
    function searchProducts() {
        const input = document.getElementById("productSearchInput").value.toLowerCase();
        const cards = document.querySelectorAll(".product-card");

        cards.forEach(card => {
            const idText = card.querySelector(".text-muted").innerText.toLowerCase(); // Product ID text
            const nameText = card.querySelector(".card-title").innerText.toLowerCase(); // Product name
            const priceText = card.querySelector(".card-text").innerText.toLowerCase(); // Product price

            // Show card if search input matches the ID, name, or price
            if (idText.includes(input) || nameText.includes(input) || priceText.includes(input)) {
                card.style.display = "";
            } else {
                card.style.display = "none";
            }
        });
    }
</script>

<?php require $_SERVER['DOCUMENT_ROOT'] . "/views/admin/partials/footer.php"; ?>
