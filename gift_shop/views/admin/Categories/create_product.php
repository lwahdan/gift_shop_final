<?php
$Product_active = "active";
require $_SERVER['DOCUMENT_ROOT'] . "/views/admin/partials/header.php";
?>

<div class="container py-4 w-60 ">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4>Add New Product</h4>
        </div>
        <div class="card-body">
            <form id="addProductForm" action="/dashboard/addProduct" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                <div class="mb-3">
                    <label for="product_name" class="form-label">Product Name:</label>
                    <input type="text" class="form-control" id="product_name" name="product_name" required>
                    <div class="invalid-feedback">Please provide a product name.</div>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description:</label>
                    <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                    <div class="invalid-feedback">Please provide a product description.</div>
                </div>

                <div class="mb-3">
                    <label for="price" class="form-label">Price:</label>
                    <input type="number" class="form-control" id="price" name="price" step="0.01" required>
                    <div class="invalid-feedback">Please provide a valid price.</div>
                </div>

                <div class="mb-3">
                    <label for="stock_quantity" class="form-label">Stock Quantity:</label>
                    <input type="number" class="form-control" id="stock_quantity" name="stock_quantity" required>
                    <div class="invalid-feedback">Please provide the stock quantity.</div>
                </div>

                <div class="mb-3">
                    <label for="category_id" class="form-label">Category ID:</label>
                    <input type="text" class="form-control" id="category_id" name="category_id" required>
                    <div class="invalid-feedback">Please provide a category ID.</div>
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Product Image:</label>
                    <input type="file" class="form-control" id="image" name="image" required>
                    <div class="invalid-feedback">Please upload an image for the product.</div>
                </div>

                <button type="submit" class="btn btn-primary add-product-btn">Add Product</button>
            </form>
        </div>
    </div>
</div>

<script>
    // JavaScript for form validation
    (function () {
        'use strict';
        var forms = document.querySelectorAll('.needs-validation');
        Array.prototype.slice.call(forms).forEach(function (form) {
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    })();

    document.addEventListener('DOMContentLoaded', () => {
    const addProductButton = document.querySelector('.add-product-btn');
    const addProductForm = document.getElementById('addProductForm');

    if (addProductButton && addProductForm) {
        addProductButton.addEventListener('click', function(event) {
            event.preventDefault(); 
            Swal.fire({
                title: 'Product added successfully!',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    addProductForm.submit();
                }
            });
        });
    }
});

</script>

<?php require $_SERVER['DOCUMENT_ROOT'] . "/views/admin/partials/footer.php"; ?>
