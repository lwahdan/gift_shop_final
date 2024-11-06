<?php
require $_SERVER['DOCUMENT_ROOT'] . "/views/admin/partials/header.php";
?>

<div class="container py-5">
    <h2 class="mb-4">Edit Category</h2>

    <form method="post" action="/categories/update/<?php echo $category['id']; ?>" class="bg-white p-4 rounded shadow">
        <div class="form-group">
            <label for="name">Category Name</label>
            <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($category['category_name']); ?>" required>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3" required><?php echo htmlspecialchars($category['description']); ?></textarea>
        </div>

        <div class="form-group">
            <label for="image_url">Image URL</label>
            <input type="text" class="form-control" id="image_url" name="image_url" value="<?php echo htmlspecialchars($category['image_url']); ?>" required>
        </div>

        <button type="submit" class="btn btn-primary">Update Category</button>
    </form>
</div>

<?php
require $_SERVER['DOCUMENT_ROOT'] . "/views/admin/partials/footer.php";
?>
