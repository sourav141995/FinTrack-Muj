<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports - FinTrack</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    
    <style>
        /* Internal CSS for Fixed Navbar */

        .navbar {
            background-color: #004d40; /* Dark green background */
            padding: 1rem;
            transition: background-color 0.3s;
            margin-bottom: 20px; /* Space below navbar */
            position: fixed; /* Fixes the navbar at the top */
            top: 0; /* Positions it at the top of the page */
            width: 100%; /* Ensures the navbar spans the full width */
            z-index: 1000; /* Keeps the navbar above other content */
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

        .navbar-nav .nav-link {
            color: #fff;
            margin-left: 1rem;
            transition: color 0.3s;
        }

        .navbar-nav .nav-link:hover,
        .navbar-nav .nav-link.active {
            color: #aed581; /* Light green for active or hover */
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

        /* Additional Styles */
        body {
            padding-top: 70px; /* Adjust based on the height of your navbar */
        }

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
            margin-bottom: 1rem;
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

        .chart-container {
            margin: 2rem 0;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
                    <a class="nav-link" href="transactions.php">Transactions</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="reports.php">Reports</a>
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

    <iframe src="chatbot.html" style="border:none; position:fixed; bottom:0; right:0; width:300px; height:400px; z-index:1000;"></iframe>

    <!-- Main Content -->
    <div class="container">
        <h1 class="my-4">Reports</h1>

        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Income vs Expenses</h5>
                <div class="chart-container">
                    <canvas id="incomeExpensesChart"></canvas>
                </div>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Savings Progress</h5>
                <div class="chart-container">
                    <canvas id="savingsProgressChart"></canvas>
                </div>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Generate Custom Report</h5>
                <form>
                    <div class="mb-3">
                        <label for="reportData" class="form-label">Data</label>
                        <input type="text" class="form-control" id="reportData" placeholder="Enter data">
                    </div>
                    <div class="mb-3">
                        <label for="reportFormat" class="form-label">Format</label>
                        <select id="reportFormat" class="form-control">
                            <option value="pdf">PDF</option>
                            <option value="excel">Excel</option>
                            <option value="csv">CSV</option>
                        </select>
                    </div>
                    <button type="button" class="btn btn-custom" onclick="generateCustomReport()">Generate Report</button>
                </form>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Manage Transactions</h5>
                <button class="btn btn-custom" onclick="openAddTransactionForm()">Add Transaction</button>
                <button class="btn btn-custom" onclick="openExportOptions()">Export</button>
                <button class="btn btn-custom" onclick="openFilterForm()">Filter</button>

                <!-- Transactions Table -->
                <table class="table table-striped mt-3" id="transactionTable">
                    <thead>
                        <tr>
                            <th onclick="sortTable(0)">Date</th>
                            <th onclick="sortTable(1)">Description</th>
                            <th onclick="sortTable(2)">Amount</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>2024-08-27</td>
                            <td>Example Transaction</td>
                            <td>$100.00</td>
                            <td>
                                <button class="btn btn-custom btn-sm" onclick="openEditTransactionForm()">Edit</button>
                                <button class="btn btn-danger btn-sm" onclick="confirmDeleteTransaction()">Delete</button>
                            </td>
                        </tr>
                        <!-- Add more rows as needed -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Feedback Modal -->
    <div class="modal fade" id="feedbackModal" tabindex="-1" aria-labelledby="feedbackModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="feedbackModalLabel">Feedback</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="feedbackName" class="form-label">Name</label>
                            <input type="text" class="form-control" id="feedbackName">
                        </div>
                        <div class="mb-3">
                            <label for="feedbackEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="feedbackEmail">
                        </div>
                        <div class="mb-3">
                            <label for="feedbackMessage" class="form-label">Message</label>
                            <textarea class="form-control" id="feedbackMessage" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit Feedback</button>
                    </form>
                </div>
            </div>
        </div>
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
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="js/script.js"></script>
    <script>
        // Chart.js Code
        var ctxIncomeExpenses = document.getElementById('incomeExpensesChart').getContext('2d');
        var incomeExpensesChart = new Chart(ctxIncomeExpenses, {
            type: 'bar',
            data: {
                labels: ['Income', 'Expenses'],
                datasets: [{
                    label: 'Amount',
                    data: [1000, 800], // Example data
                    backgroundColor: ['rgba(75, 192, 192, 0.2)', 'rgba(255, 99, 132, 0.2)'],
                    borderColor: ['rgba(75, 192, 192, 1)', 'rgba(255, 99, 132, 1)'],
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

        var ctxSavingsProgress = document.getElementById('savingsProgressChart').getContext('2d');
        var savingsProgressChart = new Chart(ctxSavingsProgress, {
            type: 'doughnut',
            data: {
                labels: ['Saved', 'Remaining'],
                datasets: [{
                    label: 'Savings Progress',
                    data: [70, 30], // Example data
                    backgroundColor: ['rgba(54, 162, 235, 0.2)', 'rgba(201, 203, 207, 0.2)'],
                    borderColor: ['rgba(54, 162, 235, 1)', 'rgba(201, 203, 207, 1)'],
                    borderWidth: 1
                }]
            }
        });

        function generateCustomReport() {
            var data = document.getElementById('reportData').value;
            var format = document.getElementById('reportFormat').value;
            alert('Generating ' + format + ' report for ' + data);
            // Add actual report generation logic here
        }

        function openAddTransactionForm() {
            // Add logic to open add transaction form
            alert('Open Add Transaction Form');
        }

        function openExportOptions() {
            // Add logic to open export options
            alert('Open Export Options');
        }

        function openFilterForm() {
            // Add logic to open filter form
            alert('Open Filter Form');
        }

        function openEditTransactionForm() {
            // Add logic to open edit transaction form
            alert('Open Edit Transaction Form');
        }

        function confirmDeleteTransaction() {
            // Add logic to confirm and delete transaction
            if (confirm('Are you sure you want to delete this transaction?')) {
                alert('Transaction deleted');
            }
        }

        // Example function for sorting table (basic implementation)
        function sortTable(n) {
            var table, rows, switching, i, x, y, shouldSwitch, dir, switchCount = 0;
            table = document.getElementById("transactionTable");
            switching = true;
            dir = "asc";
            while (switching) {
                switching = false;
                rows = table.rows;
                for (i = 1; i < (rows.length - 1); i++) {
                    shouldSwitch = false;
                    x = rows[i].getElementsByTagName("TD")[n];
                    y = rows[i + 1].getElementsByTagName("TD")[n];
                    if (dir == "asc") {
                        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                            shouldSwitch = true;
                            break;
                        }
                    } else if (dir == "desc") {
                        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                            shouldSwitch = true;
                            break;
                        }
                    }
                }
                if (shouldSwitch) {
                    rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                    switching = true;
                    switchCount++;
                } else {
                    if (switchCount === 0 && dir === "asc") {
                        dir = "desc";
                        switching = true;
                    }
                }
            }
        }
    </script>
</body>
</html>
