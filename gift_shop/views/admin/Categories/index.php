<?php
$category_active = "active";
require $_SERVER['DOCUMENT_ROOT'] . "/views/admin/partials/header.php"; ?>
<!-- Navbar -->
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Admin</a></li>
                <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Categories</li>
            </ol>
            <h6 class="font-weight-bolder mb-0">Categories</h6>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
            <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                <div class="input-group">
                    <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                    <input type="text" class="form-control" placeholder="Search by ID or Category Name" id="categorySearchInput" onkeyup="searchCategories()">
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
    <a href="/categories/create" class="btn btn-primary">Add New Category</a>

    <h2 class="mb-4 text-center">Main Categories</h2>

    <!-- Categories Cards -->
    <div class="row" id="categoriesContainer">
        <?php foreach ($categories as $category) : ?>
            <div class="col-md-4 mb-4 category-card">
                <div class="card h-60">
                    <img src="/public/images/banner/<?php echo htmlspecialchars($category['image_url']); ?>" class="card-img-top" alt="Category Image">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlspecialchars($category['category_name']); ?></h5>
                        <p class="text-muted">ID: <?php echo htmlspecialchars($category['id']); ?></p>
                        <p class="text-muted"> <?php echo htmlspecialchars($category['description']); ?></p>
                    </div>
                    <div class="card-footer">
                        <a href="/categories/edit/<?php echo htmlspecialchars($category['id']); ?>" class="status-badge status-blue w-100">Edit</a>
                        <a href="/categories/delete/<?php echo htmlspecialchars($category['id']); ?>" class="status-badge status-disabled  w-100">Delete</a>
                        <a href="/admin/categories/show/<?php echo htmlspecialchars($category['id']); ?>" class="status-badge status-enabled w-100">View</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<script>
    function searchCategories() {
        const input = document.getElementById("categorySearchInput").value.toLowerCase();
        const cards = document.querySelectorAll(".category-card");

        cards.forEach(card => {
            const idText = card.querySelector(".card-body p").innerText.toLowerCase();
            const nameText = card.querySelector(".card-body h5").innerText.toLowerCase();

            if (idText.includes(input) || nameText.includes(input)) {
                card.style.display = "";
            } else {
                card.style.display = "none";
            }
        });
    }
</script>

<?php require $_SERVER['DOCUMENT_ROOT'] . "/views/admin/partials/footer.php"; ?>
