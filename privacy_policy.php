<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Privacy Policy - FinTrack</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .navbar {
            background-color: #004d00;
            width: 100%;
            position: fixed;
            top: 0;
            z-index: 1000;
        }
        .navbar-brand img {
            width: 40px;
            height: 40px;
        }
        .navbar-nav .nav-link:hover,
        .navbar-nav .nav-link.active {
            color: white; /* Light green for active or hover */
        }
        .content {
            padding-top: 80px; /* Space for fixed navbar */
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
                    <a class="nav-link active" href="privacy_policy.php">Privacy Policy</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="login_signup.php">Login</a>
                </li>
            </ul>
        </div>
    </nav>

    <iframe src="chatbot.html" style="border:none; position:fixed; bottom:0; right:0; width:300px; height:400px; z-index:1000;"></iframe>

    <!-- Main Content -->
    <div class="content">
        <header class="text-center my-5">
            <img src="Fintrack.png" alt="FinTrack Logo" class="mb-4">
            <h1>Privacy Policy</h1>
        </header>

        <!-- Privacy Policy Section -->
        <section class="container my-5">
            <h2>Privacy Policy</h2>
            <p>At FinTrack, we value your privacy and are committed to protecting your personal information. This privacy policy outlines how we collect, store, and use your data.</p>
            <h3>Data Collection</h3>
            <p>We collect data when you register, log in, and use our services. This includes personal information such as your email address, as well as data related to your financial activities.</p>
            <h3>Data Storage</h3>
            <p>All data is stored securely on our servers, and we take appropriate measures to protect it from unauthorized access.</p>
            <h3>Data Usage</h3>
            <p>Your data is used to improve our services and provide you with personalized recommendations. We do not share your data with third parties without your consent.</p>
            <h3>User Rights</h3>
            <p>You have the right to access, modify, and delete your data. If you have any concerns regarding your privacy, please contact us at privacy@fintrack.com.</p>
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


    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
