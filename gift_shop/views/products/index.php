<?php require_once 'views/partials/header.php';
$dir = '../public/images/product/';?>

<div class="product-wrapper" data-aos="fade-up" data-aos-delay="200">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="product-slider-default-2rows default-slider-nav-arrow">
                    <div class="swiper-container product-default-slider-4grid-2row">
                        <div class="swiper-wrapper">
                            <?php if (!empty($products)): ?>
                                <?php foreach ($products as $product): ?>
                                    <div class="product-default-single-item product-color--golden swiper-slide">
                                        <div class="image-box">
                                            <a href="/product/details?id=<?php echo $product['id']; ?>" class="image-link">
                                                <img src="<?php echo $dir . urlencode($product['image_url']); ?>" alt="Product Image">
                                            </a>
                                            <div class="tag">
                                                <span>sale</span>
                                            </div>
                                            <div class="action-link">
                                                <div class="action-link-left">
                                                    <a href="#" data-bs-toggle="modal"
                                                       data-bs-target="#modalAddcart">Add to Cart</a>
                                                </div>
                                                <div class="action-link-right">
                                                    <a href="#" data-bs-toggle="modal"
                                                       data-bs-target="#modalQuickview"><i class="icon-magnifier"></i></a>
                                                    <a href="/wishlist"><i class="icon-heart"></i></a>
                                                    <a href="/compare"><i class="icon-shuffle"></i></a>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="content">
                                            <div class="content-left">
                                                <h6 class="title">
                                                    <a href="/product/details?id=<?php echo $product['id']; ?>">
                                                        <?php echo htmlspecialchars($product['product_name']); ?>
                                                    </a>
                                                </h6>
                                                <ul class="review-star">
                                                    <li class="fill"><i class="ion-android-star"></i></li>
                                                    <li class="fill"><i class="ion-android-star"></i></li>
                                                    <li class="fill"><i class="ion-android-star"></i></li>
                                                    <li class="fill"><i class="ion-android-star"></i></li>
                                                    <li class="empty"><i class="ion-android-star"></i></li>
                                                </ul>
                                            </div>
                                            <div class="content-right">
                                                <span class="price">$<?php echo number_format($product['price'], 2); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <p>No products available.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <!-- Navigation buttons -->
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require_once 'views/partials/footer.php';?>
