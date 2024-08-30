<?php
session_start();

// Redirect to login page if user is not logged in
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

// Retrieve user data
$user_sql = "SELECT full_name, monthly_income, current_savings, age, profession FROM users WHERE id = ?";
$stmt = $conn->prepare($user_sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$user_result = $stmt->get_result();

if ($user_result->num_rows > 0) {
    $user_data = $user_result->fetch_assoc();
    $name = $user_data['full_name'];
    $monthly_income = $user_data['monthly_income'];
    $current_savings = $user_data['current_savings'];
    $age = $user_data['age'];
    $profession = $user_data['profession'];
} else {
    $name = 'Guest'; // Fallback if no user data is found
    $monthly_income = 0;
    $current_savings = 0;
    $age = 0;
    $profession = 'Not Specified';
}

// Calculate years remaining until retirement (age 60)
$retirement_age = 60;
$years_until_retirement = max(0, $retirement_age - $age);

// Retrieve total expenses
$expenses_sql = "SELECT SUM(amount) AS total_expenses FROM transactions WHERE user_id = ?";
$stmt = $conn->prepare($expenses_sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$expenses_result = $stmt->get_result();

if ($expenses_result->num_rows > 0) {
    $expenses_data = $expenses_result->fetch_assoc();
    $total_expenses = $expenses_data['total_expenses'];
} else {
    $total_expenses = 0; // Fallback if no expense data is found
}

// Retrieve debt information
$debt_sql = "SELECT SUM(loan_amount) AS total_debt FROM users WHERE id = ?";
$stmt = $conn->prepare($debt_sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$debt_result = $stmt->get_result();

if ($debt_result->num_rows > 0) {
    $debt_data = $debt_result->fetch_assoc();
    $total_debt = $debt_data['total_debt'];
} else {
    $total_debt = 0; // Fallback if no debt data is found
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FinTrack Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
    /* Dashboard Container */
    .container {
        padding-top: 100px;
    }

    /* Welcome Section */
    .container h2 {
        font-size: 2rem;
        color: #003300; /* Darker green for better contrast */
        margin-bottom: 20px;
    }

    .container p {
        font-size: 1.1rem;
        color: #333333; /* Dark grey for text */
        margin-bottom: 10px;
    }

    /* Card Styles */
    .card {
        border: none; /* Remove default border */
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Subtle shadow for depth */
        margin-bottom: 20px;
        background-color: #ffffff; /* White background for contrast */
    }

    .card-body {
        background: #f5f5f5; /* Light grey background for better readability */
        color: #004d00; /* Dark green text color for contrast */
        padding: 20px;
        font-size: 1.2rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .card-body i {
        font-size: 2rem;
        margin-right: 10px;
        color: #007700; /* Brighter green for icons */
    }

    /* Chart Section */
    .chart-container {
        background-color: #ffffff; /* White background for charts */
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    /* Widget Section */
    .card-header {
        background-color: #006600; /* Medium green for headers */
        color: #ffffff; /* White text for contrast */
        padding: 10px;
        border-top-left-radius: 8px;
        border-top-right-radius: 8px;
    }

    .card-header h4 {
        margin: 0;
        font-size: 1.4rem;
    }

    .card-body iframe {
        border-radius: 8px;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .container h2 {
            font-size: 1.5rem;
        }

        .container p {
            font-size: 1rem;
        }

        .card-body {
            font-size: 1rem;
        }

        .card-body i {
            font-size: 1.5rem;
        }

        .card-header h4 {
            font-size: 1.2rem;
        }
    }
</style>


</head>
<body>

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
                <a class="nav-link active" href="dashboard.php" style="
                    color: #fff;
                    transition: color 0.3s, transform 0.3s;
                ">Dashboard</a>
            </li>
            <li class="nav-item" style="margin-left: 1rem;">
                <a class="nav-link" href="goals.php" style="
                    color: #fff;
                    transition: color 0.3s, transform 0.3s;
                ">Goals</a>
            </li>
            <li class="nav-item" style="margin-left: 1rem;">
                <a class="nav-link" href="transactions.php" style="
                    color: #fff;
                    transition: color 0.3s, transform 0.3s;
                ">Transactions</a>
            </li>
            <li class="nav-item" style="margin-left: 1rem;">
                <a class="nav-link" href="reports.php" style="
                    color: #fff;
                    transition: color 0.3s, transform 0.3s;
                ">Reports</a>
            </li>
        </ul>
        <div>
        <!-- Logout Button aligned to the right -->
        <ul class="navbar-nav" style="margin-left: auto;">
            <li class="nav-item">
                <form action="logout.php" method="post" class="d-inline">
                    <button type="submit" class="btn btn-outline-light" style="
                        color: #fff;
                        border-color: #fff;
                        transition: background-color 0.3s, color 0.3s;
                    ">Logout</button>
                </form>
            </li>
        </ul>
        </div>
    </div>
</nav>

<body>

    <iframe src="chatbot.html" style="border:none; position:fixed; bottom:0; right:0; width:300px; height:400px; z-index:1000;"></iframe>
<main>
    <!-- Dashboard Content -->
    <div class="container" style="padding-top: 100px;">
        <!-- Welcome Section -->
        <h2>Welcome, <?php echo htmlspecialchars($name); ?></h2>
        <p>Profession: <?php echo htmlspecialchars($profession); ?></p>
        <p>Age: <?php echo htmlspecialchars($age); ?> years</p>
        <p>Years until Retirement: <?php echo htmlspecialchars($years_until_retirement); ?></p>

        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <i class="fas fa-wallet"></i>
                        Total Savings: $<?php echo number_format($current_savings, 2); ?>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <i class="fas fa-money-bill-wave"></i>
                        Monthly Income: $<?php echo number_format($monthly_income, 2); ?>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <i class="fas fa-chart-line"></i>
                        Total Expenses: $<?php echo number_format($total_expenses, 2); ?>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <i class="fas fa-credit-card"></i>
                        Total Debt: $<?php echo number_format($total_debt, 2); ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-6">
                <!-- Charts Section -->
                <div class="chart-container">
                    <canvas id="expensesChart"></canvas>
                </div>
            </div>
            <div class="col-md-6">
                <div class="chart-container">
                    <canvas id="incomeChart"></canvas>
                </div>
            </div>
        </div>
    </div>

     <!-- Goals Widget -->
     <div class="row mt-4">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h4>Goals</h4>
                    </div>
                    <div class="card-body">
                        <!-- Embed Goals Widget -->
                        <iframe src="goals_widget.php" style="border:none; width:100%; height:300px;"></iframe>
                    </div>
                </div>
            </div>

            <!-- Transactions Widget -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h4>Transactions</h4>
                    </div>
                    <div class="card-body">
                        <!-- Embed Transactions Widget -->
                        <iframe src="transactions_widget.php" style="border:none; width:100%; height:300px;"></iframe>
                    </div>
                </div>
            </div>

            <!-- Reports Widget -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h4>Reports</h4>
                    </div>
                    <div class="card-body">
                        <!-- Embed Reports Widget -->
                        <iframe src="reports_widget.php" style="border:none; width:100%; height:300px;"></iframe>
                    </div>
                </div>
            </div>
        </div>

</main>
  <!-- Footer -->
<footer style="
    background: linear-gradient(135deg, #004d00 50%, #002600 50%); /* Dual-shade background */
    color: #ffffff;
    padding: 10px 0;
    margin-top: 40px;
">
    <div class="container text-center">
        <div style="
            display: flex; 
            justify-content: space-between; 
            align-items: center; 
            flex-wrap: wrap;
        ">
            <!-- About the Project Section -->
            <div style="
                max-width: 400px; 
                margin-bottom: 20px;
            ">
                <h4>About the Project</h4>
                <p style="color: #ffffff;">This project, FinTrack, is developed as part of the final year MCA program at Manipal University Jaipur by Sourav Sharma.</p>
                <p style="color: #ffffff;">Roll Number: 2214505923, Batch 4 MCA</p>
            </div>
            
            <!-- Developer Contact Section with QR Code -->
            <div style="
                text-align: center; 
                margin-bottom: 20px;
            ">
                <h4>Contact the Developer</h4>
                <img src="images/QR_Sourav.png" alt="Developer QR Code" style="
                    width: 120px; 
                    height: 120px;
                ">
            </div>
            
            <!-- University Logo Section -->
            <div style="
                text-align: right; 
                max-width: 400px; 
                margin-bottom: 20px; 
                background-color: #ffffff; /* White background for logo section */
                padding: 10px; 
                border-radius: 8px;
            ">
                <img src="images/Muj Logo.png" alt="Manipal University Jaipur Logo" class="footer-img" style="
                    width: 100%; /* Ensure the logo fits within the div */
                ">
            </div>
        </div>
        
        <!-- Horizontal Divider -->
        <hr style="
            border-top: 1px solid #d4edda;
        ">
        
        <!-- Footer Copyright -->
        <p style="color: #ffffff;">&copy; 2024 FinTrack. All Rights Reserved.</p>
    </div>
</footer>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Chart.js configuration
        const expensesCtx = document.getElementById('expensesChart').getContext('2d');
        new Chart(expensesCtx, {
            type: 'bar',
            data: {
                labels: ['Rent', 'Utilities', 'Groceries', 'Others'],
                datasets: [{
                    label: 'Expenses',
                    data: [<?php echo $total_expenses; ?>],
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        const incomeCtx = document.getElementById('incomeChart').getContext('2d');
        new Chart(incomeCtx, {
            type: 'pie',
            data: {
                labels: ['Monthly Income', 'Current Savings'],
                datasets: [{
                    label: 'Income',
                    data: [<?php echo $monthly_income; ?>, <?php echo $current_savings; ?>],
                    backgroundColor: ['rgba(54, 162, 235, 0.2)', 'rgba(255, 159, 64, 0.2)'],
                    borderColor: ['rgba(54, 162, 235, 1)', 'rgba(255, 159, 64, 1)'],
                    borderWidth: 1
                }]
            }
        });
    </script>
</body>
</html>
