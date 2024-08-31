<?php
// Get the current file name, e.g., 'about_us.php'
$current_page = basename($_SERVER['PHP_SELF']);
?>
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


    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
