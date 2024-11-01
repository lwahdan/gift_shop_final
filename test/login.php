<?php
session_start(); // Start the session to use session variables
include_once 'User.php';

$message = ''; // Initialize message variable
$email = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $user = new User();
    $result = $user->login($email, $password);

    if ($result['m'] === 'success') {
        // On successful login, redirect to hello.php
        header('Location: hello.php');
        exit();
    } else {
        // If login fails, set the message to display
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
    <title>Login Page</title>
</head>
<body>
<section class="form-container-login">
    <form action="" method="post">
        <h3>Login Now</h3>
        <p class="message" style=" <?php echo empty($message) ? 'display:none;' : ''; ?>">
            <?php echo htmlspecialchars($message); ?>
        </p>
        <input class="input-log" type="email" name="email" placeholder="Enter your email" value="<?php echo htmlspecialchars($email); ?>" required>
        <input class="input-log" type="password" name="password" placeholder="Enter your password" required>
        <input type="submit" name="submit-btn" class="btn" value="Login Now">
       

        <p class="log">Do not have an account? <a href="register.php">Register now</a></p>
    </form>
</section>
</body>
</html>
