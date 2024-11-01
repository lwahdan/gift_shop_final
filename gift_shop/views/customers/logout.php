<?php
// Start the session
session_start();

// Unset all of the session variables
session_unset();

// Destroy the session
session_destroy();

// Redirect to the login page or homepage
header("Location: /customers/login"); // Update this path if needed
exit();
?>
