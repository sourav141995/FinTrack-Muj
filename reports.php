<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login_signup.php');
    exit();
}
$current_page = basename($_SERVER['PHP_SELF']);

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

// Fetch user data
$user_sql = "SELECT age, monthly_income, retirement_age FROM users WHERE id = ?";
$user_stmt = $conn->prepare($user_sql);
$user_stmt->bind_param("i", $user_id);
$user_stmt->execute();
$user_result = $user_stmt->get_result();
$user_data = $user_result->fetch_assoc();

if (!$user_data) {
    die("User data not found.");
}

$age = $user_data['age'];
$monthly_income = $user_data['monthly_income'];
$retirement_age = $user_data['retirement_age'];
$years_until_retirement = $retirement_age - $age;
$average_savings_percentage = 0.50; // 50% of monthly income
$average_retirement_fund = $years_until_retirement * 12 * $monthly_income * $average_savings_percentage;

// Example Goals
$goals = [
    'Retirement Fund Projection' => $average_retirement_fund,
    'Years Until Retirement' => $years_until_retirement,
    'Monthly Savings Required for $100,000 Goal' => max(0, (100000 - $average_retirement_fund) / ($years_until_retirement * 12)),
    'Projected Savings Growth (5% annually)' => $average_retirement_fund * pow(1 + 0.05, $years_until_retirement),
    'Debt Repayment Plan (Assuming $20,000 Debt at 7% interest over 10 years)' => 20000 * 0.1 / 12 // Simple calculation for demo
];

