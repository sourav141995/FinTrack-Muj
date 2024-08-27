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
<nav class="navbar navbar-expand-lg navbar-dark  fixed-top">
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
                <a class="nav-link active" href="about_us.php">About Us</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="privacy_policy.php">Privacy Policy</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="login_signup.php">Login</a>
            </li>
        </ul>
    </div>
</nav>

<main>
    <!-- Header -->
    <header class="header">
        <h1>About Us</h1>
    </header>
    <iframe src="chatbot.html" style="border:none; position:fixed; bottom:0; right:0; width:300px; height:400px; z-index:1000;"></iframe>

   
    <!-- Developer Information and Video Section -->
    <section class="container my-5">
        <div class="card">
            <div class="card-body">
                <h2>About the Developer</h2>
                <img src="images/developer_photo.jpeg" alt="Developer Photo">
                <h4>Sourav Sharma</h4>
                <p>Final Year Student, Manipal University Jaipur</p>
                <p>Developer of FinTrack</p>
                <video controls autoplay muted>
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
                        <h3>Our Company</h3>
                        <p>FinTrack is a personal finance app designed to help you manage your money better. Founded in 2024, we are dedicated to providing an easy and effective way to track your spending, set financial goals, and plan for the future.</p>
                        <img src="images/FinTrack.png" class="img-fluid my-4" alt="Company Image">
                    </div>
                    <div class="col-md-6">
                        <h3>Our Mission and Vision</h3>
                        <p>At FinTrack, our mission is to empower individuals to take control of their financial future. We envision a world where personal finance management is simplified and accessible to everyone.</p>
                        <img src="images/Company.png" class="img-fluid my-4" alt="Mission and Vision Image">
                    </div>
                </div>
            </div>
        </div>
    </section>

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
</main>

<!-- Bootstrap JS and dependencies -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
