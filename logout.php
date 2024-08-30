<?php
session_start();

// Clear the session data and destroy the session
session_unset();
session_destroy();

// Redirect to the login page
header('Location: login_signup.php');
exit();
?>