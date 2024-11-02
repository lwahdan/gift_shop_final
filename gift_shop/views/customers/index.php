
<?php require_once 'views/partials/header.php';
//  require_once 'config/db.php'; 

$dir = '../public/images/product/';

require_once 'controllers/ProductController.php';
require_once 'controllers/CategoryController.php';


// $productController = new ProductController();
// $products = $productController->productModel->all();


?>

<!-- Start Hero Slider Section reem leen -->
<div class="hero-slider-section">
    <!-- Slider main container -->
    <div class="hero-slider-active swiper-container">
        <!-- Additional required wrapper -->
        <div class="swiper-wrapper">
            <!-- Start Hero Single Slider Item -->
            <div class="hero-single-slider-item swiper-slide">
                <!-- Hero Slider Image -->
                <div class="hero-slider-bg">
                    <img src="../public/images/hero-slider/home-1/hero-slider-1.jpg" alt="">
                    
                </div>

               
                <!-- Hero Slider Content -->
                <div class="hero-slider-wrapper">
                    <div class="container">
                        <div class="row">
                            <div class="col-auto">
                            <div class="myhero1">
                                <div class="hero-slider-content">
                                    <h4 class="subtitle subtitle1">Flowers that Speak the Language of Joy</h4>
                                    <h2 class="title title1">Beautiful blooms<br>to make your moments</h2>
                                    <h2 id="unforgettable"> unforgettable </h2>
                                    <!-- <a href="/customers/product-details-default"
                                       class="hero_btn1">shop now </a> -->
                                       <button class="hero_btn1" onclick="window.location.href='/products'" >shop now</button>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- End Hero Single Slider Item -->
            <!-- Start Hero Single Slider Item -->
            <div class="hero-single-slider-item swiper-slide">
                <!-- Hero Slider Image -->
                <div class="hero-slider-bg">
                    <img src="../public/images/hero-slider/home-1/hero-slider-2.jpg" alt="">
                </div>
                <!-- Hero Slider Content -->
                <div class="hero-slider-wrapper">
                    <div>
                        <div class="row">
                            <div class="col-auto">
                            <div class="hero2">
                                <div class="hero-slider-content">
                                <h4 class="subtitle subtitle2">Bring Nature Into Your Home</h4>
<h2 class="title title2">Lush Greenery<br>to Refresh Your Space</h2>
<h2 id="unforgettable2">Breathe Life Indoors</h2>
<a href="/products" class="btn btn-lg btn-outline-golden hero_btn2">Shop Plants</a>

                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- End Hero Single Slider Item -->
        </div>

        <!-- If we need pagination -->
        <div class="swiper-pagination active-color-golden"></div>

        <!-- If we need navigation buttons -->
        <div class="swiper-button-prev d-none d-lg-block"></div>
        <div class="swiper-button-next d-none d-lg-block"></div>
    </div>
</div>
<!-- End Hero Slider Section-->

<!-- Start Service Section -->
<div class="service-promo-section section-top-gap-100">
    <div class="service-wrapper">
        <div class="container">
            <div class="row">
                <!-- Start Service Promo Single Item -->
                <div class="col-lg-3 col-sm-6 col-12">
                    <div class="service-promo-single-item" data-aos="fade-up" data-aos-delay="0">
                        <div class="image">
                            <img src="../public/images/icons/service-promo-1.png" alt="">
                        </div>
                        <div class="content">
                            <h6 class="title">FREE SHIPPING</h6>
                            <p>Get 10% cash back, free shipping, free returns, and more at 1000+ top retailers!</p>
                        </div>
                    </div>
                </div>
                <!-- End Service Promo Single Item -->
                <!-- Start Service Promo Single Item -->
                <div class="col-lg-3 col-sm-6 col-12">
                    <div class="service-promo-single-item" data-aos="fade-up" data-aos-delay="200">
                        <div class="image">
                            <img src="../public/images/icons/service-promo-2.png" alt="">
                        </div>
                        <div class="content">
                            <h6 class="title">30 DAYS MONEY BACK</h6>
                            <p>100% satisfaction guaranteed, or get your money back within 30 days!</p>
                        </div>
                    </div>
                </div>
                <!-- End Service Promo Single Item -->
                <!-- Start Service Promo Single Item -->
                <div class="col-lg-3 col-sm-6 col-12">
                    <div class="service-promo-single-item" data-aos="fade-up" data-aos-delay="400">
                        <div class="image">
                            <img src="../public/images/icons/service-promo-3.png" alt="">
                        </div>
                        <div class="content">
                            <h6 class="title">SAFE PAYMENT</h6>
                            <p>Pay with the world’s most popular and secure payment methods.</p>
                        </div>
                    </div>
                </div>
                <!-- End Service Promo Single Item -->
                <!-- Start Service Promo Single Item -->
                <div class="col-lg-3 col-sm-6 col-12">
                    <div class="service-promo-single-item" data-aos="fade-up" data-aos-delay="600">
                        <div class="image">
                            <img src="../public/images/icons/service-promo-4.png" alt="">
                        </div>
                        <div class="content">
                            <h6 class="title">LOYALTY CUSTOMER</h6>
                            <p>Card for the other 30% of their purchases at a rate of 1% cash back.</p>
                        </div>
                    </div>
                </div>
                <!-- End Service Promo Single Item -->
            </div>
        </div>
    </div>
</div>
<!-- End Service Section -->



<!-- Start Product Default Slider Section -->
     <!-- Start Section Content Text Area -->

