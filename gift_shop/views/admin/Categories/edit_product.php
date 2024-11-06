<?php
require $_SERVER['DOCUMENT_ROOT'] . "/views/admin/partials/header.php";
?>


<div class="container py-5">
    <h1 class="mb-4 text-center">Edit Product</h1>
    
    <form action="/dashboard/updateProduct/<?php echo htmlspecialchars($product['id']); ?>" method="POST" class="needs-validation" novalidate>
        <div class="mb-3">
            <label for="product_name" class="form-label">Product Name</label>
            <input type="text" class="form-control" id="product_name" name="product_name" value="<?php echo htmlspecialchars($product['product_name']); ?>" required>
            <div class="invalid-feedback">Please provide a product name.</div>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3" required><?php echo htmlspecialchars($product['description']); ?></textarea>
            <div class="invalid-feedback">Please provide a product description.</div>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="number" class="form-control" id="price" name="price" value="<?php echo htmlspecialchars($product['price']); ?>" step="0.01" required>
            <div class="invalid-feedback">Please provide a valid price.</div>
        </div>

        <div class="mb-3">
            <label for="stock_quantity" class="form-label">Stock Quantity</label>
            <input type="number" class="form-control" id="stock_quantity" name="stock_quantity" value="<?php echo htmlspecialchars($product['stock_quantity']); ?>" required>
            <div class="invalid-feedback">Please provide the stock quantity.</div>
        </div>

        <div class="mb-3">
            <label for="category_id" class="form-label">Category ID</label>
            <input type="number" class="form-control" id="category_id" name="category_id" value="<?php echo htmlspecialchars($product['category_id']); ?>" required>
            <div class="invalid-feedback">Please provide a category ID.</div>
        </div>

        <div class="mb-4">
            <label for="image_url" class="form-label">Image URL</label>
            <input type="text" class="form-control" id="image_url" name="image_url" value="<?php echo htmlspecialchars($product['image_url']); ?>">
        </div>

        <button type="submit" class="btn btn-primary w-100">Save Changes</button>
    </form>
</div>

<!-- Bootstrap JS and dependencies -->
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