// Handle report generation
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['report_type'])) {
    $report_type = $_POST['report_type'];
    $report_name = ucfirst($report_type) . ' Report';
    $report_data = json_encode($goals); // Include predictive data

    $stmt = $conn->prepare("INSERT INTO reports (user_id, report_name, report_data) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $user_id, $report_name, $report_data);
    $stmt->execute();
    $stmt->close();
}

// Fetch user reports
$reports_sql = "SELECT * FROM reports WHERE user_id = ?";
$reports_stmt = $conn->prepare($reports_sql);
$reports_stmt->bind_param("i", $user_id);
$reports_stmt->execute();
$reports_result = $reports_stmt->get_result();

// Handle report viewing
if (isset($_GET['id'])) {
    $report_id = intval($_GET['id']);
    $report_sql = "SELECT * FROM reports WHERE id = ? AND user_id = ?";
    $report_stmt = $conn->prepare($report_sql);
    $report_stmt->bind_param("ii", $report_id, $user_id);
    $report_stmt->execute();
    $report_result = $report_stmt->get_result();

    if ($report_result->num_rows === 0) {
        echo "Report not found or access denied.";
        exit();
    }

    $report = $report_result->fetch_assoc();
    $report_data = json_decode($report['report_data'], true);
    $report_stmt->close();
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports - FinTrack</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>

/* Main container styling */
.containerr {
    background-color: #f9f9f9;
    padding: 50px;
    border-radius: 8px;
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
    margin-top: 80px; /* Adjust based on the fixed navbar */
}

/* Heading styles */
h1, h2 {
    color: #004d00;
    text-shadow: 1px 1px 2px #cccccc;
}

/* Card styles for report display */
.card {
    margin-bottom: 20px;
    border: none;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.card-title {
    color: #004d00;
}

/* Button styles */
.btn-custom {
    background-color: #004d00;
    color: #ffffff;
    border-radius: 5px;
    transition: background-color 0.3s ease-in-out;
}

.btn-custom:hover {
    background-color: #002600;
}

.btn-primary {
    background-color: #004d00;
    border-color: #004d00;
}

.btn-primary:hover {
    background-color: #003300;
    border-color: #003300;
}

/* Table styling */
.table {
    background-color: #ffffff;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
}

thead th {
    background-color: #004d00;
    color: #ffffff;
}

tbody tr:hover {
    background-color: #f2f2f2;
}

/* Chart canvas styling */
#reportChart {
    margin-top: 20px;
    max-height: 400px;
}

    .card-body {
        padding: 20px;
        background-color: #f9f9f9;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .report-data {
        margin-bottom: 20px;
    }

    .list-group-item {
        border: 1px solid #ddd;
        border-radius: 4px;
        margin-bottom: 5px;
    }

    .chart-container {
        position: relative;
        height: 400px;
        width: 100%;
    }
</style>
</head>
<body>
<!-- Navigation Bar -->
<!-- Navbar -->
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark" style="
    background: linear-gradient(135deg, #004d00 50%, #002600 50%); /* Dual-shade background */
    padding: 1rem;
    margin-bottom: 20px;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    z-index: 1000;
">
    <!-- Navbar Brand -->
    <a class="navbar-brand" href="index.php" style="
        font-size: 1.5rem;
        color: #fff;
        display: flex;
        align-items: center;
    ">
        <img src="images/FinTrack.png" alt="FinTrack Logo" style="
            width: 40px;
            margin-right: 10px;
        "> 
        FinTrack
    </a>
    
    <!-- Navbar Toggler -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    
    <!-- Navbar Links -->
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mx-auto" style="
            display: flex;
            align-items: center;
            justify-content: center; /* Center align the nav items */
            flex-grow: 1; /* Allow navbar items to grow */
        ">
            <li class="nav-item" style="margin-left: 1rem;">
                <a class="nav-link <?php echo ($current_page == 'dashboard.php') ? 'active' : ''; ?>" href="dashboard.php" style="
                    color: #fff;
                    transition: color 0.3s, transform 0.3s;
                    padding: 10px 15px;
                    border-radius: 20px;
                    box-shadow: <?php echo ($current_page == 'dashboard.php') ? '0px 4px 15px rgba(0, 255, 0, 0.6)' : 'none'; ?>;
                    background-color: <?php echo ($current_page == 'dashboard.php') ? 'rgba(0, 255, 0, 0.2)' : 'transparent'; ?>;
                    font-weight: <?php echo ($current_page == 'dashboard.php') ? 'bold' : 'normal'; ?>;
                " onmouseover="this.style.color='#00ff00';" onmouseout="this.style.color='#fff';">
                    Dashboard
                </a>
            </li>
            <li class="nav-item" style="margin-left: 1rem;">
                <a class="nav-link <?php echo ($current_page == 'goals.php') ? 'active' : ''; ?>" href="goals.php" style="
                    color: #fff;
                    transition: color 0.3s, transform 0.3s;
                    padding: 10px 15px;
                    border-radius: 20px;
                    box-shadow: <?php echo ($current_page == 'goals.php') ? '0px 4px 15px rgba(0, 255, 0, 0.6)' : 'none'; ?>;
                    background-color: <?php echo ($current_page == 'goals.php') ? 'rgba(0, 255, 0, 0.2)' : 'transparent'; ?>;
                    font-weight: <?php echo ($current_page == 'goals.php') ? 'bold' : 'normal'; ?>;
                " onmouseover="this.style.color='#00ff00';" onmouseout="this.style.color='#fff';">
                    Goals
                </a>
            </li>
            <li class="nav-item" style="margin-left: 1rem;">
                <a class="nav-link <?php echo ($current_page == 'transactions.php') ? 'active' : ''; ?>" href="transactions.php" style="
                    color: #fff;
                    transition: color 0.3s, transform 0.3s;
                    padding: 10px 15px;
                    border-radius: 20px;
                    box-shadow: <?php echo ($current_page == 'transactions.php') ? '0px 4px 15px rgba(0, 255, 0, 0.6)' : 'none'; ?>;
                    background-color: <?php echo ($current_page == 'transactions.php') ? 'rgba(0, 255, 0, 0.2)' : 'transparent'; ?>;
                    font-weight: <?php echo ($current_page == 'transactions.php') ? 'bold' : 'normal'; ?>;
                " onmouseover="this.style.color='#00ff00';" onmouseout="this.style.color='#fff';">
                    Transactions
                </a>
            </li>
            <li class="nav-item" style="margin-left: 1rem;">
                <a class="nav-link <?php echo ($current_page == 'reports.php') ? 'active' : ''; ?>" href="reports.php" style="
                    color: #fff;
                    transition: color 0.3s, transform 0.3s;
                    padding: 10px 15px;
                    border-radius: 20px;
                    box-shadow: <?php echo ($current_page == 'reports.php') ? '0px 4px 15px rgba(0, 255, 0, 0.6)' : 'none'; ?>;
                    background-color: <?php echo ($current_page == 'reports.php') ? 'rgba(0, 255, 0, 0.2)' : 'transparent'; ?>;
                    font-weight: <?php echo ($current_page == 'reports.php') ? 'bold' : 'normal'; ?>;
                " onmouseover="this.style.color='#00ff00';" onmouseout="this.style.color='#fff';">
                    Reports
                </a>
            </li>
        </ul>
        
        <!-- Logout Button aligned to the right -->
        <div>
            <ul class="navbar-nav" style="margin-left: auto;">
                <li class="nav-item">
                    <form action="logout.php" method="post" class="d-inline">
                        <button type="submit" class="btn btn-outline-light" style="
                            color: #fff;
                            border-color: #fff;
                            transition: background-color 0.3s, color 0.3s;
                        " onmouseover="this.style.backgroundColor='#00ff00'; this.style.color='#004d00';" onmouseout="this.style.backgroundColor='transparent'; this.style.color='#fff';">
                            Logout
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>


<main>
    <iframe src="chatbot.html" style="border:none; position:fixed; bottom:0; right:0; width:300px; height:400px; z-index:1000;"></iframe>

    <div style="font-family: Arial, sans-serif; margin: 20px; color: #333;">

<h1 style="color: #4CAF50;">Reports Page Guide</h1>

<div style="border: 1px solid #ddd; border-radius: 8px; padding: 15px; background-color: #f9f9f9;">
<div style="
        border: 2px solid #4CAF50; 
        border-radius: 10px; 
        padding: 20px; 
        background-color: #ffffff; 
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); 
        max-width: 600px; 
        margin: auto;">
        
        <h2 style="
            color: #4CAF50; 
            font-size: 22px; 
            border-bottom: 2px solid #4CAF50; 
            padding-bottom: 5px;">
            Generate a Report
        </h2>
        <p style="font-size: 16px; line-height: 1.6;">
            Choose the type of report (Monthly, Yearly, or Predictive) and click "Generate Report" to create it.
        </p>

        <h2 style="
            color: #4CAF50; 
            font-size: 22px; 
            border-bottom: 2px solid #4CAF50; 
            padding-bottom: 5px;">
            View Existing Reports
        </h2>
        <p style="font-size: 16px; line-height: 1.6;">
            Check the "My Reports" table to view your reports. Click "View" to access details and charts.
        </p>

        <h2 style="
            color: #4CAF50; 
            font-size: 22px; 
            border-bottom: 2px solid #4CAF50; 
            padding-bottom: 5px;">
            Report Details
        </h2>
        <p style="font-size: 16px; line-height: 1.6;">
            Review the report’s name, creation date, data details, and charts after selection.
        </p>

        <h2 style="
            color: #4CAF50; 
            font-size: 18px;">
            Tips
        </h2>
        <ul style="
            list-style-type: disc; 
            margin-left: 20px; 
            font-size: 16px; 
            line-height: 1.6;">
            <li>Generate reports regularly to stay updated.</li>
            <li>Utilize charts for clear visual insights.</li>
            <li>Effectively manage your saved reports.</li>
        </ul>
    </div>

    </div>

    <div class="containerr mt-5">
        <h1 class="mb-4">Reports</h1>
        <?php if (isset($_GET['id'])): ?>
            <div class="card">
            <div class="card-body">
    <h2 class="card-title"><?php echo htmlspecialchars($report['report_name']); ?></h2>
    <p><strong>Created At:</strong> <?php echo htmlspecialchars($report['created_at']); ?></p>

    <!-- Report Data Section -->
    <h4>Report Data:</h4>
    <div class="report-data">
        <ul class="list-group">
            <?php foreach ($report_data as $key => $value): ?>
                <li class="list-group-item">
                    <strong><?php echo htmlspecialchars($key); ?>:</strong> <?php echo htmlspecialchars($value); ?>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>

    <!-- Chart Visualization Section -->
    <h4>Chart Visualization:</h4>
    <div class="chart-container">
        <canvas id="reportChart"></canvas>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var ctx = document.getElementById('reportChart').getContext('2d');
            var reportData = <?php echo json_encode($report_data); ?>;

            new Chart(ctx, {
                type: 'bar', // You can change the chart type here (e.g., 'line', 'pie', etc.)
                data: {
                    labels: Object.keys(reportData),
                    datasets: [{
                        label: '<?php echo htmlspecialchars($report['report_name']); ?>',
                        data: Object.values(reportData),
                        backgroundColor: 'rgba(54, 162, 235, 0.5)', // Light blue background
                        borderColor: 'rgba(54, 162, 235, 1)', // Dark blue border
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    var label = context.dataset.label || '';
                                    if (label) {
                                        label += ': ';
                                    }
                                    if (context.parsed.y !== null) {
                                        label += new Intl.NumberFormat().format(context.parsed.y);
                                    }
                                    return label;
                                }
                            }
                        }
                    },
                    scales: {
                        x: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Categories'
                            }
                        },
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Values'
                            }
                        }
                    }
                }
            });
        });
    </script>
