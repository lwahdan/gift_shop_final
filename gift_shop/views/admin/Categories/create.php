<?php
$category_active = "active";
require $_SERVER['DOCUMENT_ROOT'] . "/views/admin/partials/header.php";
?>

    <div class="container py-5">
        <h2 class="mb-4">Create New Category</h2>

        <form method="post" action="/categories/store" class="bg-white p-4 rounded shadow">
            <div class="form-group">
                <label for="name">Category Name</label>
                <input type="text" class="form-control" id="category_name" name="name" required>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
            </div>

            <div class="form-group">
                <label for="image_url">Image URL</label>
                <input type="text" class="form-control" id="image_url" name="image_url" required>
            </div>

            <button type="submit" class="btn btn-primary">Create Category</button>
        </form>
    </div>

<?php
require $_SERVER['DOCUMENT_ROOT'] . "/views/admin/partials/footer.php";
?>