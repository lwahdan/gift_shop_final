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

    <!-- Use the minified version files listed below for better performance and remove the files listed above -->
    <link rel="stylesheet" href="../public/css/vendor/vendor.min.css">
    <link rel="stylesheet" href="../public/css/plugins/plugins.min.css">
    <link rel="stylesheet" href="../public/css/style.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;700&family=Great+Vibes&display=swap" rel="stylesheet">


</head>

<body>
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

                        <!-- Start Header Main Menu -->
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
                        <!-- End Header Main Menu Start -->

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
<!-- End Header Area -->

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
           <span>  <a href="https://www.google.com/maps/place/Orange+Digital+Village/@31.9701689,35.8729409,14z/data=!3m1!4b1!4m6!3m5!1s0x151ca1dd7bca79dd:0x9b0416f056ff0786!8m2!3d31.9701742!4d35.9098069!16s%2Fg%2F11lt2s9hb3?entry=ttu&g_ep=EgoyMDI0MTAyOS4wIKXMDSoASAFQAw%3D%3D" target="_blank">Ar-Razi St. 141, Amman</a></span>

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


</div> <!-- End Offcanvas Mobile Menu Section -->

<!-- Start Offcanvas Search Bar Section -->
<div id="search" class="search-modal">
    <button type="button" class="close">×</button>
    <form action="/search" method="get">
        <input type="search" name="search" placeholder="type keyword(s) here" />
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
</script><!-- ...:::: Start Breadcrumb Section:::... -->
<div class="breadcrumb-section breadcrumb-bg-color--golden">
    <div class="breadcrumb-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h3 class="breadcrumb-title">My Account</h3>
                    <div class="breadcrumb-nav breadcrumb-nav-color--black breadcrumb-nav-hover-color--golden">
                        <nav aria-label="breadcrumb">
                            <ul>
                                <li><a href="/home">Home</a></li>
                                <li class="active" aria-current="page">My Account</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> <!-- ...:::: End Breadcrumb Section:::... -->

