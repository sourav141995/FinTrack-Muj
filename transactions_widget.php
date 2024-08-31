<?php
// Include database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fintrack";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Start session and check if user is logged in
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login_signup.php');
    exit();
}
$user_id = $_SESSION['user_id'];

// Retrieve recent transactions
$transactions_sql = "SELECT t.transaction_date, c.category_name, t.amount, t.description 
                     FROM transactions t
                     JOIN categories c ON t.category_id = c.id
                     WHERE t.user_id = ?
                     ORDER BY t.transaction_date DESC
                     LIMIT 5"; // Adjust the limit as needed
$stmt = $conn->prepare($transactions_sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$transactions_result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transactions Widget</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f7fa;
        }
        h3 {
            text-align: center;
            color: #2c3e50;
            font-weight: 600;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }
        th, td {
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #2c3e50;
            color: #fff;
        }
        td {
            border-bottom: 1px solid #ddd;
        }
        td:nth-child(1) {
            color: #34495e;
        }
        td:nth-child(2) {
            color: #16a085;
        }
        td:nth-child(3) {
            color: #e74c3c;
            font-weight: bold;
        }
        tr:hover {
            background-color: #ecf0f1;
        }
        .view-all {
            display: block;
            text-align: center;
            margin-top: 20px;
            font-size: 16px;
            font-weight: 600;
            text-decoration: none;
            color: #3498db;
        }
        .view-all:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <h3>Recent Transactions</h3>
    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Description</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $transactions_result->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars(date("d M Y", strtotime($row['transaction_date']))) ?></td>
                    <td><?= htmlspecialchars($row['description']) ?></td>
                    <td>₹<?= number_format($row['amount'], 2) ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>