<?php
// Retrieve cart items from the cookie if it exists
$cartItems = isset($_COOKIE['cart']) ? json_decode($_COOKIE['cart'], true) : [];

// Initialize subtotal
$subtotal = 0;

// Calculate the subtotal based on cart items
foreach ($cartItems as $item) {
    $subtotal += $item['price'] * $item['quantity'];
}

$dir = $dir ?? "../public/images/product/";
// var_dump($categories);
// exit;
?>

<!DOCTYPE html>
<html lang="zxx">


<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>MOMENTS</title>

    <!-- ::::::::::::::Favicon icon::::::::::::::-->
    <link rel="shortcut icon" href="../public/images/favicon.ico" type="image/png">
<link rel="stylesheet" href="../public/css/style.login.css">
    <link rel="stylesheet" href="../public/css/testimonial.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- ::::::::::::::All CSS Files here :::::::::::::: -->
    <!-- Vendor CSS -->
    <!-- <link rel="stylesheet" href="assets/css/vendor/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/vendor/ionicons.css">
    <link rel="stylesheet" href="assets/css/vendor/simple-line-icons.css">
    <link rel="stylesheet" href="assets/css/vendor/jquery-ui.min.css"> -->

    <!-- Plugin CSS -->
    <!-- <link rel="stylesheet" href="assets/css/plugins/swiper-bundle.min.css">
    <link rel="stylesheet" href="assets/css/plugins/animate.min.css">
    <link rel="stylesheet" href="assets/css/plugins/nice-select.css">
    <link rel="stylesheet" href="assets/css/plugins/venobox.min.css">
    <link rel="stylesheet" href="assets/css/plugins/jquery.lineProgressbar.css">
    <link rel="stylesheet" href="assets/css/plugins/aos.min.css"> -->

    <!-- Main CSS -->
    <!-- <link rel="stylesheet" href="assets/sass/style.css"> -->

    <!-- Use the minified version files listed below for better performance and remove the files listed above -->
    <link rel="stylesheet" href="../public/css/vendor/vendor.min.css">
    <link rel="stylesheet" href="../public/css/plugins/plugins.min.css">
    <link rel="stylesheet" href="../public/css/style.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;700&family=Great+Vibes&display=swap" rel="stylesheet">


</head>

<body>
<div id="flash-message" class="flash-message" style="display: none;">Added successfully</div>

<!-- Start Header Area -->
<header class="header-section d-none d-xl-block">
    <div class="header-wrapper">

        <div class="header-bottom header-bottom-color--golden section-fluid sticky-header sticky-color--golden">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 d-flex align-items-center justify-content-between">
                        <!-- Start Header Logo -->
                        <div class="header-logo">
                            <div class="logo">
                                <a href="/home"><img src="../public/images/extra/logo.png" alt="" class="logo_img"></a>
                            </div>
                        </div>
                        <!-- End Header Logo -->

                       

                        <!-- Start Header Main Menu original -->
                        <div class="main-menu menu-color--black menu-hover-color--golden">
                            <nav>
                                <ul>
                                    <li class="has-dropdown">
                                        <a class="active main-menu-link" href="/home">Home</a>
                                    </li>
                                    <li class="has-dropdown has-megaitem">
                                        <a href="#">Shop
                                            <i class="fa fa-angle-down"></i></a>
                                        <div class="mega-menu">
                                            <ul class="mega-menu-inner">

                                                <li class="mega-menu-item">
                                                    <ul class="mega-menu-sub">
                                                        <li><a href="/category/1">Flowers</a></li>
                    
                                                        <li><a href="/category/2">Plants</a></li>
                                                        <li><a href="/category/3">Chocolates</a></li>
                                                        <li><a href="/category/4">Packages</a></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>

                                    <li>
                                        <a href="/customers/about-us">About Us</a>
                                    </li>

                                    <li>
                                        <a href="/customers/contact-us">Contact Us</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                        <!-- End Header Main Menu Start original-->

                        <!-- Start Header Action Link -->
                        <ul class="header-action-link action-color--black action-hover-color--golden">
                      

                            <li>
                                <a href="/wishlist">
                                    <i class="icon-heart"></i>
                                    <span id="wishlist-count">0</span>
                                </a>
                            </li>
                            
                            <li>
                                <a href="#offcanvas-add-cart" class="offcanvas-toggle">
                                    <i class="icon-bag"></i>
                                    <span id="cart-count">0</span>
                                </a>
                            </li>

                            <li>
                                <a href="#search">
                                    <i class="icon-magnifier"></i>
                                </a>
                            </li>
                         <li>   <div class="profile-container">
    <?php if (isset($_SESSION['user_id'])): ?>
        <!-- User is logged in: show profile icon with dropdown -->
        <i class="icon-user" onclick="toggleDropdown()" id="profileIcon"></i>
        <div class="dropdown-men" id="profileDropdown">
            <a class="normal-spacing" href="/customers/profile" style="letter-spacing: normal !important;font-size:15px !important;">My Account</a>
            <a class="normal-spacing" href="/customers/logout" style="letter-spacing: normal !important;font-size:15px !important;">Logout</a>
        </div>
    <?php else: ?>
        <!-- User is not logged in: show login link -->
        <button class="logbtn" ><a class="loga" id="profileText" href="/customers/login" style="letter-spacing: normal !important; color: #fff;font-size:15px !important;">Login</a></button>
    <?php endif; ?>
