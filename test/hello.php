<?php
session_start(); 


if (!isset($_SESSION['username'])) {
    header('Location: login.php'); 
    exit();
}

// Get the username from the session
$username = htmlspecialchars($_SESSION['username']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
</head>
<body>
    <h1>Hello, <?php echo $username; ?>!</h1>
    <p>Welcome to the member's area.</p>
    <a href="logout.php">Logout</a> <!-- Link to log out -->
</body>
</html>
