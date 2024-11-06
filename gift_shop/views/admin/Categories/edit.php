<?php
$category_active = "active";

require $_SERVER['DOCUMENT_ROOT'] . "/views/admin/partials/header.php";
?>

<div class="container py-5 w-50">
    <h2 class="mb-4">Edit Category</h2>

    <form id="editCategoryForm" method="post" action="/categories/update/<?php echo $category['id']; ?>" class="bg-white p-4 rounded shadow">
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

        <button type="submit" class="btn btn-primary update-category-btn">Update Category</button>
    </form>
</div>

<script>
   document.addEventListener('DOMContentLoaded', () => {
    // Select the "Update Category" button and form by their identifiers
    const updateCategoryButton = document.querySelector('.update-category-btn');
    const editCategoryForm = document.getElementById('editCategoryForm');

    if (updateCategoryButton && editCategoryForm) {
        updateCategoryButton.addEventListener('click', function(event) {
            event.preventDefault(); // Prevents the form from submitting immediately

            // Display SweetAlert success message
            Swal.fire({
                title: 'Category has been edited successfully!',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Directly submit the form by ID after user confirms
                    editCategoryForm.submit();
                }
            });
        });
    }
});


</script>
<?php
require $_SERVER['DOCUMENT_ROOT'] . "/views/admin/partials/footer.php";
?>
