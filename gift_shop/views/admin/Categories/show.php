<?php
$Product_active = "active";
require $_SERVER['DOCUMENT_ROOT'] . "/views/admin/partials/header.php";
?>

<div class="container py-5 text-center">
    <a href="/Categories/createProduct" class="btn btn-primary mb-4">Add New Product</a>

    <h2 class="mb-4 text-center">Products in this Category</h2>

    <div class="row">
        <?php if (!empty($products)): ?>
            <?php foreach ($products as $product): ?>
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <img src="/public/images/product/<?= htmlspecialchars($product['image_url']); ?>" alt="<?= htmlspecialchars($product['product_name']); ?>" class="card-img-top" style="height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($product['product_name']); ?></h5>
                            <p class="card-text">Price: $<?= htmlspecialchars($product['price']); ?></p>
                        </div>
                        <div class="card-footer text-center">
                            <a href="/admin/Categories/edit/<?= $product['id'] ?>" class="btn btn-primary">Edit</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-center">No products found in this category.</p>
        <?php endif; ?>
    </div>
</div>

<?php require $_SERVER['DOCUMENT_ROOT'] . "/views/admin/partials/footer.php"; ?>
