<?php require_once 'views/partials/header.php';
$dir = '../public/images/product/';?>

<div class="product-default-slider-section section-top-gap-100">
    <div class="section-title-wrapper" data-aos="fade-up" data-aos-delay="0">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-content-gap">
                        <div class="secton-content">
                            <h3 class="section-title">Products</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="product-wrapper" data-aos="fade-up" data-aos-delay="200">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="product-slider-default-2rows default-slider-nav-arrow">
                   <div class="swiper-container product-default-slider-4grid-2row">
                        <div class="swiper-wrapper">
                            <?php foreach ($products as $row): ?>
                                <div class="product-default-single-item product-color--golden swiper-slide">
                                    <div class="image-box">
                                        <a href="/product/details?id=<?php echo $row['id']; ?>" class="image-link">
                                            <img src="<?php echo $dir . str_replace(' ', '%20', $row['image_url']); ?>" alt="Product Image">
                                        </a>
                                        <div class="action-link">

                                        <div class="action-link-left">
                                        <form class="add-to-cart-form" action="/cart/add" method="POST">
                                        <input type="hidden" name="product_id" value="<?= $row['id']; ?>">
                                        <?php if ($row['stock_quantity'] > 0): ?>
                                            <button type="submit" class="btn btn-link btn-md btn-golden">Add to Cart</button>
                                            <?php else: ?>
                                                <div class="btn">Out of stock</div>
                                        <?php endif; ?>
                                        </form>
                                        <!-- <div id="success-message" class="success-message">Added successfully</div> -->
                                        </div>
                                            <div class="action-link-right" onclick="addOrRemoveFromWishlist(<?= $row['id']?>)">
                                                <a>
                                                <i id="wishlist-icon-<?= $row['id']?>" class="icon-heart"></i>
                                                </a>    

                                            </div>
                                        </div>
                                    </div>
                                    <div class="content">
                                        <div class="content-left">
                                            <h6 class="title"> <a href="/product/details?id=<?php echo $row['id']; ?>"> <?php echo htmlspecialchars($row['product_name']); ?></a></h6>
                                            <ul class="review-star">
                                                <li class="fill"><i class="ion-android-star"></i></li>
                                                <li class="fill"><i class="ion-android-star"></i></li>
                                                <li class="fill"><i class="ion-android-star"></i></li>
                                                <li class="fill"><i class="ion-android-star"></i></li>
                                                <li class="empty"><i class="ion-android-star"></i></li>
                                            </ul>
                                        </div>
                                        <div class="content-right">
                                            <span class="price">$<?php echo number_format($row['price'], 2); ?></span>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
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
