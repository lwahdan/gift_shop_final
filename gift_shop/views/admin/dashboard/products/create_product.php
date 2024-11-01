<?php
require $_SERVER['DOCUMENT_ROOT'] . "/views/admin/partials/header.php";
?>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">


<div class="container py-5">
    <h1 class="mb-4 text-center">Add New Product</h1>
    
    <form action="/dashboard/addProduct" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
        <div class="mb-3">
            <label for="product_name" class="form-label">Product Name</label>
            <input type="text" class="form-control" id="product_name" name="product_name" placeholder="Enter product name" required>
            <div class="invalid-feedback">Please provide a product name.</div>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" placeholder="Enter product description" rows="3" required></textarea>
            <div class="invalid-feedback">Please provide a product description.</div>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="number" class="form-control" id="price" name="price" placeholder="Enter product price" step="0.01" required>
            <div class="invalid-feedback">Please provide a valid price.</div>
        </div>

        <div class="mb-3">
            <label for="stock_quantity" class="form-label">Stock Quantity</label>
            <input type="number" class="form-control" id="stock_quantity" name="stock_quantity" placeholder="Enter stock quantity" required>
            <div class="invalid-feedback">Please provide the stock quantity.</div>
        </div>

        <div class="mb-3">
            <label for="category_id" class="form-label">Category ID</label>
            <input type="text" class="form-control" id="category_id" name="category_id" placeholder="Enter category ID" required>
            <div class="invalid-feedback">Please provide a category ID.</div>
        </div>

        <div class="mb-4">
            <label for="image" class="form-label">Product Image</label>
            <input type="file" class="form-control" id="image" name="image" required>
            <div class="invalid-feedback">Please upload an image for the product.</div>
        </div>

        <button type="submit" class="btn btn-primary w-100">Add Product</button>
    </form>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // JavaScript for Bootstrap validation
    (function () {
        'use strict'
        var forms = document.querySelectorAll('.needs-validation')
        Array.prototype.slice.call(forms).forEach(function (form) {
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }
                form.classList.add('was-validated')
            }, false)
        })
    })()
</script>

<?php
require $_SERVER['DOCUMENT_ROOT'] . "/views/admin/partials/footer.php";
?>