</div>  </li>
                            <li>
                                <a href="#offcanvas-about" class="offacnvas offside-about offcanvas-toggle">
                                    <i class="icon-menu"></i>
                                </a>
                            </li>
                        </ul>
                        <!-- End Header Action Link -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- Start Header Area -->

<!-- Start Mobile Header -->
<div class="mobile-header mobile-header-bg-color--golden section-fluid d-lg-block d-xl-none">
    <div class="container">
        <div class="row">
            <div class="col-12 d-flex align-items-center justify-content-between">
                <!-- Start Mobile Left Side -->
                <div class="mobile-header-left">
                    <ul class="mobile-menu-logo">
                        <li>
                            <a href="/customers/index">
                                <div class="logo">
                                    <img src="../public/images/logo/logo_black.png" alt="">
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- End Mobile Left Side -->

                <!-- Start Mobile Right Side -->
                <div class="mobile-right-side">
                    <ul class="header-action-link action-color--black action-hover-color--golden">
                        <li>
                            <a href="#search">
                                <i class="icon-magnifier"></i>
                            </a>
                        </li>
                           
                        <li>
                            <a href="#offcanvas-wishlish" class="offcanvas-toggle">
                                <i class="icon-heart"></i>
                                <span class="xxx">0</span>
                            </a>
                        </li>
                        <li>
                            <a href="#offcanvas-add-cart" class="offcanvas-toggle">
                                <i class="icon-bag"></i>
                                <span class="item-count">3</span>
                            </a>
                        </li>
                        <li>   
                            <div class="profile-container">
    <?php if (isset($_SESSION['user_id'])): ?>
        <!-- User is logged in: show profile icon with dropdown -->
        <i class="icon-user" onclick="toggleDropdown()" id="profileIcon"></i>
        <div class="dropdown-men" id="profileDropdown">
            <a class="normal-spacing" href="/customers/profile" style="letter-spacing: normal !important;font-size:15px !important;">My Account</a>
            <a class="normal-spacing" href="/customers/logout" style="letter-spacing: normal !important;font-size:15px !important;">Logout</a>
        </div>
    <?php else: ?>
        <!-- User is not logged in: show login link -->
        <button class="logbtn" ><a class="loga" id="profileText" href="/customers/login" style="letter-spacing: normal !important; color: #fff;font-size:15px !important;">Login</a></button>
    <?php endif; ?>
</div>  </li>
                        <li>
                            <a href="#mobile-menu-offcanvas" class="offcanvas-toggle offside-menu">
                                <i class="icon-menu"></i>
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- End Mobile Right Side -->
            </div>
        </div>
    </div>
</div>
<!-- End Mobile Header -->

<!--  Start Offcanvas Mobile Menu Section -->
<div id="mobile-menu-offcanvas" class="offcanvas offcanvas-rightside offcanvas-mobile-menu-section">
    <!-- Start Offcanvas Header -->
    <div class="offcanvas-header text-right">
        <button class="offcanvas-close"><i class="ion-android-close"></i></button>
    </div> <!-- End Offcanvas Header -->
    <!-- Start Offcanvas Mobile Menu Wrapper -->
    <div class="offcanvas-mobile-menu-wrapper">
        <!-- Start Mobile Menu  -->
        <div class="mobile-menu-bottom">
            <!-- Start Mobile Menu Nav -->
            <div class="offcanvas-menu">
                <ul>
                    <li>
                        <a href="/customers/index"><span>Home</span></a>

                    </li>

                    <li>
                        <a href=""><span>Shop</span></a>
                        <ul class="mobile-sub-menu">
                            <li><a href="/category/1">Flowers</a></li>
                            <li><a href="/category/2">Plants</a></li>
                            <li><a href="/category/3">Chocolates</a></li>
                            <li><a href="/category/4">Packages</a></li>
                        </ul>
                        <!--                            </li>-->
                        <!--                        </ul>-->
                    </li>

                    <li><a href="/customers/about-us">About Us</a></li>
                    <li><a href="/customers/contact-us">Contact Us</a></li>
                    <li><a href="/customers/contact-us">Login</a></li>
                </ul>
            </div> <!-- End Mobile Menu Nav -->
        </div> <!-- End Mobile Menu -->

        <!-- Start Mobile contact Info -->
        <div class="mobile-contact-info">
            <div class="logo">
                <a href="/home"><img src="../public/images/extra/logo.png" alt=""></a>
            </div>

            <address class="address">
                <span>Address: Jordan - Amman</span>
                <span>Call Us: 0123456789, 0123456789</span>
                <span>Email: moments@example.com</span>
            </address>

            <ul class="social-link">
                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
            </ul>

            <ul class="user-link">
                <li><a href="/wishlist">Wishlist</a></li>
                <li><a href="/customers/cart">Cart</a></li>
                <li><a href="/customers/checkout">Checkout</a></li>
            </ul>
        </div>
        <!-- End Mobile contact Info -->

    </div> <!-- End Offcanvas Mobile Menu Wrapper -->
