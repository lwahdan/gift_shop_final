<?php
$Product_active = "active";


require $_SERVER['DOCUMENT_ROOT'] . "/views/admin/partials/header.php"; ?>

    <div class="form-container">
        <h2 class="form-title">Add New Product</h2>

        <form action="/dashboard/addProduct" method="POST" enctype="multipart/form-data" class="coupon-form" novalidate>
            <div class="form-group">
                <label for="product_name" class="form-label">Product Name:</label>
                <input type="text" class="form-control" id="product_name" name="product_name" required>
                <div class="invalid-feedback">Please provide a product name.</div>
            </div>

            <div class="form-group">
                <label for="description" class="form-label">Description:</label>
                <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                <div class="invalid-feedback">Please provide a product description.</div>
            </div>

            <div class="form-group">
                <label for="price" class="form-label">Price:</label>
                <input type="number" class="form-control" id="price" name="price" step="0.01" required>
                <div class="invalid-feedback">Please provide a valid price.</div>
            </div>

            <div class="form-group">
                <label for="stock_quantity" class="form-label">Stock Quantity:</label>
                <input type="number" class="form-control" id="stock_quantity" name="stock_quantity" required>
                <div class="invalid-feedback">Please provide the stock quantity.</div>
            </div>

            <div class="form-group">
                <label for="category_id" class="form-label">Category ID:</label>
                <input type="text" class="form-control" id="category_id" name="category_id" required>
                <div class="invalid-feedback">Please provide a category ID.</div>
            </div>

            <div class="form-group">
                <label for="image" class="form-label">Product Image:</label>
                <input type="file" class="form-control" id="image" name="image" required>
                <div class="invalid-feedback">Please upload an image for the product.</div>
            </div>

            <button type="submit" class="form-button">Add Product</button>
        </form>
    </div>

    <script>
        // JavaScript for validation
        (function () {
            'use strict'
            var forms = document.querySelectorAll('.coupon-form')
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

<?php require $_SERVER['DOCUMENT_ROOT'] . "/views/admin/partials/footer.php"; ?>