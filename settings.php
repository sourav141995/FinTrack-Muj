<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings - FinTrack</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
   <!-- Navigation Bar -->
   <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="index.php">
        <img src="Fintrack.png" alt="Fintrack Logo" class="logo"> FinTrack
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
                <a class="nav-link" href="index.php">Dashboard</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="featuresDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Features
                </a>
                <div class="dropdown-menu" aria-labelledby="featuresDropdown">
                    <a class="dropdown-item" href="transactions.php">Transactions</a>
                    <a class="dropdown-item" href="goals.php">Goals</a>
                    <a class="dropdown-item" href="reports.php">Reports</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="supportDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Support
                </a>
                <div class="dropdown-menu" aria-labelledby="supportDropdown">
                    <a class="dropdown-item" href="help_support.php">Help Center</a>
                    <a class="dropdown-item" href="contact_support.php">Contact Support</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="moreDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    More
                </a>
                <div class="dropdown-menu" aria-labelledby="moreDropdown">
                    <a class="dropdown-item" href="settings.php">Settings</a>
                    <a class="dropdown-item" href="about_us.php">About Us</a>
                    <a class="dropdown-item" href="privacy_policy.php">Privacy Policy</a>
                    <a class="dropdown-item" href="feedback.php">Feedback</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="login_signup.php">Login</a>
            </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
    </div>
</nav>


    <!-- Main Content -->
    <div class="container mt-4">
        <h1>Settings</h1>

        <!-- Profile Information -->
        <div class="mt-4">
            <h2>Profile Information</h2>
            <form id="profileInfoForm">
                <div class="form-group">
                    <label for="profileName">Name</label>
                    <input type="text" id="profileName" class="form-control">
                </div>
                <div class="form-group">
                    <label for="profileEmail">Email</label>
                    <input type="email" id="profileEmail" class="form-control">
                </div>
                <div class="form-group">
                    <label for="profilePhone">Phone Number</label>
                    <input type="text" id="profilePhone" class="form-control">
                </div>
                <div class="form-group">
                    <label for="profileAddress">Address</label>
                    <input type="text" id="profileAddress" class="form-control">
                </div>
                <div class="form-group">
                    <label for="profilePicture">Profile Picture</label>
                    <input type="file" id="profilePicture" class="form-control-file">
                </div>
                <button type="submit" class="btn btn-primary">Update Profile</button>
            </form>
        </div>

        <!-- Account Settings -->
        <div class="mt-4">
            <h2>Account Settings</h2>
            <form id="accountSettingsForm">
                <div class="form-group">
                    <label for="accountType">Account Type</label>
                    <input type="text" id="accountType" class="form-control">
                </div>
                <div class="form-group">
                    <label for="accountNumber">Account Number</label>
                    <input type="text" id="accountNumber" class="form-control">
                </div>
                <div class="form-group">
                    <label for="accountBalance">Account Balance</label>
                    <input type="text" id="accountBalance" class="form-control">
                </div>
                <div class="form-group">
                    <label for="changePassword">Change Password</label>
                    <input type="password" id="changePassword" class="form-control">
                </div>
                <div class="form-group">
                    <label for="confirmPassword">Confirm New Password</label>
                    <input type="password" id="confirmPassword" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">Update Account</button>
            </form>
        </div>

        <!-- Notification Preferences -->
        <div class="mt-4">
            <h2>Notification Preferences</h2>
            <form id="notificationPreferencesForm">
                <div class="form-group">
                    <label>Email Notifications</label>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="emailNotifications">
                        <label class="form-check-label" for="emailNotifications">Enable Email Notifications</label>
                    </div>
                </div>
                <div class="form-group">
                    <label>Push Notifications</label>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="pushNotifications">
                        <label class="form-check-label" for="pushNotifications">Enable Push Notifications</label>
                    </div>
                </div>
                <div class="form-group">
                    <label>SMS Notifications</label>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="smsNotifications">
                        <label class="form-check-label" for="smsNotifications">Enable SMS Notifications</label>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Update Notifications</button>
            </form>
        </div>

        <!-- Security Settings -->
        <div class="mt-4">
            <h2>Security Settings</h2>
            <form id="securitySettingsForm">
                <div class="form-group">
                    <label for="twoFactorAuth">Two-Factor Authentication</label>
                    <input type="checkbox" id="twoFactorAuth" class="form-check-input">
                </div>
                <div class="form-group">
                    <label for="passwordStrength">Password Strength</label>
                    <input type="text" id="passwordStrength" class="form-control" readonly>
                </div>
                <div class="form-group">
                    <label for="loginHistory">Login History</label>
                    <textarea id="loginHistory" class="form-control" rows="3" readonly></textarea>
                </div>
                <div class="form-group">
                    <label for="securityQuestions">Change Security Questions</label>
                    <input type="text" id="securityQuestions" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">Update Security</button>
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

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="js/script.js"></script>
</body>
</html>
