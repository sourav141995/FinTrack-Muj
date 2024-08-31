<?php
// Get the current file name, e.g., 'about_us.php'
$current_page = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FinTrack - Finance Insights</title>
    
    <!-- Include Bootstrap CSS for modern styling -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Include Font Awesome for icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    
    <style>
        body {
            background-color: #f8f9fa;
            color: #333;
            font-family: Arial, sans-serif;
            margin-top: 50px;
        }
        .status-bar {
            background-color: #004d00;
            color: #fff;
            padding: 10px 0;
            text-align: center;
        }
        .status-bar i {
            margin-right: 10px;
        }
        .header {
            text-align: center;
            padding: 50px 20px;
            background: linear-gradient(135deg, #004d00, #003300);
            color: #fff;
        }
        .header h1 {
            font-size: 3rem;
        }
        .header p {
            font-size: 1.25rem;
        }
        .content {
            margin-top: -4px;
            padding: 30px 20px;
        }
        .content h2 {
            margin-bottom: 30px;
        }
        .card {
            border-radius: 10px;
            overflow: hidden;
            transition: transform 0.3s ease-in-out;
        }
        .card:hover {
            transform: scale(1.05);
        }
        .card img {
            width: 100%;
            height: auto;
        }
        .btn-read-more {
            background-color: #004d00;
            color: #fff;
            border-radius: 20px;
        }
        .btn-read-more:hover {
            background-color: #003300;
            color: #fff;
        }
        .feature-section {
            margin-bottom: 50px;
        }
        .feature-section img {
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .feature-description {
            margin-top: 20px;
        }
        .feature-description h3 {
            margin-bottom: 15px;
        }
    </style>
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" style="
    background: linear-gradient(135deg, #004d00 50%, #002600 50%);
    padding: 1rem;
    margin-bottom: 20px;
    width: 100%;
    z-index: 1000;
">
    <div class="container-fluid">
        <!-- Navbar Brand with Logo aligned to the left -->
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

        <!-- Navbar Links aligned to the right -->
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav" style="display: flex; align-items: center;">
                <li class="nav-item" style="margin-left: 1rem;">
                    <a class="nav-link <?php echo ($current_page == 'guest_info.php') ? 'active' : ''; ?>" href="guest_info.php" style="
                        color: #fff;
                        transition: color 0.3s, transform 0.3s;
                        padding: 10px 15px;
                        border-radius: 20px;
                        box-shadow: <?php echo ($current_page == 'guest_info.php') ? '0px 4px 15px rgba(0, 255, 0, 0.6)' : 'none'; ?>;
                        background-color: <?php echo ($current_page == 'guest_info.php') ? 'rgba(0, 255, 0, 0.2)' : 'transparent'; ?>;
                        font-weight: <?php echo ($current_page == 'guest_info.php') ? 'bold' : 'normal'; ?>;
                    " onmouseover="this.style.color='#00ff00';" onmouseout="this.style.color='#fff';">
                        Guest
                    </a>
                </li>
                <li class="nav-item" style="margin-left: 1rem;">
                    <a class="nav-link <?php echo ($current_page == 'about_us.php') ? 'active' : ''; ?>" href="about_us.php" style="
                        color: #fff;
                        transition: color 0.3s, transform 0.3s;
                        padding: 10px 15px;
                        border-radius: 20px;
                        box-shadow: <?php echo ($current_page == 'about_us.php') ? '0px 4px 15px rgba(0, 255, 0, 0.6)' : 'none'; ?>;
                        background-color: <?php echo ($current_page == 'about_us.php') ? 'rgba(0, 255, 0, 0.2)' : 'transparent'; ?>;
                        font-weight: <?php echo ($current_page == 'about_us.php') ? 'bold' : 'normal'; ?>;
                    " onmouseover="this.style.color='#00ff00';" onmouseout="this.style.color='#fff';">
                        About Us
                    </a>
                </li>
                <li class="nav-item" style="margin-left: 1rem;">
                    <a class="nav-link <?php echo ($current_page == 'login_signup.php') ? 'active' : ''; ?>" href="login_signup.php" style="
                        color: #fff;
                        transition: color 0.3s, transform 0.3s;
                        padding: 10px 15px;
                        border-radius: 20px;
                        box-shadow: <?php echo ($current_page == 'login_signup.php') ? '0px 4px 15px rgba(0, 255, 0, 0.6)' : 'none'; ?>;
                        background-color: <?php echo ($current_page == 'login_signup.php') ? 'rgba(0, 255, 0, 0.2)' : 'transparent'; ?>;
                        font-weight: <?php echo ($current_page == 'login_signup.php') ? 'bold' : 'normal'; ?>;
                    " onmouseover="this.style.color='#00ff00';" onmouseout="this.style.color='#fff';">
                        Register
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
    
    <!-- Feedback Modal -->
    <iframe src="chatbot.html" style="border:none; position:fixed; bottom:0; right:0; width:300px; height:400px; z-index:1000;"></iframe>
</body>

    <!-- Status Bar -->
    <div class="header">
    <h1>Discover FinTrack's Features</h1>
    <p>Your ultimate tool for comprehensive financial management.</p>
</div>

<!-- Main Content Section -->
<div class="container content">
    <!-- Introduction Section -->
    <div class="text-center mb-5">
        <h2>Explore FinTrack's Key Features</h2>
        <p>FinTrack offers a range of powerful features designed to help you manage your finances efficiently and effectively. From an intuitive dashboard to detailed reports, our platform provides everything you need to stay on top of your financial goals.</p>
    </div>

    <!-- Dashboard Feature Section -->
    <div class="feature-section">
        <h2 class="text-center mb-4">Dashboard</h2>
        <div class="row">
            <div class="col-md-6">
                <img src="images/dashboard screenshot.png" alt="Dashboard Screenshot" class="img-fluid">
            </div>
            <div class="col-md-6">
                <div class="feature-description">
                    <h3>Dashboard Overview</h3>
                    <p>Our intuitive dashboard provides a comprehensive overview of your financial health. Easily track your income, expenses, and savings with real-time updates and customizable widgets.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Reports Feature Section -->
    <div class="feature-section">
        <h2 class="text-center mb-4">Reports</h2>
        <div class="row">
            <div class="col-md-6">
                <img src="images/reports.png" alt="Reports Screenshot" class="img-fluid">
            </div>
            <div class="col-md-6">
                <div class="feature-description">
                    <h3>Detailed Reports</h3>
                    <p>Generate detailed reports to analyze your financial activities. Customize reports based on various parameters and gain valuable insights to make informed decisions.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Transactions Feature Section -->
    <div class="feature-section">
        <h2 class="text-center mb-4">Transactions</h2>
        <div class="row">
            <div class="col-md-6">
                <img src="images/transactions.png" alt="Transactions Screenshot" class="img-fluid">
            </div>
            <div class="col-md-6">
                <div class="feature-description">
                    <h3>Manage Transactions</h3>
                    <p>Effortlessly manage and categorize your transactions. Track spending, add notes, and view historical data to keep your finances organized and accessible.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Goals Feature Section -->
    <div class="feature-section">
        <h2 class="text-center mb-4">Goals</h2>
        <div class="row">
            <div class="col-md-6">
                <img src="images/goals_screenshot.png" alt="Goals Screenshot" class="img-fluid">
            </div>
            <div class="col-md-6">
                <div class="feature-description">
                    <h3>Set and Achieve Goals</h3>
                    <p>Set financial goals and track your progress towards achieving them. Whether saving for a vacation or paying off debt, our goal-setting feature helps you stay motivated and on track.</p>
                </div>
            </div>
        </div>
    </div>
</div>

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

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
