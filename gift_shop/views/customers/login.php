<?php require 'views/partials/header.php'; ?>

<section class="form-container-login">
    <form action="" method="post">
        <h3>Login </h3>
        <p class="message" style="<?php echo empty($message) ? 'display:none;' : ''; ?>">
            <?php echo htmlspecialchars($message); ?>
        </p>
        
        <input class="input-log" type="email" name="email" placeholder="Enter your email" value="<?php echo htmlspecialchars($email); ?>" required>
       
        <input class="input-log" type="password" name="password" placeholder="Enter your password" required>
        
        <input type="submit" name="submit-btn" class="btn" value="Login">
        <p class="log">Don't have an account? <a href="/customers/register">Register now</a></p>
    </form>
</section>
  
<?php require 'views/partials/footer.php'; ?>