<div class="product-default-slider-section section-top-gap-100">
    <div class="section-title-wrapper" data-aos="fade-up" data-aos-delay="0">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-content-gap">
                        <div class="secton-content">
                            <h3 class="section-title">THE NEW ARRIVALS</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Start Section Content Text Area -->
   <!-- File: views/products/index.php -->

<!-- File: views/products/index.php -->

<div class="product-wrapper" data-aos="fade-up" data-aos-delay="200">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <!--<div class="product-slider-default-2rows default-slider-nav-arrow">-->
                   <div class="swiper-container product-default-slider-4grid-2row">
                        <div class="swiper-wrapper">
                            <?php foreach ($products as $row): ?>
                                <div class="product-default-single-item product-color--golden swiper-slide">
                                    <div class="image-box">
                                        <a href="/product/details?id=<?php echo $row['id']; ?>" class="image-link">
                                            <img src="<?php echo $dir . str_replace(' ', '%20', $row['image_url']); ?>" alt="Product Image">
                                        </a>
                                        <div class="tag">
                                        </div>
                                        <div class="action-link">

                                        <div class="action-link-left">
                                             <form action="/cart/add" method="POST">
                                             <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
                                             <button type="submit" class="btn btn-link btn-md btn-golden" >Add to Cart</button>
                                             </form>
                                        </div>


                                            <div class="action-link-right">
                                                <a href="/customers/wishlist"><i class="icon-heart"></i></a>
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
                   <!-- <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div> -->
                <!--</div>-->
            </div>
        </div>
    </div>
</div>


    <!--/////////////////////////////////////////////////////////////////////////////////////////////////-->
      
    <!--/////////////////////////////////////////////////////////////////////////////////////////////////-->
                                
<!-- End Product Default Slider Section -->


<!-- Start Banner Section -->
 <div class="mybanner">
<div class="banner-section">
<?php 
        $categoryController = new Category;
        $categories = $categoryController->all(); 
        
    ?>
    <div class="banner-wrapper clearfix">
        <!-- Start Banner Single Item -->
        <div class="banner-single-item banner-style-4 banner-animation banner-color--golden float-left img-responsive"
             data-aos="fade-up" data-aos-delay="0">
            <div class="image">
                <img class="img-fluid" src="../public/images/banner/banner-style-4-img-1.jpg" alt="">
            </div>
            <a href="/category/1" class="content">
                <div class="inner">
                    <h4 class="title">Bar Stool</h4>
                    <h6 class="sub-title">20 products</h6>
                </div>
                <span class="round-btn"><i class="ion-ios-arrow-thin-right"></i></span>
            </a>
        </div>
	

        <!-- End Banner Single Item -->
        <!-- Start Banner Single Item -->
        <div class="banner-single-item banner-style-4 banner-animation banner-color--golden float-left img-responsive"
             data-aos="fade-up" data-aos-delay="200">
            <div class="image">
                <img class="img-fluid" src="../public/images/banner/banner-style-4-img-2.jpg" alt="">
            </div>
            <a href="/category/2" class="content">
                <div class="inner">
                    <h4 class="title">Armchairs</h4>
                    <h6 class="sub-title">20 products</h6>
                </div>
                <span class="round-btn"><i class="ion-ios-arrow-thin-right"></i></span>
            </a>
        </div>
        <!-- End Banner Single Item -->
        <!-- Start Banner Single Item -->
        <div class="banner-single-item banner-style-4 banner-animation banner-color--golden float-left img-responsive"
             data-aos="fade-up" data-aos-delay="400">
            <div class="image">
                <img class="img-fluid" src="../public/images/banner/banner-style-4-img-3.jpg" alt="">
            </div>
            <a href="/category/3" class="content">
                <div class="inner">
                    <h4 class="title">lighting</h4>
                    <h6 class="sub-title">20 products</h6>
                </div>
                <span class="round-btn"><i class="ion-ios-arrow-thin-right"></i></span>
            </a>
        </div>
        <!-- End Banner Single Item -->
        <!-- Start Banner Single Item -->
        <div class="banner-single-item banner-style-4 banner-animation banner-color--golden float-left img-responsive"
             data-aos="fade-up" data-aos-delay="600">
            <div class="image">
                <img class="img-fluid" src="../public/images/banner/banner-style-4-img-4.jpg" alt="">
            </div>
            <a href="/category/1" class="content">
                <div class="inner">
                    <h4 class="title">Easy chairs</h4>
                    <h6 class="sub-title">20 products</h6>
                </div>
                <span class="round-btn"><i class="ion-ios-arrow-thin-right"></i></span>
            </a>
        </div>
        <!-- End Banner Single Item -->
    </div>
</div>
</div>
<!-- End Banner Section -->



<!--testimonials start-->
<div class="testimonial-section">
    <h2>What Our Customers Say</h2>
    <div class="testimonial-slider" id="testimonialSlider">
        <div class="testimonial-slide active">
            <p>"Beautiful flowers! They made my mom's birthday extra special. Excellent quality and delivery."</p>
            <h4>– Sarah J.</h4>
        </div>
        <div class="testimonial-slide">
            <p>"The chocolates were heavenly! Perfect for gifting and enjoying. Definitely coming back for more!"</p>
            <h4>– Mike R.</h4>
        </div>
        <div class="testimonial-slide">
            <p>"Loved the variety of plants. They’re thriving and bring such freshness to my home. Highly recommend!"</p>
            <h4>– Lisa M.</h4>
        </div>
    </div>

    <!-- Arrow buttons for navigation -->
    <button class="testimonial-arrow left" onclick="prevSlide()">&#10094;</button>
    <button class="testimonial-arrow right" onclick="nextSlide()">&#10095;</button>
</div>


<?php require 'views/partials/footer.php'; ?>

