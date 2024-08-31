<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login_signup.php');
    exit();
}

$user_id = $_SESSION['user_id'];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fintrack";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Delete user record
$sql = "DELETE FROM users WHERE user_id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);

if ($stmt->execute()) {
    // Destroy the session and redirect to login page
    session_destroy();
    header('Location: login_signup.php');
} else {
    echo "Error deleting account: " . $conn->error;
}

$stmt->close();
$conn->close();
?>
