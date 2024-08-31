<?php
// Get the current file name, e.g., 'about_us.php'
$current_page = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - FinTrack</title>
    
    <!-- Include Bootstrap CSS for modern styling -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Include Font Awesome for icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    
    <style>
         body {
            background-color: #f4f4f4;
            color: #333;
            padding-top: 80px; /* Adjust this value as needed */
        }
        .navbar {
            background-color: #004d00;
            position: fixed;
            top: 0;
            width: 100%;
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
        .header {
            background-color: #00796b;
            color: white;
            padding: 40px 0;
            text-align: center;
            margin-bottom: 20px;
        }
        .header img {
            width: 100px;
            height: auto;
        }
        .header h1 {
            margin: 20px 0;
            font-size: 2.5rem;
        }
        .container h2 {
            color: #004d40;
        }
           /* Keyframe Animations */
           @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        @keyframes scaleUp {
            from { transform: scale(0.9); }
            to { transform: scale(1); }
        }
        @keyframes slideUp {
            from { transform: translateY(20px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
        @keyframes zoomIn {
            from { transform: scale(0.8); opacity: 0; }
            to { transform: scale(1); opacity: 1; }
        }
        .img-fluid {
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .team-member img {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 50%;
        }
        main {
            padding-top: 70px; /* Added padding to avoid overlap with navbar */
        }
        .footer-img {
            max-width: 200px;
            height: auto;
        }
        .footer-content {
            background-color: #ffffff;
            padding: 10px;
            border-radius: 8px;
            text-align: center;
        }
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .card-body {
            text-align: center;
        }
        .card img {
            max-width: 150px;
            height: auto;
            border-radius: 50%;
        }
        .card video {
            width: 100%;
            max-width: 600px;
            margin-top: 20px;
        }
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

<main>
    <!-- Header -->
    <header class="header" style="margin-top: -90px;">
        <h1>About The Project</h1>
    </header>
    <iframe src="chatbot.html" style="border:none; position:fixed; bottom:0; right:0; width:300px; height:400px; z-index:1000;"></iframe>

   
    <!-- Developer Information and Video Section -->
<!-- Section with Heavy Animations -->
<section class="container my-5" style="animation: fadeIn 2s ease-in-out;">
    <div class="card" style="animation: scaleUp 1.5s ease-in-out; padding: 20px; border-radius: 15px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);">
        <div class="card-body" style="animation: slideUp 1s ease-out;">
            <h2 style="animation: zoomIn 1.5s ease-in-out;">About the Developer</h2>
            <img src="images/developer_photo.jpeg" alt="Developer Photo" style="width: 150px; height: 150px; border-radius: 50%; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); animation: zoomIn 2s ease-in-out;">
            <h4 style="animation: slideUp 1s ease-out;">Sourav Sharma</h4>
            <p style="animation: slideUp 1.5s ease-out;">Final Year Student, Manipal University Jaipur</p>
            <p style="animation: slideUp 2s ease-out;">Developer of FinTrack</p>
            <video controls autoplay muted style="width: 100%; max-width: 600px; margin-top: 20px; animation: zoomIn 2s ease-in-out;">
                <source src="video/SAMPLE- SELF INTRO SOURAV SHARMA.mp4" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>
    </div>
</section>
    
    <!-- Combined Company Information and Mission & Vision Section -->
    <section class="container my-5">
        <div class="card">
            <div class="card-body">
                <h2>About Us</h2>
                <div class="row">
                    <div class="col-md-6">
                        <h3>About the Project</h3>
                        <p>FinTrack is a personal finance app designed to help you manage your money better. Founded in 2024, we are dedicated to providing an easy and effective way to track your spending, set financial goals, and plan for the future.</p>
                        <img src="images/FinTrack.png" class="img-fluid my-4" alt="Company Image">
                    </div>
                    <div class="col-md-6">
                        <h3>Mission and Vision</h3>
                        <p>At FinTrack, our mission is to empower individuals to take control of their financial future. We envision a world where personal finance management is simplified and accessible to everyone.</p>
                        <img src="images/Company.png" class="img-fluid my-4" alt="Mission and Vision Image">
                    </div>
                </div>
            </div>
        </div>
    </section>

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
</main>

<!-- Bootstrap JS and dependencies -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
