<?php
$category_active = "active";
require $_SERVER['DOCUMENT_ROOT'] . "/views/admin/partials/header.php"; ?>

<div class="container py-5">
<a href="/categories/create">Add New Category</a>

    <h2 class="mb-4 text-center">Main Categories</h2>

    <!-- Categories Cards -->
    <div class="row">
        <?php foreach ($categories as $category) : ?>
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <img src="<?php echo $category['image_url']; ?>" class="card-img-top" alt="Category Image">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlspecialchars($category['category_name']); ?></h5>
                    </div>
                    <div class="card-footer">
                    <a href="/categories/edit/<?php echo $category['id']; ?>">Edit</a>
                    <a href="/categories/delete/<?php echo $category['id']; ?>">Delete</a>
                        <a href="/admin/categories/show/<?php echo $category['id']; ?>" class="btn btn-primary w-100">View Products</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php require $_SERVER['DOCUMENT_ROOT'] . "/views/admin/partials/footer.php"; ?>