<?php require_once 'views/partials/header.php'; ?>

<!-- ...:::: Start Breadcrumb Section :::... -->
<div class="breadcrumb-section breadcrumb-bg-color--golden bread">
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
                    <div class="product-details-text">
                        <h4 class="title"><?php echo htmlspecialchars($product['product_name']); ?></h4>
                        <div class="price">$<?php echo number_format($product['price'], 2); ?></div>

                        <!-- Display Average Rating -->
                 <!-- Display Average Rating -->
<div class="rating-stars">
    <?php if (isset($averageRating) && $averageRating > 0): ?>
        <?php 
            // Render the stars based on the average rating
            for ($i = 0; $i < round($averageRating); $i++): 
        ?>
            <ion-icon name="star-sharp" style="color: gold"></ion-icon>
        <?php endfor; ?>
        
        <?php 
            // Render empty stars for the remaining
            for ($i = round($averageRating); $i < 5; $i++): 
        ?>
            <ion-icon name="star-outline" style="color: gold"></ion-icon>
        <?php endfor; ?>

       
        <?php else: ?>
        <!-- Display empty stars if no rating is available -->
        <?php for ($i = 0; $i < 5; $i++): ?>
            <ion-icon name="star-outline" style="color: grey"></ion-icon>
        <?php endfor; ?>
    <?php endif; ?>
</div>


                        <p><?php echo htmlspecialchars($product['description']); ?></p>
                    </div>
                    <div class="product-details-variable">
                        <div class="variable-single-item">
                            <div class="product-stock"> 
                                <span class="product-stock-in"><i class="ion-checkmark-circled"></i></span> 
                                <?php echo ($product['stock_quantity']); ?> IN STOCK
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <form action="/cart/add" method="POST" class="add-to-cart-form">
                                <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                                <div class="product-add-to-cart-btn">
                                    <button type="submit" class="btn btn-block btn-lg btn-black-default-hover">+ Add To Cart</button>
                                </div>
                            </form>    
                        </div>
                        <div class="product-details-meta mb-20">
                            <a href="/wishlist/addProduct/<?= $product['id']; ?>" class="icon-space-right">
                                <i class="icon-heart"></i>Add to wishlist
                            </a>
                        </div> 
                    </div>
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
                    <ul class="nav tablist product-details-content-tab-btn d-flex justify-content-center">
                        <li><a class="nav-link" data-bs-toggle="tab" href="#review">Reviews</a></li>
                    </ul>

                    <div class="tab-pane" id="review">
                        <div class="single-tab-content-item">
                            <?php if (isset($_SESSION['success_message'])): ?>
                                <div class="alert alert-success"><?php echo htmlspecialchars($_SESSION['success_message']); ?></div>
                                <?php unset($_SESSION['success_message']); ?>
                            <?php endif; ?>

                            <?php if (isset($_SESSION['error_message'])): ?>
                                <div class="alert alert-danger"><?php echo htmlspecialchars($_SESSION['error_message']); ?></div>
                                <?php unset($_SESSION['error_message']); ?>
                            <?php endif; ?>

                            <ul class="comment">
                                <?php if (isset($reviews) && !empty($reviews)): ?>
                                    <?php foreach ($reviews as $review): ?>
                                        <div class="card">
                                            <div>
                                                <h5 class="review-header">
                                                    Username: <?php echo htmlspecialchars($review['username'] ?? 'Guest'); ?>
                                                    <span style="font-size: 15px; margin-left: 10px;">
                                                        <?php echo date('Y-m-d', strtotime($review['created_at'])); ?>
                                                    </span>
                                                </h5>
                                                <h4><?php echo htmlspecialchars($review['review_text']); ?></h4>
                                                <div class="rating-stars">
    <?php for ($i = 0; $i < $review['rating']; $i++): ?>
        <ion-icon name="star-sharp" style="color: gold"></ion-icon>
    <?php endfor; ?>
    
    <?php for ($i = $review['rating']; $i < 5; $i++): ?>
        <ion-icon name="star-outline" style="color: gold"></ion-icon>
    <?php endfor; ?>
</div>
                                                <?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $review['user_id']): ?>
                                                    <!-- Delete Review Button -->
                                                    <a href="#" data-review-id="<?= $review['id']; ?>" class="btnd btn-danger delete-review">Delete</a>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <p>No reviews found.</p>
                                <?php endif; ?>
                            </ul>

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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
   

</div> <!-- End Product Content Tab Section -->

<?php require_once 'views/partials/footer.php'; ?>



<!-- Include SweetAlert Script -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // SweetAlert for Delete Confirmation
    document.querySelectorAll('.delete-review').forEach(button => {
        button.addEventListener('click', function(event) {
            event.preventDefault();
            const reviewId = this.getAttribute('data-review-id');
            const productId = "<?php echo htmlspecialchars($product['id']); ?>";

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to undo this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = `/reviews/delete/${reviewId}?product_id=${productId}`;
                }
            });
        });
    });

    // Star Rating Click Event
    document.querySelectorAll('.star').forEach(star => {
        star.addEventListener('click', function() {
            const ratingValue = this.getAttribute('data-value');
            const ratingInput = document.getElementById('rating');

            ratingInput.value = ratingValue;

            document.querySelectorAll('.star').forEach(s => {
                s.classList.remove('selected');
            });

            this.classList.add('selected');
            let previousStar = this.previousElementSibling;
            while (previousStar) {
                previousStar.classList.add('selected');
                previousStar = previousStar.previousElementSibling;
            }
        });
    });
</script>
