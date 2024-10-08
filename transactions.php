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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['create_transaction'])) {
        $date = $_POST['transaction_date'];
        $category_id = $_POST['category'];
        $amount = $_POST['amount'];
        $description = $_POST['description']; // Ensure this is not empty or numeric

        $stmt = $conn->prepare("INSERT INTO transactions (user_id, category_id, transaction_date, amount, description) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("iisss", $user_id, $category_id, $date, $amount, $description);

        if ($stmt->execute()) {
            echo '<script>alert("Transaction added successfully!");</script>';
        } else {
            echo '<script>alert("Error: ' . $stmt->error . '");</script>';
        }
        $stmt->close();
    }
}

$transactions_sql = "SELECT t.id, t.transaction_date, c.category_name, t.amount, t.description 
                     FROM transactions t
                     JOIN categories c ON t.category_id = c.id
                     WHERE t.user_id = ?";
$stmt = $conn->prepare($transactions_sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$transactions_result = $stmt->get_result();

// Retrieve categories for dropdown
$categories_sql = "SELECT id, category_name FROM categories";
$categories_result = $conn->query($categories_sql);

// Retrieve user data
$user_sql = "SELECT monthly_income, current_savings FROM users WHERE id = ?";
$stmt = $conn->prepare($user_sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$user_result = $stmt->get_result();
$user_data = $user_result->fetch_assoc();

$monthly_income = $user_data['monthly_income'];
$current_savings = $user_data['current_savings'];

$stmt->close();
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transactions - FinTrack</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    <style>
    /* Main content styling */
    main {
        font-family: 'Arial', sans-serif;
        padding: 40px;
        background-color: #f8f9fa;
        color: #333;
    }

    /* Chatbot iframe styling */
    iframe {
        border: none;
        position: fixed;
        bottom: 0;
        right: 0;
        width: 300px;
        height: 400px;
        z-index: 1000;
        border-radius: 10px;
    }

    /* Container styling */
    .containerr {
        max-width: 1200px;
        margin: 0 auto;
    }

    /* Heading styling */
    h1 {
        font-size: 2.5em;
        color: #2d572c;
        margin-bottom: 20px;
    }

    /* Button styling */
    .btn-primary {
        background-color: #2d572c;
        border: none;
        color: #fff;
        padding: 10px 20px;
        font-size: 1em;
        border-radius: 5px;
        transition: background-color 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #1a3e1d;
    }

    .btn-secondary {
        background-color: #6c757d;
        border: none;
        color: #fff;
        padding: 10px 20px;
        font-size: 1em;
        border-radius: 5px;
        transition: background-color 0.3s ease;
    }

    .btn-secondary:hover {
        background-color: #5a6268;
    }

    /* Modal styling */
    .modal-content {
        border-radius: 10px;
    }

    .modal-header {
        background-color: #2d572c;
        color: #fff;
        border-bottom: 2px solid #1a3e1d;
    }

    .modal-header .close {
        color: #fff;
    }

    .modal-body {
        padding: 20px;
    }

    /* Table styling */
    .table {
        width: 100%;
        margin-bottom: 1rem;
        color: #333;
    }

    .table-striped tbody tr:nth-of-type(odd) {
        background-color: #f2f2f2;
    }

    .table thead th {
        background-color: #2d572c;
        color: #fff;
        text-align: center;
    }

    .table tbody td {
        text-align: center;
    }
    @media (max-width: 768px) {
        #transactionsTable th, #transactionsTable td {
            font-size: 14px;
            padding: 8px;
        }

        #transactionsTable th:nth-child(1), #transactionsTable td:nth-child(1),
        #transactionsTable th:nth-child(4), #transactionsTable td:nth-child(4) {
            display: none;
        }

        #transactionsTable th, #transactionsTable td {
            white-space: nowrap;
            text-overflow: ellipsis;
            overflow: hidden;
        }

        .table-responsive {
            overflow-x: auto;
        }
    }

    /* Form styling */
    .form-group {
        margin-bottom: 1rem;
    }

    .form-control {
        border: 2px solid #2d572c;
        border-radius: 5px;
        padding: 10px;
        font-size: 1em;
    }

    .form-control:focus {
        border-color: #1a3e1d;
        box-shadow: 0 0 0 0.2rem rgba(0, 0, 0, 0.1);
    }

    /* Alert box styling */
    .alert-success {
        background-color: #d4edda;
        color: #155724;
        border: 2px solid #c3e6cb;
        border-radius: 5px;
        padding: 15px;
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


    <div class="container mt-5">
    <h1 class="mb-4">Manage Your Transactions</h1>
    <p class="mb-4">Use the options below to add, update, or delete transactions. The table displays all your current transactions for easy management.</p>
    
    <!-- Buttons to Open Modals -->
    <div class="mb-4">
        <button class="btn btn-primary mr-2" data-toggle="modal" data-target="#addTransactionModal">Add New Transaction</button>
        <button class="btn btn-secondary mr-2" data-toggle="modal" data-target="#updateTransactionModal">Update Existing Transaction</button>
        <button class="btn btn-danger" data-toggle="modal" data-target="#deleteTransactionModal">Delete Transaction</button>
    </div>

<!-- Add Transaction Modal -->
<div class="modal fade" id="addTransactionModal" tabindex="-1" role="dialog" aria-labelledby="addTransactionModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addTransactionModalLabel">Add New Transaction</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="transactions.php">
                    <div class="form-group">
                        <label for="transaction_date">Date</label>
                        <input type="date" class="form-control" id="transaction_date" name="transaction_date" required>
                    </div>
                    <div class="form-group">
                        <label for="category">Category</label>
                        <select class="form-control" id="category" name="category" required>
                            <?php while ($row = $categories_result->fetch_assoc()): ?>
                                <option value="<?= $row['id'] ?>"><?= $row['category_name'] ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="amount">Amount</label>
                        <input type="number" step="0.01" class="form-control" id="amount" name="amount" required>
                    </div>
                    <div class="form-group">
    <label for="description">Description</label>
    <textarea class="form-control" id="description" name="description"></textarea>
</div>

                    <button type="submit" class="btn btn-primary" name="create_transaction">Add Transaction</button>
                </form>
            </div>
        </div>
    </div>
</div>

    <!-- Update Transaction Modal -->
    <div class="modal fade" id="updateTransactionModal" tabindex="-1" role="dialog" aria-labelledby="updateTransactionModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateTransactionModalLabel">Update Existing Transaction</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="transactions.php">
                        <div class="form-group">
                            <label for="transaction_id">Transaction ID</label>
                            <input type="number" class="form-control" id="transaction_id" name="transaction_id" required>
                        </div>
                        <div class="form-group">
                            <label for="transaction_date">Date</label>
                            <input type="date" class="form-control" id="transaction_date" name="transaction_date" required>
                        </div>
                        <div class="form-group">
                            <label for="category">Category</label>
                            <select class="form-control" id="category" name="category" required>
                                <?php while ($row = $categories_result->fetch_assoc()): ?>
                                    <option value="<?= $row['id'] ?>"><?= $row['category_name'] ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="amount">Amount</label>
                            <input type="number" step="0.01" class="form-control" id="amount" name="amount" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" name="description"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" name="update_transaction">Update Transaction</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Transaction Modal -->
    <div class="modal fade" id="deleteTransactionModal" tabindex="-1" role="dialog" aria-labelledby="deleteTransactionModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteTransactionModalLabel">Delete Transaction</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="transactions.php">
                        <div class="form-group">
                            <label for="transaction_id">Transaction ID</label>
                            <input type="number" class="form-control" id="transaction_id" name="transaction_id" required>
                        </div>
                        <button type="submit" class="btn btn-danger" name="delete_transaction">Delete Transaction</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

<!-- Transactions Table -->
<div class="mt-4">
    <h3 class="mb-3">Your Transactions</h3>
    <div class="table-responsive">
        <table id="transactionsTable" class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Date</th>
                    <th>Category</th>
                    <th>Amount</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $transactions_result->fetch_assoc()): ?>
                    <tr>
                        <td><?= $row['id'] ?></td>
                        <td><?= $row['transaction_date'] ?></td>
                        <td><?= $row['category_name'] ?></td>
                        <td><?= $row['amount'] ?></td>
                        <td><?= $row['description'] ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
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
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#transactionsTable').DataTable();
    });
</script>
</body>
</html>
