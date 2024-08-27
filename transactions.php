<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transactions - FinTrack</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css">
    <style>
       /* Internal CSS for Transactions page */

       /* Navigation Bar Design Start */
       .navbar {
           background-color: #004d40; /* Dark green background */
           padding: 1rem;
           transition: background-color 0.3s;
           position: fixed; /* Fixed position */
           top: 0;
           width: 100%;
           z-index: 1000; /* Ensure it is on top */
       }

       .navbar:hover {
           background-color: #00332d; /* Darker green on hover */
       }

       .navbar-brand {
           font-size: 1.5rem;
           color: #fff;
           display: flex;
           align-items: center;
       }

       .navbar-brand img {
           width: 40px;
           margin-right: 10px;
       }

       .navbar a {
           color: #fff;
           margin-left: 1rem;
           transition: color 0.3s;
       }

       .navbar a:hover,
       .navbar a.active {
           color: #aed581; /* Light green for active or hover */
       }

       .navbar .form-inline {
           display: flex;
           justify-content: center;
           flex-grow: 1;
       }

       .navbar .form-inline .form-control {
           width: 200px;
           transition: width 0.3s ease-in-out;
       }

       .navbar .form-inline .form-control:focus {
           width: 300px;
       }

       .navbar .btn-outline-light {
           color: #fff;
           border-color: #fff;
           margin-left: 8px;
       }

       .navbar .btn-outline-light:hover {
           color: #004d40;
           background-color: #aed581;
           border-color: #aed581;
       }

       /* Navigation Bar Link Styles */
       .navbar-nav .nav-link {
           color: #fff;
           margin-left: 1rem;
           transition: color 0.3s;
       }

       .navbar-nav .nav-link:hover,
       .navbar-nav .nav-link.active {
           color: #aed581; /* Light green for active or hover */
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
           padding: 1rem;
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

       /* Additional Content Styles */
       .header-btn {
           margin-left: 10px;
       }

       /* Content Padding to account for fixed navbar */
       body {
           padding-top: 70px; /* Adjust based on navbar height */
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
                <a class="nav-link" href="dashboard.php">Dashboard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="goals.php">Goals</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="transactions.php">Transactions</a>
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

<!-- Feedback Modal -->
<iframe src="chatbot.html" style="border:none; position:fixed; bottom:0; right:0; width:300px; height:400px; z-index:1000;"></iframe>


<!-- Header -->
<header class="d-flex justify-content-between align-items-center mt-4">
    <h1 class="ml-3">Transactions</h1>
    <div>
        <button class="btn btn-primary mr-3 header-btn" onclick="openAddTransactionForm()">Add Transaction</button>
        <button class="btn btn-secondary" onclick="openExportOptions()">Export Data</button>
    </div>
</header>

<!-- Transaction Summary and Statistics -->
<div class="container mt-4">
    <h2>Transaction Summary</h2>
    <div class="row">
        <div class="col-md-4">
            <div class="card text-white bg-success mb-3">
                <div class="card-header">Total Income</div>
                <div class="card-body">
                    <h5 class="card-title">$5000.00</h5>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-danger mb-3">
                <div class="card-header">Total Expenses</div>
                <div class="card-body">
                    <h5 class="card-title">$3000.00</h5>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-info mb-3">
                <div class="card-header">Net Balance</div>
                <div class="card-body">
                    <h5 class="card-title">$2000.00</h5>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Transaction List -->
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <input type="text" class="form-control w-25" id="filterSearch" placeholder="Search Transactions">
        <button class="btn btn-primary" onclick="openFilterForm()">Filter Transactions</button>
    </div>
    <table id="transactionTable" class="display table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Date</th>
                <th>Description</th>
                <th>Category</th>
                <th>Amount</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>2024-08-25</td>
                <td>Groceries</td>
                <td>Food</td>
                <td>$150.00</td>
                <td><button class="btn btn-info btn-sm" onclick="openEditTransactionForm()">Edit</button> <button class="btn btn-danger btn-sm" onclick="confirmDeleteTransaction()">Delete</button></td>
            </tr>
            <!-- More transaction rows go here -->
        </tbody>
    </table>
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

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/momentjs/2.29.1/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<script>
    $(document).ready(function() {
        $('#transactionTable').DataTable();
    });

    function openAddTransactionForm() {
        // Code to open Add Transaction form
    }

    function openExportOptions() {
        // Code to open Export Data options
    }

    function openFilterForm() {
        // Code to open Filter Transactions form
    }

    function openEditTransactionForm() {
        // Code to open Edit Transaction form
    }

    function confirmDeleteTransaction() {
        // Code to confirm deletion of a transaction
    }
</script>
</body>
</html>
