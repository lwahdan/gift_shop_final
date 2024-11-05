<?php require $_SERVER['DOCUMENT_ROOT'] . "/views/admin/partials/header.php"; ?>

<div class="product-container">
    <a href="/Categories/createProduct" class="btn-blue">Add New Product</a>

    <h2>Products in this Category</h2>

    <!-- Product Cards -->
    <div class="product-cards2">
        <?php if (!empty($products)): ?>
            <?php foreach ($products as $product): ?>
                <div class="product-card2">
                    <img src="<?= htmlspecialchars($product['image_url']); ?>" alt="<?= htmlspecialchars($product['product_name']); ?>" class="product-image">
                    <div class="product-card-title"><?= htmlspecialchars($product['product_name']); ?></div>
                    <div class="product-card-title">Price: $<?= htmlspecialchars($product['price']); ?></div>
                   <div class="product-card-title">

                    <a href="/admin/Categories/edit/<?= $product['id'] ?>" class="btn-blue">Edit</a>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No products found in this category.</p>
        <?php endif; ?>
    </div>
</div>

<?php require $_SERVER['DOCUMENT_ROOT'] . "/views/admin/partials/footer.php"; ?>
