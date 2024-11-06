<?php
$Product_active = "active";

require $_SERVER['DOCUMENT_ROOT'] . "/views/admin/partials/header.php"; ?>

<h2>Add Product</h2>
<form method="POST">
    <label>Product Name</label>
    <input type="text" name="product_name" required>
    <label>Description</label>
    <textarea name="description"></textarea>
    <label>Price</label>
    <input type="number" step="0.01" name="price" required>
    <label>Stock Quantity</label>
    <input type="number" name="stock_quantity" required>
    <label>Image URL</label>
    <input type="text" name="image_url">
    <button type="submit">Add Product</button>
</form>

<?php require $_SERVER['DOCUMENT_ROOT'] . "/views/admin/partials/footer.php"; ?>