</div> <!-- ...:::: End Offcanvas Mobile Menu Section:::... -->

<!-- Start Offcanvas Mobile Menu Section -->
<div id="offcanvas-about" class="offcanvas offcanvas-rightside offcanvas-mobile-about-section">
    <!-- Start Offcanvas Header -->
    <div class="offcanvas-header text-right">
        <button class="offcanvas-close"><i class="ion-android-close"></i></button>
    </div> <!-- End Offcanvas Header -->
    <!-- Start Offcanvas Mobile Menu Wrapper -->
    <!-- Start Mobile contact Info -->
    <div class="mobile-contact-info">
        <div class="logo">
            <a href="/home"><img src="../public/images/extra/logo.png" alt=""></a>
        </div>

        <address class="address">

           <span> <a href="mailto:moments@gmail.com">moments@gmail.com</a></span>
           <span>  <a href="https://www.google.com/maps/place/Orange+Digital+Village/@31.9701689,35.8729409,14z/data=!3m1!4b1!4m6!3m5!1s0x151ca1dd7bca79dd:0x9b0416f056ff0786!8m2!3d31.9701742!4d35.9098069!16s%2Fg%2F11lt2s9hb3?entry=ttu&g_ep=EgoyMDI0MTAyOS4wIKXMDSoASAFQAw%3D%3D" target="_blank">Jordan - Amman</a></span>

<span><a href="tel:+0777891011">0777891011</a></span>
            </address>

            <ul class="social-link">

                            <li><a href="https://www.facebook.com/" target="_blank"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="https://x.com/" target="_blank"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="https://www.instagram.com/" target="_blank"><i class="fa fa-instagram"></i></a></li>
                                <li><a href="https://www.linkedin.com/" target="_blank"><i class="fa fa-linkedin"></i></a></li>

            </ul>

        <ul class="user-link">
            <li><a href="/wishlist">Wishlist</a></li>
            <li><a href="/customers/cart">Cart</a></li>
            <li><a href="/customers/checkout">Checkout</a></li>
        </ul>
    </div>
    <!-- End Mobile contact Info -->
</div> <!-- ...:::: End Offcanvas Mobile Menu Section:::... -->

<!-- Start Offcanvas Addcart Section -->
<div id="offcanvas-add-cart" class="offcanvas offcanvas-rightside offcanvas-add-cart-section">
    <!-- Start Offcanvas Header -->
    <div class="offcanvas-header text-right">
        <button class="offcanvas-close"><i class="ion-android-close"></i></button>
    </div> <!-- End Offcanvas Header -->

    <!-- Start  Offcanvas Addcart Wrapper -->
    <div class="offcanvas-add-cart-wrapper">
        <h4 class="offcanvas-title">Shopping Cart</h4>
        <ul class="offcanvas-cart">
    <?php foreach ($cartItems as $item): ?>
        <li class="offcanvas-cart-item-single">
            <div class="offcanvas-cart-item-block">
                <!-- Image -->
                <a href="#" class="offcanvas-cart-item-image-link">
                    <img src="<?php echo $dir . '/' . urlencode($item['image_url']); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>" class="offcanvas-cart-image">
                </a>

                <!-- Item Content -->
                <div class="offcanvas-cart-item-content">
                    <a href="#" class="offcanvas-cart-item-link"><?php echo htmlspecialchars($item['name']); ?></a>
                    <div class="offcanvas-cart-item-details">
                        <span class="offcanvas-cart-item-details-quantity"><?php echo $item['quantity']; ?> x </span>
                        <span class="offcanvas-cart-item-details-price">$<?php echo number_format($item['price'], 2); ?></span>
                    </div>
                </div>
            </div>

            <!-- Delete Button -->
            <div class="offcanvas-cart-item-delete text-right">
                <form class="delete-item-form" action="/cart/remove" method="POST">
                    <input type="hidden" name="product_id" value="<?php echo $item['id']; ?>">
                    <button type="submit" class="offcanvas-cart-item-delete"><i class="fa fa-trash-o"></i></button>
                </form>
            </div>

            
        </li>
    <?php endforeach; ?>