</div>
            </div>
            <a href="reports.php" class="btn btn-secondary mt-3">Back to Reports</a>
        <?php else: ?>
            <form method="post" class="mb-4">
                <div class="form-group">
                    <label for="report_type">Select Report Type:</label>
                    <select id="report_type" name="report_type" class="form-control">
                        <option value="monthly">Monthly Report</option>
                        <option value="yearly">Yearly Report</option>
                        <option value="predictive">Predictive Report</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-custom mt-3">Generate Report</button>
            </form>

            <h2>My Reports</h2>
            <?php if ($reports_result->num_rows > 0): ?>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Report Name</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($report = $reports_result->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($report['report_name']); ?></td>
                                <td><?php echo htmlspecialchars($report['created_at']); ?></td>
                                <td>
                                    <a href="reports.php?id=<?php echo $report['id']; ?>" class="btn btn-primary">View</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>No reports available.</p>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</main>

<!-- Footer -->
<!-- Footer -->
<footer style="
    background: linear-gradient(135deg, #004d00 50%, #002600 50%);
    color: #ffffff;
    padding: 20px 0;
    margin-top: 40px;
    font-family: Arial, sans-serif;
">
    <div class="container text-center">
        <div style="
            display: flex; 
            justify-content: space-between; 
            align-items: center; 
            flex-wrap: wrap;
            max-width: 1200px; 
            margin: 0 auto;
        ">
            <!-- About the Project Section -->
            <div style="
                max-width: 400px; 
                margin-bottom: 20px;
                text-align: left;
            ">
                <h4 style="
                    margin-bottom: 10px;
                    font-size: 1.2em;
                    color: #d4edda;
                ">About the Project</h4>
                <p style="
                    color: #ffffff;
                    margin-bottom: 5px;
                ">This project, FinTrack, is developed as part of the final year MCA program at Manipal University Jaipur by Sourav Sharma.</p>
                <p style="
                    color: #ffffff;
                ">Roll Number: 2214505923, Batch 4 MCA</p>
            </div>
            
            <!-- Developer Contact Section with QR Code -->
            <div style="
                text-align: center; 
                margin-bottom: 20px;
            ">
                <h4 style="
                    margin-bottom: 10px;
                    font-size: 1.2em;
                    color: #d4edda;
                ">Contact the Developer</h4>
                <img src="images/QR_Sourav.png" alt="Developer QR Code" style="
                    width: 120px; 
                    height: 120px;
                    border-radius: 10px;
                ">
            </div>
            
            <!-- University Logo Section -->
            <div style="
                text-align: right; 
                max-width: 400px; 
                margin-bottom: 20px; 
                background-color: #ffffff; 
                padding: 10px; 
                border-radius: 8px;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            ">
                <img src="images/Muj Logo.png" alt="Manipal University Jaipur Logo" class="footer-img" style="
                    width: 100%; 
                    max-width: 200px; /* Ensure the logo doesn't get too large */
                    border-radius: 5px;
                ">
            </div>
        </div>
        
        <!-- Horizontal Divider -->
        <hr style="
            border-top: 1px solid #d4edda;
            margin: 20px auto;
            max-width: 800px;
        ">
        
        <!-- Footer Links -->
        <div style="
            display: flex; 
            justify-content: center; 
            flex-wrap: wrap;
            gap: 20px;
            margin-bottom: 20px;
        ">
            <a href="help_support.php" style="
                color: #ffffff; 
                text-decoration: none; 
                font-size: 1em; 
                padding: 5px 10px;
                border-radius: 5px;
                transition: background-color 0.3s ease;
            ">Help Center</a>
            <a href="about_us.php" style="
                color: #ffffff; 
                text-decoration: none; 
                font-size: 1em; 
                padding: 5px 10px;
                border-radius: 5px;
                transition: background-color 0.3s ease;
            ">About Us</a>
            <a href="privacy_policy.php" style="
                color: #ffffff; 
                text-decoration: none; 
                font-size: 1em; 
                padding: 5px 10px;
                border-radius: 5px;
                transition: background-color 0.3s ease;
            ">Privacy Policy</a>
        </div>
        
        <!-- Footer Copyright -->
        <p style="
            color: #ffffff;
            font-size: 0.9em;
        ">&copy; 2024 FinTrack. All Rights Reserved.</p>
    </div>
</footer>


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>