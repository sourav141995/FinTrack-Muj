<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FinTrack Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        /* Global Styles */
        /* Internal CSS for Dashboard page */
        
        /* Navigation Bar Design Start */
        .navbar {
            background-color: #004d40; /* Dark green background */
            padding: 1rem; /* Match padding */
            transition: background-color 0.3s;
            margin-bottom: 20px; /* Space below navbar */
            position: fixed; /* Fixes navbar to the top */
            top: 0; /* Aligns navbar to the top of the page */
            left: 0; /* Aligns navbar to the left edge */
            width: 100%; /* Full width */
            z-index: 1000; /* Ensures navbar is above other content */
        }


        .navbar-brand {
            font-size: 1.5rem; /* Match font size */
            color: #fff;
            display: flex;
            align-items: center;
        }

        .navbar-brand img {
            width: 40px; /* Match logo size */
            margin-right: 10px;
        }

        .navbar a {
            color: #fff;
            margin-left: 1rem; /* Spacing between links */
            transition: color 0.3s;
        }

        .navbar .form-inline {
            display: flex;
            justify-content: center;
            flex-grow: 1;
        }

        .navbar .form-inline .form-control {
            width: 250px; /* Adjust width to match other pages */
            transition: width 0.3s ease-in-out;
        }

        .navbar .form-inline .form-control:focus {
            width: 300px; /* Expanded width on focus */
        }

        .navbar .btn-outline-light {
            color: #fff;
            border-color: #fff;
        }

        .navbar .btn-outline-light:hover {
            color: #004d40;
            background-color: #aed581;
            border-color: #aed581;
        }

        /* Navigation Bar Link Styles */
        .navbar-nav .nav-link {
            color: lightslategray; /* Off-white color for non-active links */
            margin-left: 1rem; /* Spacing between nav links */
            transition: color 0.3s;
        }

        .navbar-nav .nav-link:hover,
        .navbar-nav .nav-link.active {
            color: #ffffff; /* White color for active or hovered links */
        }
        /* Navigation Bar Design End */

        /* Button Styles */
        .btn-primary {
            background-color: #27ae60; /* Green color for primary buttons */
            border-color: #27ae60;
        }

        .btn-primary:hover {
            background-color: #2ecc71;
            border-color: #2ecc71;
        }

        .btn-secondary {
            background-color: #ecf0f1; /* Light color for secondary buttons */
            border-color: #bdc3c7;
        }

        .btn-secondary:hover {
            background-color: #bdc3c7;
            border-color: #aab7b8;
        }

        /* Table Styles */
        .table {
            background-color: #fff; /* White background for table */
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: #f9f9f9; /* Light grey for striped rows */
        }

        /* Footer Design Start */
        footer {
            background-color: #004d40;
            color: #fff;
            padding: 1rem; /* Match padding with navbar */
            text-align: center;
            margin-top: 2rem;
        }

        .footer-links a {
            color: #aed581;
            margin: 0 0.5rem;
            text-decoration: none;
        }

        .footer-links a:hover {
            text-decoration: underline;
        }
        /* Footer Design End */

        /* Additional Styles */
        .logo {
            max-width: 150px; /* Adjust the width as needed */
            height: auto;     /* Maintain aspect ratio */
        }

        .table th, .table td {
            text-align: center; /* Center-align text in table cells */
        }

        .card {
            border: 1px solid #ddd;
            border-radius: 8px;
        }

        .card-title {
            font-size: 1.25rem;
            margin-bottom: 1rem;
        }

        .btn-custom {
            background-color: #28a745;
            color: #ffffff;
        }

        .btn-custom:hover {
            background-color: #218838;
            color: #ffffff;
        }

        .form-control {
            border-radius: 0.25rem;
        }
        
        /* Status Bar */
        .status-bar {
            display: flex;
            align-items: center;
            padding: 1rem;
            background-color: #f8f9fa;
            border-bottom: 1px solid #dee2e6;
            margin-top: 80px; /* Adjust for fixed navbar */
        }

        .status-bar i {
            margin-right: 0.5rem;
        }
    </style>
</head>
<body>

