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
        }
        .login-container, .signup-container {
            flex: 1;
            padding: 40px;
            background: #ffffff;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            margin: 20px;
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
            color: white; /* Light green for active or hover */
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
    <nav class="navbar navbar-expand-lg navbar-dark">
        <a class="navbar-brand" href="index.php">
            <img src="Fintrack.png" alt="FinTrack Logo" class="logo"> FinTrack
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
            <li class="nav-item">
                    <a class="nav-link" href="guest_info.html">Guest</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="help_support.php">Help Center</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="about_us.php">About Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="privacy_policy.php">Privacy Policy</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="login_signup.php">Login</a>
                </li>
            </ul>
        </div>
    </nav>
    <iframe src="chatbot.html" style="border:none; position:fixed; bottom:0; right:0; width:300px; height:400px; z-index:1000;"></iframe>

    <!-- Main Content -->
    <div class="main-container">
        <!-- Login Form -->
        <div class="login-container">
            <div class="form-header">
            <img src="images/FinTrack.png" width="400px">
                <h1>Sign In to FinTrack</h1>
            </div>
            <form action="dashboard.html" method="POST">
                <div class="mb-3">
                    <input type="email" class="form-control" placeholder="Email" required>
                </div>
                <div class="mb-3">
                    <input type="password" class="form-control" placeholder="Password" required>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Sign In</button>
            </form>
            <p class="mt-3 text-center">or sign in with</p>
            <button class="btn btn-outline-primary btn-social">Sign in with Google</button>
            <button class="btn btn-outline-primary btn-social">Sign in with Facebook</button>
        </div>

        <!-- Signup Form -->
        <div class="signup-container">
            <div class="form-header">
                <h2>Create Your FinTrack Account</h2>
            </div>
            <form action="dashboard.php" method="POST">
                <!-- User Details -->
                <div class="mb-3">
                    <input type="text" class="form-control" placeholder="Full Name" required>
                </div>
                <div class="mb-3">
                    <input type="email" class="form-control" placeholder="Email" required>
                </div>
                <div class="mb-3">
                    <input type="password" class="form-control" placeholder="Password" required>
                </div>
                <div class="mb-3">
                    <input type="password" class="form-control" placeholder="Confirm Password" required>
                </div>

                <!-- Financial Information -->
                <div class="mb-3">
                    <label for="income" class="form-label">Monthly Income</label>
                    <input type="number" class="form-control" id="income" placeholder="Enter your monthly income" required>
                </div>
                <div class="mb-3">
                    <label for="savings" class="form-label">Current Savings</label>
                    <input type="number" class="form-control" id="savings" placeholder="Enter your current savings" required>
                </div>

                <!-- Financial Goals -->
                <div class="mb-3">
                    <label for="goal" class="form-label">Financial Goal</label>
                    <input type="text" class="form-control" id="goal" placeholder="Enter your financial goal" required>
                </div>
                <div class="mb-3">
                    <label for="timeframe" class="form-label">Timeframe for Goal</label>
                    <input type="number" class="form-control" id="timeframe" placeholder="Enter timeframe in months" required>
                </div>

                <!-- Transaction Categories -->
                <div class="mb-3">
                    <label for="categories" class="form-label">Default Transaction Categories</label>
                    <select multiple class="form-control" id="categories" required>
                        <option>Rent</option>
                        <option>Utilities</option>
                        <option>Groceries</option>
                        <option>Entertainment</option>
                        <option>Transportation</option>
                        <option>Others</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary btn-block">Sign Up</button>
            </form>
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

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
