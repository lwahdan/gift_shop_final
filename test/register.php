<?php
session_start(); // Start the session
include_once 'User.php';

$message = ''; // Initialize message variable
$username = '';
$email = '';
$first_name = '';
$last_name = '';
$phone_number = '';
$address = '';
$password = '';
$confirm_password = '';
$postal_code = '';
$country = '';
$city = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form input values
    $username = $_POST['username'] ?? '';
    $email = $_POST['email'] ?? '';
    $first_name = $_POST['first_name'] ?? '';
    $last_name = $_POST['last_name'] ?? '';
    $phone_number = $_POST['phone_number'] ?? '';
    $address = $_POST['address'] ?? '';
    $password = trim($_POST['password'] ?? ''); // Trim password
    $confirm_password = trim($_POST['confirm_password'] ?? ''); // Trim confirm password
    $city = $_POST['city'] ?? '';
    $country = $_POST['country'] ?? '';
    $postal_code = $_POST['postal_code'] ?? '';

    // Create User object and call register method
    $user = new User();
    $result = $user->register(
        $username, $email, $password, $confirm_password,
        $first_name, $last_name, $phone_number, $address,
        $city, $country, $postal_code
    );

    // Check if registration was successful
    if ($result['m'] === 'success') {
        // Store username in session and redirect
        $_SESSION['username'] = $username; 
        header('Location: hello.php');
        exit();
    } else {
        // If registration fails, set message to display
        $message = $result['message'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>User Registration Page</title>
   
</head>
<body>
<section class="form-container">
    <form action="" method="post" >
        <h3>Register Now</h3>
        <p class="message <?php echo !empty($message) ? 'error-background' : ''; ?>" 
           style="<?php echo isset($result) && $result['m'] === 'success' ? 'color:green;' : ''; ?> <?php echo empty($message) ? 'display:none;' : ''; ?>">
            <?php echo htmlspecialchars($message); ?>
        </p>
        
        <div class="es">
        <input type="text" name="username" placeholder="Enter your username" value="<?php echo htmlspecialchars($username); ?>" required>
        <input type="number" name="phone_number" placeholder="Enter your phone number" value="<?php echo htmlspecialchars($phone_number); ?>" required>
        </div>
        
        <input class="email-input" type="email" name="email" placeholder="Enter your email" value="<?php echo htmlspecialchars($email); ?>" required>
        
        <div class="es">
        <div class="password-container">
            <input type="password" name="password" id="password" placeholder="Enter your password" value="<?php echo htmlspecialchars($password); ?>" required>
            <i id="togglePassword" class="fas fa-eye" onclick="togglePassword()"></i>
        </div>
      

        <div class="password-container">
            <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm your password" value="<?php echo htmlspecialchars($confirm_password); ?>" required>
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
        <input type="text" name="first_name" placeholder="Enter your first name" value="<?php echo htmlspecialchars($first_name); ?>" required> 
        <input type="text" name="last_name" placeholder="Enter your last name" value="<?php echo htmlspecialchars($last_name); ?>" required>
</div>
        <div class="es">
        <input type="text" name="address" placeholder="Enter your address" value="<?php echo htmlspecialchars($address); ?>" required>
        <input type="text" name="postal_code" placeholder="Enter your postal code" value="<?php echo htmlspecialchars($postal_code); ?>" required>
    </div>
<div class="es">
        <input type="text" name="city" placeholder="Enter your city" value="<?php echo htmlspecialchars($city); ?>" required>
        <input type="text" name="country" placeholder="Enter your country" value="<?php echo htmlspecialchars($country); ?>" required>
</div>
        

        <input type="submit" name="submit-btn" class="btn reg" value="Register Now">
        <p class="log">Already have an account? <a href="login.php" >Login now</a></p>
    </form>
</section>

<!-- JavaScript to toggle password visibility and handle checklist -->
<script>
function togglePassword() {
    var passwordInput = document.getElementById("password");
    var toggleIcon = document.getElementById("togglePassword");
    if (passwordInput.type === "password") {
        passwordInput.type = "text";
        toggleIcon.classList.remove("fa-eye");
        toggleIcon.classList.add("fa-eye-slash");
    } else {
        passwordInput.type = "password";
        toggleIcon.classList.remove("fa-eye-slash");
        toggleIcon.classList.add("fa-eye");
    }
}

function toggleConfirmPassword() {
    var confirmPasswordInput = document.getElementById("confirm_password");
    var toggleIcon = document.getElementById("toggleConfirmPassword");
    if (confirmPasswordInput.type === "password") {
        confirmPasswordInput.type = "text";
        toggleIcon.classList.remove("fa-eye");
        toggleIcon.classList.add("fa-eye-slash");
    } else {
        confirmPasswordInput.type = "password";
        toggleIcon.classList.remove("fa-eye-slash");
        toggleIcon.classList.add("fa-eye");
    }
}

document.getElementById('password').addEventListener('input', function() {
    const password = this.value;
    const checklist = document.querySelector('.password-checklist');
    const form = document.querySelector('.form-container form');
    
    checklist.style.display = 'block'; // Show checklist on input
    form.style.height = '600px'; // Increase form height when checklist is visible

    const lengthCheck = document.getElementById('length-check');
    const numberCheck = document.getElementById('number-check');
    const lowercaseCheck = document.getElementById('lowercase-check');
    const uppercaseCheck = document.getElementById('uppercase-check');
    const specialCheck = document.getElementById('special-check');

    // Check password length
    lengthCheck.classList.toggle('valid', password.length >= 8);
    lengthCheck.classList.toggle('invalid', password.length < 8);

    // Check for at least 1 number
    numberCheck.classList.toggle('valid', /[0-9]/.test(password));
    numberCheck.classList.toggle('invalid', !/[0-9]/.test(password));

    // Check for at least 1 lowercase letter
    lowercaseCheck.classList.toggle('valid', /[a-z]/.test(password));
    lowercaseCheck.classList.toggle('invalid', !/[a-z]/.test(password));

    // Check for at least 1 uppercase letter
    uppercaseCheck.classList.toggle('valid', /[A-Z]/.test(password));
    uppercaseCheck.classList.toggle('invalid', !/[A-Z]/.test(password));

    // Check for at least 1 special character
    specialCheck.classList.toggle('valid', /[!@#$%^&*(),.?":{}|<>]/.test(password));
    specialCheck.classList.toggle('invalid', !/[!@#$%^&*(),.?":{}|<>]/.test(password));
});

// Hide checklist when the password input loses focus
document.getElementById('password').addEventListener('blur', function() {
    const checklist = document.querySelector('.password-checklist');
    const form = document.querySelector('.form-container form');
    
    setTimeout(() => {
        checklist.style.display = 'none'; // Hide checklist after a small delay
        form.style.height = '500px'; // Reset form height when checklist is hidden
    }, 100);
});

// Hide checklist when clicking outside of the password input and checklist
document.addEventListener("click", function(event) {
    const passwordInput = document.getElementById("password");
    const checklist = document.querySelector('.password-checklist');
    const form = document.querySelector('.form-container form');
    
    if (!passwordInput.contains(event.target) && !checklist.contains(event.target)) {
        checklist.style.display = 'none'; // Hide checklist if click is outside
        form.style.height = '500px'; // Reset form height when checklist is hidden
    }
});

</script>

</body>
</html>
