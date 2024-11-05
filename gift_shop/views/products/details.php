<?php require_once 'views/partials/header.php'; ?>

<!-- ...:::: Start Breadcrumb Section:::... -->
<div class="breadcrumb-section breadcrumb-bg-color--golden">
    <div class="breadcrumb-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h3 class="breadcrumb-title">Product Details</h3>
                    <div class="breadcrumb-nav breadcrumb-nav-color--black breadcrumb-nav-hover-color--golden">
                        <nav aria-label="breadcrumb">
                            <ul>
                                <li><a href="/home">Home</a></li>
                                <li class="active" aria-current="page">Product Details</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> <!-- ...:::: End Breadcrumb Section:::... -->

<!-- Start Product Details Section -->
<div class="product-details-section">
    <div class="container">
        <div class="row">
            <div class="col-xl-5 col-lg-6">
                <div class="product-details-gallery-area" data-aos="fade-up" data-aos-delay="0">
                    <!-- Start Large Image -->
                    <div class="product-large-image product-large-image-horizontal swiper-container">
                        <div class="swiper-wrapper">
                            <div class="product-image-large-image swiper-slide zoom-image-hover img-responsive">
                                <img src="<?php echo $dir . $product['image_url'];?>" alt="">
                            </div>
                            <div class="product-image-large-image swiper-slide zoom-image-hover img-responsive">
                                <img src="../public/assets/images/product/default/home-1/default-2.jpg" alt="">
                            </div>
                            <div class="product-image-large-image swiper-slide zoom-image-hover img-responsive">
                                <img src="../public/assets/images/product/default/home-1/default-3.jpg" alt="">
                            </div>
                            <div class="product-image-large-image swiper-slide zoom-image-hover img-responsive">
                                <img src="../public/assets/images/product/default/home-1/default-4.jpg" alt="">
                            </div>
                            <div class="product-image-large-image swiper-slide zoom-image-hover img-responsive">
                                <img src="../public/assets/images/product/default/home-1/default-5.jpg" alt="">
                            </div>
                            <div class="product-image-large-image swiper-slide zoom-image-hover img-responsive">
                                <img src="../public/assets/images/product/default/home-1/default-6.jpg" alt="">
                            </div>
                        </div>
                    </div>
                    <!-- End Large Image -->
                </div>
            </div>
            <div class="col-xl-7 col-lg-6">
                <div class="product-details-content-area product-details--golden" data-aos="fade-up" data-aos-delay="200">

                    <!-- Start Product Details Text Area -->
                    

                    <div class="product-details-text">
                        <h4 class="title"><?php echo htmlspecialchars($product['product_name']); ?></h4>
                        <div class="d-flex align-items-center">
                            <ul class="review-star">
                                <li class="fill"><i class="ion-android-star"></i></li>
                                <li class="fill"><i class="ion-android-star"></i></li>
                                <li class="fill"><i class="ion-android-star"></i></li>
                                <li class="fill"><i class="ion-android-star"></i></li>
                                <li class="empty"><i class="ion-android-star"></i></li>
                            </ul>
                            <a href="#" class="customer-review ml-2">(customer review)</a>
                        </div>
                        <div class="price">$<?php echo number_format($product['price'], 2); ?></div>
                        <p><?php echo htmlspecialchars($product['description']); ?></p>
                    </div>
                    <!-- End Product Details Text Area -->

                    <!-- Start Product Variable Area -->
                    <div class="product-details-variable">

                        <!-- Product Variable Single Item -->
                        <div class="variable-single-item">
                            <div class="product-stock"> <span class="product-stock-in"><i class="ion-checkmark-circled"></i></span> <?php echo ($product['stock_quantity']); ?> IN STOCK</div>
                        </div>
                        <!-- Product Variable Single Item -->
                        <div class="d-flex align-items-center">
                          
                            <!-- Add to Cart Form start-->
    <form action="/cart/add" method="POST" class="my_cart_details_form">
        <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
        <div class="product-add-to-cart-btn">
            <button type="submit" class="btn btn-block btn-lg btn-black-default-hover">+ Add To Cart</button>
        </div>
    </form>
    <!-- Add to Cart end -->
                        </div>
                        <!-- Start Product Details Meta Area -->
                        <div class="product-details-meta mb-20">
                            <a href="/wishlist/addProduct/<?= $product['id']; ?>" class="icon-space-right"><i class="icon-heart"></i>Add to wishlist</a>
                        </div> <!-- End Product Details Meta Area -->
                    </div> <!-- End Product Variable Area -->
                </div>
            </div>
        </div>
    </div>
</div> <!-- End Product Details Section -->

<!-- Start Product Content Tab Section -->
<div class="product-details-content-tab-section section-top-gap-100">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="product-details-content-tab-wrapper" data-aos="fade-up" data-aos-delay="0">

                    <!-- Start Product Details Tab Button -->
                    <ul class="nav tablist product-details-content-tab-btn d-flex justify-content-center">
                        <li><a class="nav-link" data-bs-toggle="tab" href="#review">Reviews</a></li>
                    </ul> <!-- End Product Details Tab Button -->

                    <!-- Start Product Details Tab Content Single -->
                    <div class="tab-pane" id="review">
                        <div class="single-tab-content-item">
                            <!-- Start - Review Comment -->
                            <ul class="comment">
                                <!-- Display existing reviews -->
                                <?php if (!empty($reviews)): ?>
                                    <?php foreach ($reviews as $review): ?>
                                        <li>
                                            <div class="review-item">
                                                <p><strong>Rating:</strong> <?php echo htmlspecialchars($review['rating']); ?> Stars</p>
                                                <p><strong>Your Review:</strong> <?php echo htmlspecialchars($review['review_text']); ?></p>
                                            </div>
                                        </li>
                                    <?php endforeach; ?>
                                
                                <?php endif; ?>
                            </ul> <!-- End - Review Comment -->
<?php if (isset($_SESSION['success_message'])): ?>
                        <div class="alert alert-success"><?php echo htmlspecialchars($_SESSION['success_message']); ?></div>
                        <?php unset($_SESSION['success_message']); // Clear after displaying ?>
                    <?php endif; ?>

                    <!-- Error message alert -->
                    <?php if (isset($_SESSION['error_message'])): ?>
                        <div class="alert alert-danger"><?php echo htmlspecialchars($_SESSION['error_message']); ?></div>
                        <?php unset($_SESSION['error_message']); // Clear after displaying ?>
                    <?php endif; ?>
                            <h3>Leave a Review</h3>
                            <table class="rev-form">
                                <form action="/reviews/create" method="POST">
                                    <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($product['id']); ?>">
                                    <tr>
                                        <td><label for="review_text">Your Review:</label></td>
                                        <td><textarea name="review_text" id="review_text" placeholder="Write your review..." required></textarea></td>
                                    </tr>
                                    <tr>
                                        <td><label for="rating">Rating:</label></td>
                                        <td>
                                            <select name="rating" id="rating" required>
                                                <option value="">Select Rating</option>
                                                <option value="1">1 Star</option>
                                                <option value="2">2 Stars</option>
                                                <option value="3">3 Stars</option>
                                                <option value="4">4 Stars</option>
                                                <option value="5">5 Stars</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <button type="submit" class="btn btn-black-default-hover">Submit Review</button>
                                        </td>
                                    </tr>
                                </form>
                            </table>
                        </div> <!-- End Product Details Tab Content Single -->
                    </div> <!-- End Product Details Tab Content Single -->
                </div>
            </div>
        </div>
    </div>
</div> <!-- End Product Content Tab Section -->

<?php require_once 'views/partials/footer.php'; ?>
