<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback - FinTrack</title>
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

    <!-- Header -->
    <header class="fixed-top bg-dark">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-dark">
                <a class="navbar-brand" href="#">
                    <img src="images/logo.png" alt="FinTrack Logo" height="40">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                </div>
            </nav>
        </div>
    </header>

    <!-- Feedback Form Section -->
    <section class="container mt-5 pt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h2 class="text-center mb-4">We Value Your Feedback</h2>
                <form action="backend/submit_feedback.php" method="POST" class="border p-4 rounded bg-light">
                    <div class="form-group row">
                        <label for="name" class="col-sm-4 col-form-label text-right">Name:</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Your Name" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-sm-4 col-form-label text-right">Email:</label>
                        <div class="col-sm-8">
                            <input type="email" class="form-control" id="email" name="email" placeholder="Your Email" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="message" class="col-sm-4 col-form-label text-right">Feedback:</label>
                        <div class="col-sm-8">
                            <textarea class="form-control" id="message" name="message" rows="4" placeholder="Your Feedback" required></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label text-right">Rating:</label>
                        <div class="col-sm-8">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="rating" id="rating1" value="1">
                                <label class="form-check-label" for="rating1">1</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="rating" id="rating2" value="2">
                                <label class="form-check-label" for="rating2">2</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="rating" id="rating3" value="3">
                                <label class="form-check-label" for="rating3">3</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="rating" id="rating4" value="4">
                                <label class="form-check-label" for="rating4">4</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="rating" id="rating5" value="5" checked>
                                <label class="form-check-label" for="rating5">5</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row justify-content-center">
                        <div class="col-sm-8 text-center">
                            <button type="submit" class="btn btn-primary btn-block">Submit Feedback</button>
                        </div>
                    </div>
                </form>
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

    <!-- JS and Bootstrap -->
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
