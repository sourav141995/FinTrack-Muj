<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login_signup.php");
    exit();
}
$current_page = basename($_SERVER['PHP_SELF']);

require 'backend/db.php'; // Ensure this file includes database connection setup

$user_id = $_SESSION['user_id'];

try {
    // Add New Goal
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_goal'])) {
        $goalName = htmlspecialchars($_POST['goalName']);
        $goalTarget = floatval($_POST['goalTarget']);
        $goalDeadline = htmlspecialchars($_POST['goalDeadline']);
        
        $timeframe = (strtotime($goalDeadline) - time()) / (60 * 60 * 24 * 30); // Calculate timeframe in months

        if ($timeframe < 0) {
            echo "Deadline cannot be in the past.";
        } else {
            $stmt = $pdo->prepare("INSERT INTO goals (user_id, goal_name, target_amount, timeframe) VALUES (?, ?, ?, ?)");
            $stmt->execute([$user_id, $goalName, $goalTarget, $timeframe]);
        }
    }

    // Retrieve user goals along with current savings
    $stmt = $pdo->prepare("
        SELECT g.*, u.current_savings 
        FROM goals g
        JOIN users u ON g.user_id = u.id
        WHERE g.user_id = ?
    ");
    $stmt->execute([$user_id]);
    $goals = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Handle editing an existing goal
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_goal'])) {
        $goalId = intval($_POST['goalId']);
        $goalTarget = floatval($_POST['goalTarget']);
        $goalDeadline = htmlspecialchars($_POST['goalDeadline']);
        
        $timeframe = (strtotime($goalDeadline) - time()) / (60 * 60 * 24 * 30); // Calculate timeframe in months

        if ($timeframe < 0) {
            echo "Deadline cannot be in the past.";
        } else {
            $stmt = $pdo->prepare("UPDATE goals SET target_amount = ?, timeframe = ? WHERE id = ? AND user_id = ?");
            $stmt->execute([$goalTarget, $timeframe, $goalId, $user_id]);
        }
    }

    // Handle deleting a goal
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_goal'])) {
        $goalId = intval($_POST['goalId']);
        
        $stmt = $pdo->prepare("DELETE FROM goals WHERE id = ? AND user_id = ?");
        $stmt->execute([$goalId, $user_id]);
    }

    // Handle goal analysis
    $analysisResult = '';
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['analyze_goal'])) {
        $goalNameToAnalyze = htmlspecialchars($_POST['goalSelect']);
        
        // Perform analysis (replace this with actual analysis logic)
        $analysisResult = "Analysis result for {$goalNameToAnalyze}: You are on track!";
    }
} catch (PDOException $e) {
    echo "Database error: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Financial Goals - FinTrack</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <style>
    /* Main content styling */
    main {
        background-color: #f9f9f9;
        padding: 40px;
        font-family: 'Arial', sans-serif;
        color: #333;
    }

    /* Container styling */
    .container {
        max-width: 1200px;
        margin: 0 auto;
    }

    /* Heading styles */
    h1 {
        font-size: 2.5em;
        color: #2d572c;
        margin-bottom: 20px;
    }

    h2 {
        font-size: 2em;
        color: #2d572c;
        margin-bottom: 15px;
    }

    /* Form label styling */
    .form-label {
        font-weight: bold;
        color: #2d572c;
    }

    /* Form control styling */
    .form-control {
        border: 2px solid #2d572c;
        border-radius: 5px;
        padding: 10px;
        font-size: 1em;
    }

    /* Custom button styling */
    .btn-custom {
        background-color: #2d572c;
        color: #fff;
        border: none;
        padding: 10px 20px;
        font-size: 1em;
        border-radius: 5px;
        transition: background-color 0.3s ease;
    }

    .btn-custom:hover {
        background-color: #1a3e1d;
    }

    /* Card styling */
    .card {
        border: 1px solid #2d572c;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .card-body {
        padding: 20px;
    }

    .card-title {
        font-size: 1.5em;
        color: #2d572c;
        margin-bottom: 15px;
    }

    .goal-progress {
        font-size: 1em;
        color: #333;
    }

    /* Progress bar styling */
    .progress {
        height: 20px;
        background-color: #e6e6e6;
        border-radius: 10px;
    }

    .progress-bar-custom {
        background-color: #2d572c;
        border-radius: 10px;
    }

    /* Modal content styling */
    .modal-content {
        border-radius: 10px;
    }

    .modal-header {
        background-color: #2d572c;
        color: #fff;
        border-bottom: 2px solid #1a3e1d;
    }

    .btn-danger {
        background-color: #dc3545;
        color: #fff;
        border-radius: 5px;
        padding: 10px 20px;
    }

    .btn-danger:hover {
        background-color: #c82333;
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


    <iframe src="chatbot.html" style="border:none; position:fixed; bottom:0; right:0; width:300px; height:400px; z-index:1000;"></iframe>


<main>
    <!-- Main Content -->
    <div class="container mt-5">
        <h1>My Financial Goals</h1>
        <p>Track your progress and achieve your financial targets with customized goals.</p>

        <!-- Add New Goal Section -->
        <section class="add-goal-section mb-5">
            <h2>Add New Goal</h2>
            <form method="post">
                <div class="mb-3">
                    <label for="goalName" class="form-label">Goal Name:</label>
                    <input type="text" id="goalName" name="goalName" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="goalTarget" class="form-label">Target Amount:</label>
                    <input type="number" id="goalTarget" name="goalTarget" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="goalDeadline" class="form-label">Deadline:</label>
                    <input type="date" id="goalDeadline" name="goalDeadline" class="form-control" required>
                </div>
                <button type="submit" name="add_goal" class="btn btn-custom">Add Goal</button>
            </form>
        </section>

<!-- Goals Section -->
<section class="goals-section mb-5">
    <div class="row">
        <?php foreach ($goals as $goal) : ?>
            <?php
            // Calculate progress
            $progress = ($goal['current_amount'] / $goal['target_amount']) * 100;
            ?>
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($goal['goal_name']); ?></h5>
                        <p class="goal-progress">Target: ₹<?= htmlspecialchars(number_format($goal['target_amount'], 2)); ?></p>
                        <p class="goal-progress">Current Savings: ₹<?= htmlspecialchars(number_format($goal['current_savings'], 2)); ?></p>
                        <p class="goal-progress">Deadline: <?= htmlspecialchars(date('Y-m-d', strtotime("+{$goal['timeframe']} months"))); ?></p>
                        <div class="progress mb-3">
                            <div class="progress-bar progress-bar-custom" role="progressbar" style="width: <?= $progress; ?>%;" aria-valuenow="<?= $progress; ?>" aria-valuemin="0" aria-valuemax="100">
                                <?= number_format($progress, 2); ?>%
                            </div>
                        </div>
                        <!-- Edit and Delete Goal -->
                        <form method="post" class="d-inline">
                            <input type="hidden" name="goalId" value="<?= htmlspecialchars($goal['id']); ?>">
                            <button type="submit" name="edit_goal" class="btn btn-warning">Edit</button>
                            <button type="submit" name="delete_goal" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>

        <!-- Advanced Goal Analysis Section -->
        <section class="advanced-goal-analysis mb-5">
            <h2>Advanced Goal Analysis</h2>
            <p>Analyze your goals with advanced algorithms to optimize your savings strategy.</p>
            <form method="post">
                <div class="mb-3">
                    <label for="goalSelect" class="form-label">Select Goal for Analysis:</label>
                    <select id="goalSelect" name="goalSelect" class="form-select">
                        <?php foreach ($goals as $goal) : ?>
                            <option value="<?= htmlspecialchars($goal['goal_name']); ?>"><?= htmlspecialchars($goal['goal_name']); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <button type="submit" name="analyze_goal" class="btn btn-custom">Analyze</button>
            </form>

            <?php if ($analysisResult) : ?>
                <div class="alert alert-success mt-3" role="alert">
                    <?= $analysisResult; ?>
                </div>
            <?php endif; ?>
        </section>
    </div>
    </main>
   <!-- Footer -->
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


    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