<!-- ...:::: Start Account Dashboard Section:::... -->
<div class="account-dashboard">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-3 col-lg-3">
                <!-- Nav tabs -->
                <div class="dashboard_tab_button" data-aos="fade-up" data-aos-delay="0">
                    <ul role="tablist" class="nav flex-column dashboard-list">
                        <li><a href="#dashboard" data-bs-toggle="tab" class="nav-link btn btn-block btn-md btn-black-default-hover active">Dashboard</a></li>
                        <li><a href="#orders" data-bs-toggle="tab" class="nav-link btn btn-block btn-md btn-black-default-hover">Orders</a></li>
                        <li><a href="#addresses" data-bs-toggle="tab" class="nav-link btn btn-block btn-md btn-black-default-hover">Address</a></li>
                        <li><a href="/customers/logout" class="nav-link btn btn-block btn-md btn-black-default-hover">Logout</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-12 col-md-9 col-lg-9">
                <!-- Tab panes -->
                <div class="tab-content dashboard_content" data-aos="fade-up" data-aos-delay="200">
                    <div class="tab-pane fade show active" id="dashboard">
                        <section>
                            <div class="profile-form">
                                <div class="profile-table">
                                    <table>
                                    <?php if (isset($_SESSION['message'])): ?>
                                            <div class="alert alert-danger"><?php echo $_SESSION['message']; unset($_SESSION['message']); ?></div>
                                        <?php endif; ?>
                                        <?php if (isset($_SESSION['success_message'])): ?>
                                            <div class="alert alert-success"><?php echo htmlspecialchars($_SESSION['success_message']); unset($_SESSION['success_message']); ?></div>
                                        <?php endif; ?>
                                        <tr>
                                            <td><strong>Username</strong></td>
                                            <td><?php echo htmlspecialchars($user['username']); ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Email</strong></td>
                                            <td><?php echo htmlspecialchars($user['email']); ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Full Name</strong></td>
                                            <td><?php echo htmlspecialchars($user['first_name'] . ' ' . $user['last_name']); ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Phone Number</strong></td>
                                            <td><?php echo htmlspecialchars($user['phone_number']); ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Address</strong></td>
                                            <td><?php echo htmlspecialchars($user['address']); ?></td>
                                        </tr>
                                        <tr>
                                            <td><button class="buttonn" id="editProfileBtn">Edit</button></td>
                                            <td><button class="buttonn" id="changePasswordBtn">Change Password</button></td>
                                        </tr>
                                    </table>
                                </div>

                                <!-- Change Password Form -->
                                <div id="changePasswordForm" style="display:none;">
                                    <form action="/auth/changePassword" method="POST">
                                        
                                        <table class="profile-table">
                                            <tr>
                                                <td><label for="current_password">Current Password:</label></td>
                                                <td><input class="inprofile" type="password" name="current_password" id="current_password" required></td>
                                            </tr>
                                            <tr>
                                                <td><label for="new_password">New Password:</label></td>
                                                <td><input class="inprofile" type="password" name="new_password" id="new_password" required></td>
                                            </tr>
                                            <tr>
                                                <td><label for="confirm_new_password">Confirm New Password:</label></td>
                                                <td><input class="inprofile" type="password" name="confirm_new_password" id="confirm_new_password" required></td>
                                            </tr>
                                            <tr>
                                                <td colspan="2"><button class="buttonn" type="submit">Change Password</button></td>
                                                <td colspan="2"><button class="cancelChangeBtn"  type="button" id="cancelChangeBtn">Cancel</button></td>
                                            </tr>
                                        </table>
                                    </form>
                                </div>

                                <!-- Edit Profile Form -->
                                <div id="editProfileForm" style="display:none;">
                                    <form action="/profile/updateProfile" method="POST">
                                    
                                        <table>
                                            <tr>
                                                <td><label for="username">Username:</label></td>
                                                <td><input class="inprofile" type="text" name="username" id="username" value="<?php echo htmlspecialchars($user['username']); ?>" required></td>
                                            </tr>
                                            <tr>
                                                <td><label for="email">Email:</label></td>
                                                <td><input class="inprofile" type="email" name="email" id="email" value="<?php echo htmlspecialchars($user['email']); ?>" required></td>
                                            </tr>
                                            <tr>
                                                <td><label for="first_name">First Name:</label></td>
                                                <td><input class="inprofile" type="text" name="first_name" id="first_name" value="<?php echo htmlspecialchars($user['first_name']); ?>" required></td>
                                            </tr>
                                            <tr>
                                                <td><label for="last_name">Last Name:</label></td>
                                                <td><input class="inprofile" type="text" name="last_name" id="last_name" value="<?php echo htmlspecialchars($user['last_name']); ?>" required></td>
                                            </tr>
                                            <tr>
                                                <td><label for="phone_number">Phone Number:</label></td>
                                                <td><input class="inprofile" type="tel" name="phone_number" id="phone_number" value="<?php echo htmlspecialchars($user['phone_number']); ?>" required></td>
                                            </tr>
                                            <tr>
                                                <td><label for="address">Address:</label></td>
                                                <td><input class="inprofile" type="text" name="address" id="address" value="<?php echo htmlspecialchars($user['address']); ?>" required></td>
                                            </tr>
                                            <tr>
                                                <td><label for="city">City:</label></td>
                                                <td><input class="inprofile" type="text" name="city" id="city" value="<?php echo htmlspecialchars($user['city']); ?>" required></td>
                                            </tr>
                                            <tr>
                                                <td><label for="postal_code">Postal Code:</label></td>
                                                <td><input class="inprofile" type="text" name="postal_code" id="postal_code" value="<?php echo htmlspecialchars($user['postal_code']); ?>" required></td>
                                            </tr>
                                            <tr>
                                                <td><label for="country">Country:</label></td>
                                                <td><input class="inprofile" type="text" name="country" id="country" value="<?php echo htmlspecialchars($user['country']); ?>" required></td>
                                            </tr>
                                            <tr>
                                                <td colspan="2"><button class="buttonn" type="submit">Save</button></td>
                                                <td colspan="2"><button class="cancelChangeBtn"  type="button" id="cancelEditBtn">Cancel</button></td>
                                            </tr>
                                        </table>
                                    </form>
                                </div>
                            </div>
                        </section>
                    </div>

                    <div class="tab-pane fade" id="orders">
    <section>
        <h4>Your Orders</h4>
        <?php if (!empty($orders)): ?>
            <table class="order-table">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Total Price</th>
                        <th>Status</th>
                        <th>Order Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orders as $order): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($order['id']); ?></td>
                            <td><?php echo htmlspecialchars($order['total_price']); ?></td>
                            <td><?php echo htmlspecialchars($order['status']); ?></td>
                            <td><?php echo htmlspecialchars($order['order_date']); ?></td>
                            <td><a href="/order/details/<?= $order['id']?>" class="details-link">Details</a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>You have no orders yet.</p>
        <?php endif; ?>
    </section>

    <!-- Order Details Modal -->
