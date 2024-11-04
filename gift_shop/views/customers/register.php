<?php require 'views/partials/header.php'; ?>
<section class="form-container">
    <form action="" method="post" >
        <h3>Register Now</h3>
        <p class="message <?php echo !empty($message) ? 'error-background' : ''; ?>" 
           style="<?php echo isset($result) && $result['m'] === 'success' ? 'color:green;' : ''; ?> <?php echo empty($message) ? 'display:none;' : ''; ?>">
            <?php echo htmlspecialchars($message); ?>
        </p>
        
        
        <div class="es">
        <input type="text" name="username" placeholder="Enter your username" value="<?php echo htmlspecialchars($data['username']); ?>" required>
        <input type="number" name="phone_number" placeholder="Enter your phone number" value="<?php echo htmlspecialchars($data['phone_number']); ?>" required>
        </div>
        
        <input class="email-input" type="email" name="email" placeholder="Enter your email" value="<?php echo htmlspecialchars($data['email']); ?>" required>
        
        <div class="es">
        <div class="password-container">
            <input type="password" name="password" id="password" placeholder="Enter your password"  required>
            <i id="togglePassword" class="fas fa-eye" onclick="togglePassword()"></i>
        </div>
      

        <div class="password-container">
            <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm your password"  required>
            <i id="toggleConfirmPassword" class="fas fa-eye" onclick="toggleConfirmPassword()"></i>
        </div>
</div>

<div class="password-checklist">
            <h3 class="checklist-title">Password should be</h3>
            <ul class="checklist-list">
                <li id="length-check" class="invalid">At least 8 characters long</li>
                <li id="number-check" class="invalid">At least 1 number</li>
                <li id="lowercase-check" class="invalid">At least 1 lowercase letter</li>
                <li id="uppercase-check" class="invalid">At least 1 uppercase letter</li>
                <li id="special-check" class="invalid">At least 1 special character</li>
            </ul>
        </div>
<div class="es">
        <input type="text" name="first_name" placeholder="Enter your first name" value="<?php echo htmlspecialchars($data['first_name']); ?>" required> 
        <input type="text" name="last_name" placeholder="Enter your last name" value="<?php echo htmlspecialchars($data['last_name']); ?>" required>
</div>
        <div class="es">
        <input type="text" name="address" placeholder="Enter your address" value="<?php echo htmlspecialchars($data['address']); ?>" required>
        <input type="text" name="postal_code" placeholder="Enter your postal code" value="<?php echo htmlspecialchars($data['postal_code']); ?>" required>
    </div>
<div class="es">
        <input type="text" name="city" placeholder="Enter your city" value="<?php echo htmlspecialchars($data['city']); ?>" required>
        <input type="text" name="country" placeholder="Enter your country" value="<?php echo htmlspecialchars($data['country']); ?>" required>
</div>
        

        <input type="submit" name="submit-btn" class="btn1 reg" value="Register Now">
        <p class="log">Already have an account? <a href="/customers/login">Login now</a></p>
    </form>
</section>
















<?php require 'views/partials/footer.php'; ?>
