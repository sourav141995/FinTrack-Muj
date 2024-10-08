<?php
// Get the current file name, e.g., 'about_us.php'
$current_page = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FinTrack - Login & Signup</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
   body, html {
    height: 100%;
    margin: 0;
    display: flex;
    flex-direction: column;
    min-height: 100vh;
    background-color: #f8f9fa;
}

.main-container {
    display: flex;
    flex-grow: 1;
    padding: 20px;
    margin-top: 100px;
    flex-wrap: wrap; /* Allows wrapping of items on smaller screens */
}

.login-container, .signup-container {
    flex: 1;
    padding: 40px;
    background: #ffffff;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
    margin: 20px;
    max-width: 500px; /* Added a max-width for better control on larger screens */
    width: 100%;
}

/* Adjustments for mobile view */
@media (max-width: 768px) {
    .main-container {
        flex-direction: column;
        margin-top: 80px; /* Adjust margin-top for mobile view */
    }

    .login-container, .signup-container {
        margin: 10px; /* Reduce margin on smaller screens */
        padding: 20px; /* Adjust padding for mobile view */
    }

    .form-header h1, .form-header h2 {
        font-size: 1.5em;
    }

    .form-header p {
        font-size: 0.9em;
    }

    .form-control {
        font-size: 14px;
    }

    .btn {
        font-size: 14px;
        padding: 10px; /* Adjust padding for buttons */
    }
}

.form-header {
    text-align: center;
    margin-bottom: 20px;
    color: #004d00;
}

.form-header h1, .form-header h2 {
    font-size: 28px;
}

.btn-social {
    margin-top: 10px;
    width: 100%;
}

.navbar {
    background-color: #004d00; /* Match the dark green theme */
}

.navbar-brand {
    display: flex;
    align-items: center;
}

.navbar-brand img {
    width: 40px; /* Adjust size as needed */
    height: 40px;
}

.btn-primary {
    background-color: #004d00;
    border-color: #004d00;
}

.navbar-nav .nav-link:hover,
.navbar-nav .nav-link.active {
    color: #ffffff; /* Light green for active or hover */
}

.btn-primary:hover {
    background-color: #003300;
    border-color: #003300;
}

.btn-outline-primary {
    color: #004d00;
    border-color: #004d00;
}

.btn-outline-primary:hover {
    background-color: #004d00;
    color: #ffffff;
}

    </style>
</head>
<body>
    <!-- Navigation Bar -->
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

    <main>
    <!-- Main Content -->
    <div class="main-container">
        <!-- Login Form -->
        <div class="login-container">
            <div class="form-header">
            <img src="images/FinTrack.png" width="400px">
                <h1>Sign In to FinTrack</h1>
            </div>
<!-- Sign-In Form -->
<div class="container mt-4">
    <form action="backend/login.php" method="POST">
        <div class="mb-3">
            <input type="email" class="form-control" name="email" placeholder="Email" required>
        </div>
        <div class="mb-3">
            <input type="password" class="form-control" name="password" placeholder="Password" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Sign In</button>
    </form>
    <p class="mt-3 text-center">or sign in with</p>
    <div class="d-grid gap-2">
        <button class="btn btn-outline-primary btn-social">Sign in with Google</button>
        <button class="btn btn-outline-primary btn-social">Sign in with Facebook</button>
    </div>
</div>

<!-- Signup Form -->
<div class="container mt-5 signup-container">
    <div class="form-header text-center mb-4">
        <h2>Create Your FinTrack Account</h2>
        <p>Get started on managing your finances effectively.</p>
    </div>
    <form action="backend/register.php" method="POST">
        <!-- User Details -->
        <div class="row">
            <div class="col-md-6 mb-3">
                <input type="text" class="form-control" name="full_name" placeholder="Full Name" required>
            </div>
            <div class="col-md-6 mb-3">
                <input type="email" class="form-control" name="email" placeholder="Email" required>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <input type="password" class="form-control" name="password" placeholder="Password" required minlength="8">
                <small class="form-text text-muted">Password must be at least 8 characters long.</small>
            </div>
            <div class="col-md-6 mb-3">
                <input type="password" class="form-control" name="confirm_password" placeholder="Confirm Password" required>
            </div>
        </div>

        <!-- Financial Information -->
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="monthly_income" class="form-label">Monthly Income</label>
                <input type="number" class="form-control" name="monthly_income" id="monthly_income" placeholder="Enter your monthly income" required min="0" step="0.01">
            </div>
            <div class="col-md-6 mb-3">
                <label for="current_savings" class="form-label">Current Savings</label>
                <input type="number" class="form-control" name="current_savings" id="current_savings" placeholder="Enter your current savings" required min="0" step="0.01">
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="loan_amount" class="form-label">Loan Amount</label>
                <input type="number" class="form-control" name="loan_amount" id="loan_amount" placeholder="Enter your current loan amount" min="0" step="0.01">
            </div>
            <div class="col-md-6 mb-3">
                <label for="financial_goal" class="form-label">Financial Goal</label>
                <input type="number" class="form-control" name="financial_goal" id="financial_goal" placeholder="Enter your financial goal amount" min="0" step="0.01">
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="goal_timeframe" class="form-label">Goal Timeframe (in months)</label>
                <input type="number" class="form-control" name="goal_timeframe" id="goal_timeframe" placeholder="Enter the timeframe to achieve your goal" min="0">
            </div>
        </div>

        <!-- Additional Information -->
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="age" class="form-label">Age</label>
                <input type="number" class="form-control" name="age" id="age" placeholder="Enter your age" required min="0">
            </div>
            <div class="col-md-6 mb-3">
                <label for="retirement_age" class="form-label">Retirement Age</label>
                <input type="number" class="form-control" name="retirement_age" id="retirement_age" placeholder="Enter your planned retirement age" required min="0">
            </div>
        </div>
        <div class="mb-3">
            <label for="profession" class="form-label">Profession</label>
            <input type="text" class="form-control" name="profession" id="profession" placeholder="Enter your profession" required>
        </div>

        <!-- Terms and Conditions -->
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="terms" required>
            <label class="form-check-label" for="terms">I agree to the <a href="privacy_policy.php">Terms and Conditions</a></label>
        </div>

        <button type="submit" class="btn btn-primary w-100">Sign Up</button>
    </form>
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
    width: 1000 px;
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

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