<!-- Order Details Modal -->
<div class="modal fade" id="orderDetailsModal" tabindex="-1" aria-labelledby="orderDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="orderDetailsModalLabel">Order Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Customer Info -->
                <h6>Customer Information</h6>
                <div class="table-responsive">
                    <table class="table" id="customerInfoTable">
                        <!-- Populated by JavaScript -->
                    </table>
                </div>

                <!-- Order Info -->
                <h6>Order Information</h6>
                <div class="table-responsive">
                    <table class="table" id="orderInfoTable">
                        <!-- Populated by JavaScript -->
                    </table>
                </div>

                <!-- Product Details -->
                <h6>Product Details</h6>
                <div class="table-responsive">
                    <table class="table" id="productDetailsTable">
                        <thead>
                            <tr>
                                <th>Product Name</th>
                                <th>Description</th>
                                <th>Unit Price</th>
                                <th>Quantity</th>
                                <th>Total Price</th>
                                <th>Image</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Populated by JavaScript -->
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


</div>


                    
                    <div class="tab-pane fade" id="addresses" class="address-container">
                    <h3>Address Information</h3>
<?php if (!empty($address)): ?>
    <table class="address-table">
        <tbody>
            <tr>
                <th>Address</th>
                <td><?php echo htmlspecialchars($address['address']); ?></td>
            </tr>
            <tr>
                <th>City</th>
                <td><?php echo htmlspecialchars($address['city']); ?></td>
            </tr>
            <tr>
                <th>Postal Code</th>
                <td><?php echo htmlspecialchars($address['postal_code']); ?></td>
            </tr>
            <tr>
                <th>Country</th>
                <td><?php echo htmlspecialchars($address['country']); ?></td>
            </tr>
        </tbody>
    </table>
<?php else: ?>
    <p>No address information available.</p>
<?php endif; ?>
</div>
                
            </div>
        </div>
    </div>
</div> <!-- ...:::: End Account Dashboard Section:::... -->

<?php require 'views/partials/footer.php'; ?>

<!-- JavaScript to handle tab visibility -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const editProfileBtn = document.getElementById('editProfileBtn');
        const changePasswordBtn = document.getElementById('changePasswordBtn');
        const cancelChangeBtn = document.getElementById('cancelChangeBtn');
        const cancelEditBtn = document.getElementById('cancelEditBtn');
        const changePasswordForm = document.getElementById('changePasswordForm');
        const editProfileForm = document.getElementById('editProfileForm');

        editProfileBtn.addEventListener('click', function () {
            editProfileForm.style.display = 'block';
            changePasswordForm.style.display = 'none';
        });

        changePasswordBtn.addEventListener('click', function () {
            changePasswordForm.style.display = 'block';
            editProfileForm.style.display = 'none';
        });

        cancelChangeBtn.addEventListener('click', function () {
            changePasswordForm.style.display = 'none';
        });

        cancelEditBtn.addEventListener('click', function () {
            editProfileForm.style.display = 'none';
        });
    });
</script>
<script src="/public/ orderDetails.js"></script>
