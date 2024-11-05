<?php require_once 'views/partials/header.php'; ?>

<!-- ...:::: Start Breadcrumb Section :::... -->
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
</div> <!-- ...:::: End Breadcrumb Section :::... -->

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
                            <form action="/cart/add" method="POST" class="add-to-cart-form">
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
                            
                            <!-- Success and Error Messages -->
                            <?php if (isset($_SESSION['success_message'])): ?>
                                <div class="alert alert-success"><?php echo htmlspecialchars($_SESSION['success_message']); ?></div>
                                <?php unset($_SESSION['success_message']); ?>
                            <?php endif; ?>

                            <?php if (isset($_SESSION['error_message'])): ?>
                                <div class="alert alert-danger"><?php echo htmlspecialchars($_SESSION['error_message']); ?></div>
                                <?php unset($_SESSION['error_message']); ?>
                            <?php endif; ?>

                            <!-- Start - Displaying Reviews -->
                            <ul class="comment">
                                <?php if (isset($reviews) && !empty($reviews)): ?>
                                    <?php foreach ($reviews as $review): ?>
                                        <?php if ($review['status'] == 1): ?>
                                            <div class="card">
                                                <div>
                                                    <h5 class="review-header">
                                                        <?php echo isset($_SESSION['username']) ? "Username: " . htmlspecialchars($_SESSION['username']) : "Username: Guest"; ?>
                                                        <span style="font-size: 15px; margin-left: 10px;">
                                                            <?php echo date('Y-m-d', strtotime($review['updated_at'])); ?>
                                                        </span>
                                                    </h5>
                                                    <h4><?php echo htmlspecialchars($review['review_text']); ?></h4>
                                                    <div class="rating-stars">
                                                        <?php for ($i = 0; $i < $review['rating']; $i++): ?>
                                                            <ion-icon name="star-sharp" style="color: gold"></ion-icon>
                                                        <?php endfor; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <p>No reviews found.</p>
                                <?php endif; ?>
                            </ul> <!-- End - Displaying Reviews -->

                            <!-- Review Form: Only display if user is logged in -->
                            <?php if (isset($_SESSION['user_id'])): ?>
                                <form action="/reviews/create" method="POST">
                                    <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($product['id']); ?>">
                                    
                                    <table class="rev-form">
                                        <tr>
                                            <td><label for="review_text">Your Review:</label></td>
                                            <td><textarea name="review_text" id="review_text" placeholder="Write your review..." required></textarea></td>
                                        </tr>
                                        <tr>
                                            <td><label>Rating:</label></td>
                                            <td>
                                                <div class="star-rating" style="display: flex; align-items: center;">
                                                    <input type="hidden" name="rating" id="rating" value="" required>
                                                    <?php for ($i = 1; $i <= 5; $i++): ?>
                                                        <ion-icon name="star-outline" class="star" data-value="<?php echo $i; ?>" style="font-size: 24px; cursor: pointer;"></ion-icon>
                                                    <?php endfor; ?>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <button type="submit" class="btn btn-black-default-hover">Submit Review</button>
                                            </td>
                                        </tr>
                                    </table>
                                </form>
                            <?php else: ?>
                                <div class="login-prompt">
                                    <p><a href="/customers/login" style="color: red;"><strong>Log in</strong></a> to leave a review.</p>
                                </div>
                            <?php endif; ?>
                        </div> <!-- End Product Details Tab Content Single -->
                    </div> <!-- End Product Details Tab Content Single -->
                </div>
            </div>
        </div>
    </div>
</div> <!-- End Product Content Tab Section -->

<?php require_once 'views/partials/footer.php'; ?>

<!-- CSS Styles -->

<!-- JavaScript for Star Rating -->
<script>
    document.querySelectorAll('.star').forEach(star => {
        star.addEventListener('click', function() {
            const ratingValue = this.getAttribute('data-value');
            const ratingInput = document.getElementById('rating');

            // Set the hidden input value
            ratingInput.value = ratingValue;

            // Remove 'selected' class from all stars
            document.querySelectorAll('.star').forEach(s => {
                s.classList.remove('selected');
            });

            // Add 'selected' class to the clicked star and all previous stars
            this.classList.add('selected');
            let previousStar = this.previousElementSibling;
            while (previousStar) {
                previousStar.classList.add('selected');
                previousStar = previousStar.previousElementSibling;
            }
        });
    });
</script>
