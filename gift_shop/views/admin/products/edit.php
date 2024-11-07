<?php require $_SERVER['DOCUMENT_ROOT'] . "/views/admin/partials/header.php"; ?>

<div class="container mt-5">
    <h1>Edit Product</h1>
    <form action="/product/update/<?php echo $product['id']; ?>" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="product_name" class="form-label">Name:</label>
            <input type="text" id="product_name" name="product_name" class="form-control" value="<?php echo htmlspecialchars($product['product_name']); ?>" required>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Price:</label>
            <input type="number" id="price" name="price" class="form-control" value="<?php echo htmlspecialchars($product['price']); ?>" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description:</label>
            <textarea id="description" name="description" class="form-control" rows="5" required><?php echo htmlspecialchars($product['description']); ?></textarea>
        </div>

        <!-- Image upload field -->
        <div class="mb-3">
            <label for="image_url" class="form-label">Product Image:</label>
            <input type="file" id="image_url" name="image_url" class="form-control">
            <?php if ($product['image_url']): ?>
                <div class="mt-2">
                    <p>Current Image:</p>
                    <img src="/public/images/product/<?php echo htmlspecialchars($product['image_url']); ?>" alt="Product Image" class="img-fluid" style="max-width: 200px;">
                </div>
            <?php endif; ?>
        </div>

        <div class="d-flex justify-content-start">
            <button type="submit" class="btn btn-primary">Save Changes</button>
        </div>
    </form>
</div>

<?php require $_SERVER['DOCUMENT_ROOT'] . "/views/admin/partials/footer.php"; ?>
