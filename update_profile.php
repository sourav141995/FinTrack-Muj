<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login_signup.php');
    exit();
}

$user_id = $_SESSION['user_id'];

// Define all variables with default empty values
$monthly_income = isset($_POST['monthly_income']) ? $_POST['monthly_income'] : '';
$current_savings = isset($_POST['current_savings']) ? $_POST['current_savings'] : '';
$loan_amount = isset($_POST['loan_amount']) ? $_POST['loan_amount'] : '';
$retirement_age = isset($_POST['retirement_age']) ? $_POST['retirement_age'] : '';
$age = isset($_POST['age']) ? $_POST['age'] : '';
$profession = isset($_POST['profession']) ? $_POST['profession'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fintrack";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare the SQL statement
$sql = "UPDATE users SET monthly_income=?, current_savings=?, loan_amount=?, retirement_age=?, age=?, profession=?";

if (!empty($password)) {
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $sql .= ", password=?";
}

$sql .= " WHERE id=?";
$stmt = $conn->prepare($sql);

$types = "dddiis";
$params = [$monthly_income, $current_savings, $loan_amount, $retirement_age, $age, $profession];

if (!empty($password)) {
    $types .= "s";
    $params[] = $hashed_password;
}

$types .= "i";
$params[] = $user_id;

$stmt->bind_param($types, ...$params);

if ($stmt->execute()) {
    header('Location: dashboard.php');
} else {
    echo "Error updating profile: " . $conn->error;
}

$stmt->close();
$conn->close();
?>
