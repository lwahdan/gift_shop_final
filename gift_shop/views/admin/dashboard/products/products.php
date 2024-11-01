<?php
require $_SERVER['DOCUMENT_ROOT'] . "/views/admin/partials/header.php";
?>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">


<div>
    <h1 class="mb-4 text-center">Manage Products</h1>
    <div class="text-center mb-3">
        <a href="/dashboard/createProduct" class="btn btn-primary">Add New Product</a>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th scope="col">Image</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Price</th>
                    <th scope="col">Stock Quantity</th>
                    <th scope="col">Category ID</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($totalProducts as $product): ?>
                    <tr>
                        <td>
                            <?php if (!empty($product['image_url'])): ?>
                                <img src="<?= '/public/images/product/' . htmlspecialchars($product['image_url']) ?>" alt="<?= htmlspecialchars($product['product_name']) ?>" style="width: 50px; height: 50px; object-fit: cover;">
                            <?php else: ?>
                                <span class="text-muted">No image</span>
                            <?php endif; ?>
                        </td>
                        <td><?= htmlspecialchars($product['product_name']) ?></td>
                        <td><?= htmlspecialchars($product['description']) ?></td>
                        <td>$<?= htmlspecialchars($product['price']) ?></td>
                        <td><?= htmlspecialchars($product['stock_quantity']) ?></td>
                        <td><?= htmlspecialchars($product['category_id']) ?></td>
                        <td>
                            <a href="/dashboard/editProduct/<?= htmlspecialchars($product['id']) ?>" class="btn btn-sm btn-warning">Edit</a>
                            <a href="/dashboard/deleteProduct/<?= htmlspecialchars($product['id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this product?')">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<?php
require $_SERVER['DOCUMENT_ROOT'] . "/views/admin/partials/footer.php";
?>