<!-- Navigation Bar -->
<nav class="navbar navbar-expand-lg navbar-dark">
    <a class="navbar-brand" href="index.php">
        <img src="images/FinTrack.png" alt="FinTrack Logo"> FinTrack
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav me-auto">
            <!-- Left side links -->
            <li class="nav-item">
                <a class="nav-link active" href="dashboard.php">Dashboard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="goals.php">Goals</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="transactions.php">Transactions</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="reports.php">Reports</a>
            </li>
        </ul>
        <form class="d-flex mx-auto">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-light" type="submit">Search</button>
        </form>
        <ul class="navbar-nav ms-auto">
            <!-- Right side links -->
            <li class="nav-item">
                <a class="nav-link" href="index.php">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="help_support.php">Help Center</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="login_signup.php">Login</a>
            </li>
        </ul>
    </div>
</nav>

<!-- Status Bar -->
<div class="status-bar">
    <i class="fas fa-user"></i>
    <span>Welcome, John Doe</span>
</div>

<!-- Feedback Modal -->
<iframe src="chatbot.html" style="border:none; position:fixed; bottom:0; right:0; width:300px; height:400px; z-index:1000;"></iframe>


<!-- Dashboard Content -->
<div class="container">
    <!-- Financial Status Overview -->
    <section class="financial-status mb-4">
        <h2>Financial Status</h2>
        <div class="row">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <i class="fas fa-wallet"></i>
                        Total Balance: $5,000
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <i class="fas fa-money-bill-wave"></i>
                        Income: $2,000
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <i class="fas fa-credit-card"></i>
                        Expenses: $1,500
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <i class="fas fa-chart-line"></i>
                        Investment: $1,000
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Budget Analysis -->
    <section class="budget-analysis mb-4">
        <h2>Budget Analysis</h2>
        <div class="chart-container">
            <canvas id="budgetChart"></canvas>
        </div>
    </section>

    <!-- Tasks -->
    <section class="tasks mb-4">
        <h2>Tasks</h2>
        <div class="custom-checkbox">
            <input type="checkbox" id="task1">
            <label for="task1">Complete Monthly Budget</label>
        </div>
        <div class="custom-checkbox">
            <input type="checkbox" id="task2">
            <label for="task2">Review Investment Portfolio</label>
        </div>
        <div class="custom-checkbox">
            <input type="checkbox" id="task3">
            <label for="task3">Prepare Tax Documents</label>
        </div>
    </section>

    <!-- Alerts -->
    <section class="alerts mb-4">
        <h2>Alerts</h2>
        <div class="card">
            <div class="card-body">
                <i class="fas fa-exclamation-triangle"></i>
                Reminder: Your credit card payment is due in 3 days!
            </div>
        </div>
    </section>

    <!-- Quick Links -->
    <section class="quick-links mb-4">
        <h2>Quick Links</h2>
        <div class="row">
            <div class="col-md-4">
                <a href="transactions.php" class="btn btn-secondary">View Transactions</a>
            </div>
            <div class="col-md-4">
                <a href="settings.php" class="btn btn-secondary">Account Settings</a>
            </div>
            <div class="col-md-4">
                <a href="reports.php" class="btn btn-secondary">Generate Reports</a>
            </div>
        </div>
    </section>
</div>

    <!-- Footer -->
    <footer style="background-color: #004d00; color: #ffffff; padding: 20px 0; margin-top: 40px;">
        <div class="container text-center">
            <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap;">
                <div style="max-width: 400px; margin-bottom: 20px;">
                    <h4>About the Project</h4>
                    <p>This project, FinTrack, is developed as part of the final year MCA program at Manipal University Jaipur by Sourav Sharma.</p>
                    <p>Roll Number: 2214505923, Batch 4 MCA</p>
                </div>
                <div style="text-align: center; margin-bottom: 20px;">
                    <h4>Contact the Developer</h4>
                    <img src="images/QR_Sourav.png" alt="Developer QR Code" style="width: 120px; height: 120px;">
                </div>
                <div style="text-align: right; max-width: 400px; margin-bottom: 20px; background-color: #ffffff; padding: 10px; border-radius: 8px;">
                    <img src="images/Muj Logo.png" alt="Manipal University Jaipur Logo" class="footer-img">
                </div>
            </div>
            <hr style="border-top: 1px solid #d4edda;">
            <p>&copy; 2024 FinTrack. All Rights Reserved.</p>
        </div>
    </footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.0.0/dist/chart.umd.min.js"></script>
<script>
    // Chart.js initialization for Budget Analysis
    const ctx = document.getElementById('budgetChart').getContext('2d');
    const budgetChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ['Income', 'Expenses', 'Investment'],
            datasets: [{
                data: [2000, 1500, 1000],
                backgroundColor: ['#4caf50', '#f44336', '#2196f3']
            }]
        },
        options: {
            responsive: true
        }
    });
</script>
</body>
</html>
