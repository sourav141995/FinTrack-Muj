<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Why Track Your Finances?</title>
    
    <!-- Include Bootstrap CSS for modern styling -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Include Font Awesome for icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <!-- Include Chart.js for data visualization -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Include AOS library for animations -->
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>

    <style>
        body {
            background: url('images/bg.jpg') no-repeat center center fixed;
            background-size: cover;
            color: #fff;
            font-family: Arial, sans-serif;
        }
        .navbar {
            background-color: #004d00;
            transition: background-color 0.5s ease;
        }
        .navbar.scrolled {
            background-color: #003300 !important;
        }
        .navbar-nav .nav-link {
            color: #ffffff !important;
            font-size: 1.1rem;
            transition: color 0.3s ease;
        }
        .navbar-nav .nav-link:hover {
            color: #d4edda !important;
        }
        .navbar-toggler {
            border: none;
        }
        .navbar-toggler-icon {
            background-image: url('data:image/svg+xml;charset=utf8,%3Csvg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"%3E%3Cpath stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" /%3E%3C/svg%3E');
        }
        .logo {
            max-width: 150px;
            height: auto;
        }
        .modal-header, .modal-footer {
            background-color: #003300;
            border: none;
        }
        .signup-form {
            display: none;
            margin-top: 20px;
        }
        .card {
            border-radius: 1rem;
        }
        .card-title {
            color: #004d00;
        }
        .card-text {
            color: #fff;
        }
        .btn-primary {
            background-color: #004d00;
            border-color: #004d00;
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
        .btn-social {
            margin-bottom: 10px;
        }
        .guest-mode a {
            color: #004d00;
        }
        .guest-mode a:hover {
            color: #003300;
        }
        .animate__animated {
            animation-duration: 1.5s;
        }
        .animate__fadeInUp {
            animation-name: fadeInUp;
        }
        /* Center the logo */
        .logo-container {
            display: flex;
            justify-content: center;
            margin-bottom: 40px;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" style="background-color: #004d00;">
        <div class="container">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="guest_info.html">Guest</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about_us.php">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="login_signup.php">Register</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <iframe src="chatbot.html" style="border:none; position:fixed; bottom:0; right:0; width:300px; height:400px; z-index:1000;"></iframe>

    <div class="container my-5 pt-5">
        <!-- Main Content -->
        <div class="row justify-content-center">
            <div class="logo-container">
                <a class="navbar-brand" href="#"><img src="FinTrack.png" alt="FinTrack Logo" class="logo"></a>
            </div>
            <div class="col-lg-8">
                <div class="card shadow-lg" data-aos="fade-up" data-aos-duration="1500">
                    <div class="card-body p-5">
                        <h1 class="card-title text-center mb-4">Why Track Your Finances?</h1>
                        <p class="card-text fs-5">
                            Tracking your finances is essential for managing your money effectively. It helps you understand your spending habits, plan for future expenses, and achieve your financial goals. By regularly monitoring your finances, you can avoid debt, save for emergencies, and make informed investment decisions.
                        </p>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <h4>Benefits of Tracking Finances</h4>
                                <ul class="fa-ul">
                                    <li><span class="fa-li"><i class="fas fa-check-circle text-success"></i></span> Understand your spending habits</li>
                                    <li><span class="fa-li"><i class="fas fa-check-circle text-success"></i></span> Plan for future expenses</li>
                                    <li><span class="fa-li"><i class="fas fa-check-circle text-success"></i></span> Achieve financial goals</li>
                                    <li><span class="fa-li"><i class="fas fa-check-circle text-success"></i></span> Avoid unnecessary debt</li>
                                    <li><span class="fa-li"><i class="fas fa-check-circle text-success"></i></span> Save for emergencies</li>
                                    <li><span class="fa-li"><i class="fas fa-check-circle text-success"></i></span> Make informed investments</li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <h4>Financial Overview</h4>
                                <canvas id="financialChart"></canvas>
                            </div>
                        </div>
                        <hr>
                        <div class="text-center">
                            <button type="button" class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#loginModal">Get Started</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Developer Information -->
        <div class="row justify-content-center mt-5">
            <div class="col-lg-8">
                <div class="card shadow-lg developer-info" data-aos="fade-up" data-aos-duration="1500">
                    <div class="card-body text-center">
                        <img src="images/developer_photo.jpeg" alt="Developer Photo" class="rounded-circle mb-3" style="width: 150px;">
                        <h4>Developed by Sourav Sharma</h4>
                        <p class="text-muted">Full-Stack Developer | Financial Tech Enthusiast | Manipal University Jaipur</p>
                        <p>Roll No: 2214505923<br>Batch: 4 MCA</p>
                        <p>Sourav is a final-year student at Manipal University Jaipur, working on innovative projects to help people manage their finances effectively. With a passion for development and finance, Sourav creates user-friendly and scalable web applications.</p>
                        <a href="https://www.linkedin.com/in/sourav-sharma" target="_blank" class="btn btn-outline-primary btn-sm"><i class="fab fa-linkedin"></i> LinkedIn</a>
                        <a href="mailto:sourav.sharma@example.com" class="btn btn-outline-success btn-sm"><i class="fas fa-envelope"></i> Email</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Login and Signup Modal -->
    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="loginModalLabel" style="color: white;">Sign In to Your Account</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Login Form -->
                    <form id="loginForm" style="color: black;">
                        <div class="mb-3">
                            <label for="email" class="form-label">Username or Email address</label>
                            <input type="email" class="form-control" id="email" required placeholder="Enter your Username or Email address">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" required placeholder="Enter your Password">
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Log In</button>
                    </form>
                    <!-- Sign Up Button -->
                    <div class="signup-form mt-3">
                        <h6>New to FinTrack?</h6>
                        <button type="button" class="btn btn-outline-primary w-100" data-bs-dismiss="modal" aria-label="Close" onclick="window.location.href='signup.html'">Sign Up</button>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Include Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Initialize AOS animations -->
    <script>
        AOS.init();
    </script>

    <!-- Chart.js initialization -->
    <script>
        var ctx = document.getElementById('financialChart').getContext('2d');
        var financialChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Expenses', 'Savings', 'Investments'],
                datasets: [{
                    label: 'Financial Overview',
                    data: [50, 30, 20],
                    backgroundColor: ['#ff6384', '#36a2eb', '#cc65fe'],
                    borderColor: '#fff',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.label + ': ' + tooltipItem.raw + '%';
                            }
                        }
                    }
                }
            }
        });

        $(document).ready(function() {
            // Change navbar background color on scroll
            $(window).on('scroll', function() {
                if ($(window).scrollTop() > 50) {
                    $('.navbar').addClass('scrolled');
                } else {
                    $('.navbar').removeClass('scrolled');
                }
            });
        });
    </script>
</body>
</html>
