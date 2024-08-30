<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login_signup.php');
    exit();
}

$user_id = $_SESSION['user_id'];

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fintrack";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch latest report data for the user
$report_sql = "SELECT report_data FROM reports WHERE user_id = ? ORDER BY created_at DESC LIMIT 1";
$report_stmt = $conn->prepare($report_sql);
$report_stmt->bind_param("i", $user_id);
$report_stmt->execute();
$report_result = $report_stmt->get_result();

if ($report_result->num_rows > 0) {
    $report = $report_result->fetch_assoc();
    $report_data = json_decode($report['report_data'], true);
} else {
    $report_data = [];
}

$report_stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports Widget</title>
    <style>
        .report {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 10px;
            margin-bottom: 10px;
            background-color: #f9f9f9;
        }
        .report-title {
            font-weight: bold;
        }
        .chart-container {
            height: 200px;
        }
    </style>
</head>
<body>
    <div class="report">
        <div class="report-title">Monthly Expense Report</div>
        <div class="chart-container">
            <canvas id="expenseChart"></canvas>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('expenseChart').getContext('2d');
        const reportData = <?php echo json_encode($report_data); ?>;
        const labels = Object.keys(reportData);
        const data = Object.values(reportData);

        const expenseChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Expenses',
                    data: data,
                    backgroundColor: ['#ff6384', '#36a2eb', '#cc65fe', '#ffce56']
                }]
            }
        });
    </script>
</body>
</html>
