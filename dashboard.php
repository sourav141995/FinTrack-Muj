<?php
session_start();

// Redirect to login page if user is not logged in
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

// Initialize variables
$name = 'Guest';
$monthly_income = 0;
$current_savings = 0;
$total_expenses = 0;
$financial_goal = 0; // Changed from retirement_savings_goal to financial_goal
$total_debt = 0;
$years_until_retirement = 60; // Default to 60 if retirement age is not set
$age = 0;
$profession = '';

// Retrieve user data
$user_sql = "SELECT full_name, monthly_income, current_savings, loan_amount, financial_goal, goal_timeframe, retirement_age, age, profession FROM users WHERE id = ?";
$stmt = $conn->prepare($user_sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$user_result = $stmt->get_result();

if ($user_result->num_rows > 0) {
    $user_data = $user_result->fetch_assoc();
    $name = $user_data['full_name'];
    $monthly_income = $user_data['monthly_income'];
    $current_savings = $user_data['current_savings'];
    $total_debt = $user_data['loan_amount'];
    $financial_goal = $user_data['financial_goal'];
    $goal_timeframe = $user_data['goal_timeframe'];
    $retirement_age = $user_data['retirement_age'];
    $age = $user_data['age'];
    $profession = $user_data['profession'];
    
    // Calculate years remaining until retirement
    $current_year = (int)date('Y');
    $years_until_retirement = max(0, $retirement_age - ($current_year - $age));
}

// Retrieve total expenses
$expenses_sql = "SELECT SUM(amount) AS total_expenses FROM transactions WHERE user_id = ?";
$stmt = $conn->prepare($expenses_sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$expenses_result = $stmt->get_result();

if ($expenses_result->num_rows > 0) {
    $expenses_data = $expenses_result->fetch_assoc();
    $total_expenses = $expenses_data['total_expenses'];
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
/* Chart Container Styling */
.chart-container {
    background: linear-gradient(145deg, #f3f4f6, #e2e3e5); /* Dual shade background */
    padding: 20px;
    border-radius: 16px; /* Smoother rounded corners */
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2); /* Enhanced shadow for depth */
    margin-bottom: 20px; /* Spacing below the chart container */
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    height: 450px; /* Increased height for better chart visibility */
    position: relative;
    overflow: hidden; /* Ensure no overflow */
}

/* Title Styling */
.chart-container h4 {
    color: #333; /* Dark grey for readability */
    margin-bottom: 20px; /* Spacing between title and chart */
    font-size: 1.8rem; /* Slightly larger font size for emphasis */
    text-align: center; /* Center-align the title */
    position: absolute; /* Absolute positioning for title */
    top: 20px; /* Position from the top */
    left: 50%; /* Center horizontally */
    transform: translateX(-50%); /* Center horizontally */
    font-weight: bold; /* Bold title for prominence */
    text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3); /* Subtle text shadow for depth */
}

/* Canvas Styling */
.chart-container canvas {
    width: 100% !important; /* Ensure canvas fits within the container */
    height: 80% !important; /* Maintain aspect ratio */
    max-width: 400px; /* Optional: Set a max-width for larger screens */
}

/* Responsive Design */
@media (max-width: 768px) {
    .chart-container {
        height: 350px; /* Adjust height for smaller screens */
    }
    
    .chart-container h4 {
        font-size: 1.4rem; /* Adjust font size for smaller screens */
    }
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

<body>

    <iframe src="chatbot.html" style="border:none; position:fixed; bottom:0; right:0; width:300px; height:400px; z-index:1000;"></iframe>
<main>
    <!-- Dashboard Content -->

    <div class="container">
    <h2>Welcome, <?php echo htmlspecialchars($name); ?>!</h2>
    <div class="row">
        <!-- Monthly Income -->
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-header bg-success text-white">
                    <h4>Monthly Income</h4>
                </div>
                <div class="card-body d-flex align-items-center">
                    <i class="fas fa-money-bill-wave fa-2x me-2"></i>
                    <span class="h3 mb-0">₹<?php echo number_format($monthly_income, 2); ?></span>
                </div>
            </div>
        </div>
        <!-- Current Savings -->
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-header bg-info text-white">
                    <h4>Current Savings</h4>
                </div>
                <div class="card-body d-flex align-items-center">
                    <i class="fas fa-piggy-bank fa-2x me-2"></i>
                    <span class="h3 mb-0">₹<?php echo number_format($current_savings, 2); ?></span>
                </div>
            </div>
        </div>
<!-- Expense vs. Income Ratio -->
<div class="col-lg-4 col-md-6 mb-4">
    <div class="card shadow-sm">
        <div class="card-header bg-warning text-dark">
            <h4>Expense vs. Income Ratio</h4>
        </div>
        <div class="card-body d-flex align-items-center">
            <i class="fas fa-chart-pie fa-2x me-2"></i>
            <span class="h3 mb-0">
                <?php 
                    // Calculate the expense to income ratio
                    $expense_to_income_ratio = ($monthly_income > 0) ? ($total_expenses / $monthly_income) * 100 : 0;
                    echo number_format($expense_to_income_ratio, 2) . '%';
                ?>
            </span>
        </div>
    </div>
</div>

     <!-- Years Left for Retirement -->
<div class="col-lg-4 col-md-6 mb-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4>Years Left for Retirement</h4>
        </div>
        <div class="card-body d-flex align-items-center">
            <i class="fas fa-calendar-day fa-2x me-2"></i>
            <span class="h3 mb-0">
                <?php 
                    // Calculate years left for retirement
                    $years_left_for_retirement = max(0, $retirement_age - $age);
                    echo $years_left_for_retirement; 
                ?> 
                years
            </span>
        </div>
    </div>
</div>

        <!-- Total Debt -->
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-header bg-danger text-white">
                    <h4>Total Debt</h4>
                </div>
                <div class="card-body d-flex align-items-center">
                    <i class="fas fa-credit-card fa-2x me-2"></i>
                    <span class="h3 mb-0">₹<?php echo number_format($total_debt, 2); ?></span>
                </div>
            </div>
        </div>
        <!-- Personal Details -->
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-header bg-secondary text-white">
                    <h4>Personal Details</h4>
                </div>
                <div class="card-body d-flex align-items-center">
                    <i class="fas fa-user fa-2x me-2"></i>
                    <span class="h3 mb-0">Age: <?php echo $age; ?>, Profession: <?php echo htmlspecialchars($profession); ?></span>
                </div>
            </div>
        </div>
    </div>
</div>

        <!-- Update Profile Button -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#profileModal" style="margin-left: 10px;">
        Update Profile
    </button>

    <!-- Profile Modal -->
<!-- Profile Modal -->
<div class="modal fade" id="profileModal" tabindex="-1" aria-labelledby="profileModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="profileModalLabel">Update Profile</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Profile Form -->
                <form action="update_profile.php" method="post">
                    <div class="mb-3">
                        <label for="monthly_income" class="form-label">Monthly Income</label>
                        <input type="number" step="0.01" class="form-control" id="monthly_income" name="monthly_income" value="<?php echo htmlspecialchars($monthly_income); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="current_savings" class="form-label">Current Savings</label>
                        <input type="number" step="0.01" class="form-control" id="current_savings" name="current_savings" value="<?php echo htmlspecialchars($current_savings); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="loan_amount" class="form-label">Loan Amount</label>
                        <input type="number" step="0.01" class="form-control" id="loan_amount" name="loan_amount" value="<?php echo htmlspecialchars($loan_amount); ?>">
                    </div>
                    <div class="mb-3">
                        <label for="retirement_age" class="form-label">Retirement Age</label>
                        <input type="number" class="form-control" id="retirement_age" name="retirement_age" value="<?php echo htmlspecialchars($retirement_age); ?>">
                    </div>
                    <div class="mb-3">
                        <label for="age" class="form-label">Age</label>
                        <input type="number" class="form-control" id="age" name="age" value="<?php echo htmlspecialchars($age); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="profession" class="form-label">Profession</label>
                        <input type="text" class="form-control" id="profession" name="profession" value="<?php echo htmlspecialchars($profession); ?>">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">New Password</label>
                        <input type="password" class="form-control" id="password" name="password">
                        <div class="form-text">Leave blank if you do not want to change your password.</div>
                    </div>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </form>
                
                <!-- Delete Account Form -->
                <form action="delete_account.php" method="post" class="mt-4">
                    <div class="alert alert-danger" role="alert">
                        Deleting your account is irreversible. All your data will be lost.
                    </div>
                    <button type="submit" class="btn btn-danger">Delete Account</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<div class="row mt-4">
    <div class="col-md-12">
        <div class="chart-container">
            <h4>Financial Overview</h4>
            <canvas id="incomeChart"></canvas>
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
<!-- Footer -->
<footer style="
    background: linear-gradient(135deg, #004d00 50%, #002600 50%);
    color: #ffffff;
    padding: 20px 0;
    margin-top: 40px;
    font-family: Arial, sans-serif;
">
    <div class="containerf text-center">
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




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
// Chart.js configuration
const incomeCtx = document.getElementById('incomeChart').getContext('2d');
const incomeChart = new Chart(incomeCtx, {
    type: 'pie',
    data: {
        labels: [
            'Monthly Income',
            'Current Savings',
            'Total Expenses',
            'Total Debt'
        ],
        datasets: [{
            label: 'Financial Data',
            data: [
                <?php echo $monthly_income; ?>,
                <?php echo $current_savings; ?>,
                <?php echo $total_expenses; ?>,
                <?php echo $total_debt; ?>
            ],
            backgroundColor: [
                'rgba(54, 162, 235, 0.2)', // Blue for Monthly Income
                'rgba(255, 159, 64, 0.2)', // Orange for Current Savings
                'rgba(75, 192, 192, 0.2)', // Teal for Total Expenses
                'rgba(255, 99, 132, 0.2)'  // Red for Total Debt
            ],
            borderColor: [
                'rgba(54, 162, 235, 1)',
                'rgba(255, 159, 64, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(255, 99, 132, 1)'
            ],
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
                    label: function(tooltipItem) {
                        return tooltipItem.label + ': ₹' + tooltipItem.raw.toLocaleString();
                    }
                }
            }
        }
    }
});
</script>
</body>
</html>
