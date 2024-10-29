

<div class="product-container">
    <div class="product-header">
        <button class="product-btn product-btn-blue" onclick="toggleForm('categoryForm')">+ Add New Category</button>
        <button class="product-btn product-btn-green" onclick="toggleForm('productContainer')">+ Add New Product</button>
    </div>

    <!-- Categories Cards -->
    <div class="product-cards">
        <?php
        require 'dashboard.php';
        $dashboard = new Dashboard();
        $categories = $dashboard->getCategories();
        foreach ($categories as $category) : ?>
            <div class="product-card">
                <img src="<?php echo $category['image_url']; ?>" alt="Category Image">
                <div class="product-card-title"><?php echo htmlspecialchars($category['category_name']); ?></div>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Add New Category Form -->
    <div id="categoryForm" class="product-form-container">
        <h3>Add New Category</h3>
        <form action="add_category.php" method="post">
            <div class="product-form-group">
                <label for="category_name">Category Name</label>
                <input type="text" id="category_name" name="category_name" required>
            </div>
            <div class="product-form-group">
                <label for="description">Description</label>
                <input type="text" id="description" name="description">
            </div>
            <div class="product-form-group">
                <label for="image_url">Image URL</label>
                <input type="text" id="image_url" name="image_url">
            </div>
            <button type="submit" class="product-btn product-btn-blue">Save Category</button>
        </form>
    </div>

    <!-- Add New Product Form -->
    <div id="productContainer" class="product-form-container">
        <h3>Add New Product</h3>
        <form action="add_product.php" method="post">
            <div class="product-form-group">
                <label for="product_name">Product Name</label>
                <input type="text" id="product_name" name="product_name" required>
            </div>
            <div class="product-form-group">
                <label for="description">Description</label>
                <input type="text" id="description" name="description">
            </div>
            <div class="product-form-group">
                <label for="price">Price</label>
                <input type="number" id="price" name="price" step="0.01" required>
            </div>
            <div class="product-form-group">
                <label for="stock_quantity">Stock Quantity</label>
                <input type="number" id="stock_quantity" name="stock_quantity" required>
            </div>
            <div class="product-form-group">
                <label for="category_id">Category</label>
                <select id="category_id" name="category_id" required>
                    <?php

                    $categories = $dashboard->getCategories();
                    foreach ($categories as $category) : ?>
                        <option value="<?php echo $category['category_id']; ?>">
                            <?php echo htmlspecialchars($category['category_name']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="product-btn product-btn-green">Save Product</button>
        </form>
    </div>
</div>
