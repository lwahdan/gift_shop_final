<?php require 'views/partials/header.php'; ?>


<!-- ...:::: Start Breadcrumb Section:::... -->
    <div class="breadcrumb-section breadcrumb-bg-color--golden">
        <div class="breadcrumb-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h3 class="breadcrumb-title">Login</h3>
                        <div class="breadcrumb-nav breadcrumb-nav-color--black breadcrumb-nav-hover-color--golden">
                            <nav aria-label="breadcrumb">
                                <ul>
                                    <li><a href="index.php">Home</a></li>
                                    <li><a href="shop-grid-sidebar-left.html">Shop</a></li>
                                    <li class="active" aria-current="page">Login</li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- ...:::: End Breadcrumb Section:::... -->
<!-- reemlogin -->

   <section class="form-container-login">
    <form action="" method="post">
        <h3>Login Now</h3>
        <!-- <p class="message" style=" <?php echo empty($message) ? 'display:none;' : ''; ?>">
            <?php echo htmlspecialchars($message); ?>
        </p> -->
        <input class="input-log" type="email" name="email" placeholder="Enter your email" value="<?php echo htmlspecialchars($email); ?>" required>
        <input class="input-log" type="password" name="password" placeholder="Enter your password" required>
        <input type="submit" name="submit-btn" class="btn" value="Login Now">
       

        <!-- <p class="log">Do not have an account? <a href="register.php">Register now</a></p> -->
    </form>
</section>

<?php require 'views/partials/footer.php'; ?>