</ul>


<!-- Display the subtotal -->
<div class="offcanvas-cart-total-price">
    <span class="offcanvas-cart-total-price-text">Subtotal:</span>
    <span class="offcanvas-cart-total-price-value">
        $<?php echo number_format($subtotal, 2); ?>
    </span>
</div>

        <ul class="offcanvas-cart-action-button">
            <li><a href="/customers/cart" class="btn btn-block btn-golden">View Cart</a></li>
            <li><a href="/customers/checkout" class=" btn btn-block btn-golden mt-5">Checkout</a></li>
        </ul>
    </div> <!-- End  Offcanvas Addcart Wrapper -->

</div> <!-- End  Offcanvas Addcart Section -->

<!-- Start Offcanvas Mobile Menu Section -->
<div id="offcanvas-wishlish" class="offcanvas offcanvas-rightside offcanvas-add-cart-section">
    <!-- Start Offcanvas Header -->
    <div class="offcanvas-header text-right">
        <button class="offcanvas-close"><i class="ion-android-close"></i></button>
    </div> <!-- ENd Offcanvas Header -->

    <!-- Start Offcanvas Mobile Menu Wrapper -->
    <!-- <div class="offcanvas-wishlist-wrapper">
        <h4 class="offcanvas-title">Wishlist</h4>
        <ul class="offcanvas-wishlist">
        <?php foreach ($wishlistItems as $item): ?>
                <?php
                    // Fetch product details from a hypothetical Product model
                    $product = $productModel->find($item['product_id']);
                ?>
                <li class="offcanvas-wishlist-item-single">
                <div class="offcanvas-wishlist-item-block">
                    <a href="#" class="offcanvas-wishlist-item-image-link">
                        <img src="/gift_shop/public/images/product/<?=$item['image_url']?>" alt="<?=$item['product_name']?>"
                             class="offcanvas-wishlist-image">
                    </a>
                    <div class="offcanvas-wishlist-item-content">
                        <a href="#" class="offcanvas-wishlist-item-link"><?=$item['product_name']?></a>
                        <div class="offcanvas-wishlist-item-details">
                            <span class="offcanvas-wishlist-item-details-quantity">1 x </span>
                            <span class="offcanvas-wishlist-item-details-price">$<?= number_format($product['price'], 2) ?></span>
                        </div>
                    </div>
                </div>
                <div class="offcanvas-wishlist-item-delete text-right">
                    <a href="#" class="offcanvas-wishlist-item-delete"><i class="fa fa-trash-o"></i></a>
                </div>
            </li>
            <?php endforeach; ?>
            
        </ul>
        <ul class="offcanvas-wishlist-action-button">
            <li><a href="/wishlist" class="btn btn-block btn-golden">View wishlist</a></li>
        </ul>
    </div> -->
     <!-- End Offcanvas Mobile Menu Wrapper -->

</div> <!-- End Offcanvas Mobile Menu Section -->

<!-- Start Offcanvas Search Bar Section -->
<div id="search" class="search-modal">
    <button type="button" class="close">×</button>
    <form action="/search" method="get">
        <input type="search" name="search" placeholder="type keyword(s) here"/>
        <button type="submit" class="btn btn-lg btn-golden">Search</button>
    </form>
</div>
<!-- End Offcanvas Search Bar Section -->

<!-- Offcanvas Overlay -->



<script>
    function toggleDropdown() {
        // Only toggle dropdown if user is logged in
        const profileDropdown = document.getElementById("profileDropdown");
        const isLoggedIn = <?php echo isset($_SESSION['user_id']) ? 'true' : 'false'; ?>;

        if (isLoggedIn && profileDropdown) {
            profileDropdown.classList.toggle("show"); // Toggle dropdown visibility
        }
    }

    // Close dropdown if clicking outside of it
    document.addEventListener("click", function(event) {
        const profileDropdown = document.getElementById("profileDropdown");
        const profileIcon = document.getElementById("profileIcon");

        if (profileDropdown && !profileDropdown.contains(event.target) && event.target !== profileIcon) {
            profileDropdown.classList.remove("show");
        }
    });
</script>