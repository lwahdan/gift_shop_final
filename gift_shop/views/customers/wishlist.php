<?php require 'views/partials/header.php'; ?>

<div class="breadcrumb-section breadcrumb-bg-color--golden">
    <div class="breadcrumb-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h3 class="breadcrumb-title">Wishlist</h3>
                    <div class="breadcrumb-nav breadcrumb-nav-color--black breadcrumb-nav-hover-color--golden">
                        <nav aria-label="breadcrumb">
                            <ul>
                                <li><a href="/home">Home</a></li>
                                <li class="active" aria-current="page">Wishlist</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="wishlist-section">
    <div class="wishlish-table-wrapper" data-aos="fade-up" data-aos-delay="0">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="table_desc">
                        <div class="table_page table-responsive">
                            <table>
                                <thead>
                                    <tr>
                                        <th class="product_remove">Delete</th>
                                        <th class="product_thumb">Image</th>
                                        <th class="product_name">Product</th>
                                        <th class="product-price">Price</th>
                                        <th class="product_stock">Stock Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($wishlistItems as $item): ?>
                                        <?php
                                            // Fetch product details from a hypothetical Product model
                                            $product = $productModel->find($item['product_id']);
                                        ?>
                                        <tr>
                                            <td class="product_remove">
                                                <a href="/wishlist/remove/<?= $item['id'] ?>"><i class="fa fa-trash-o" ></i></a>
                                            </td>
                                            <td class="product_thumb">
                                                <a href="product/details?id=<?= $product['id'] ?>">
                                                    <img src="<?= $dir.$product['image_url'] ?>" alt="">
                                                </a>
                                            </td>
                                            <td class="product_name">
                                                <a href="product/details/<?= $product['id'] ?>"><?= $product['product_name'] ?></a>
                                            </td>
                                            <td class="product-price">$<?= number_format($product['price'], 2) ?></td>
                                            <td class="product_stock"><?= $product['stock_quantity'] > 0 ? 'In Stock' : 'Out of Stock' ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            <?php if (empty($wishlistItems)): ?>
                                <p>Your wishlist is empty.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require 'views/partials/footer.php'; ?>
