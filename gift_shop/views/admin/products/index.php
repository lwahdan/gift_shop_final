<?php
$Product_active = "active";


require $_SERVER['DOCUMENT_ROOT'] . "/views/admin/partials/header.php"; ?>

<h2>Products</h2>
<a href="/admin/products/addProduct/<?php echo $categoryId; ?>" class="btn-blue">+ Add New Product</a>
<div class="cardBox">
    <?php foreach ($products as $product): ?>
        <div class="card">
            <h3><?php echo htmlspecialchars($product['product_name']); ?></h3>
            <p><?php echo htmlspecialchars($product['description']); ?></p>
            <p>Price: $<?php echo htmlspecialchars($product['price']); ?></p>
            <p>Stock: <?php echo htmlspecialchars($product['stock_quantity']); ?></p>
            <a href="/admin/products/edit/<?php echo $product['id']; ?>" class="btn-blue">Edit</a>
        </div>
    <?php endforeach; ?>
</div>

<?php require $_SERVER['DOCUMENT_ROOT'] . "/views/admin/partials/footer.php"; ?>
