<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Help & Support - FinTrack</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
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
        .accordion-button {
            background-color: #004d00;
            color: #ffffff;
        }
        .accordion-button:not(.collapsed) {
            color: #004d00;
            background-color: #d4edda;
        }
        .btn-primary {
            background-color: #004d00;
            border-color: #004d00;
        }
        .btn-primary:hover {
            background-color: #003300;
            border-color: #003300;
        }
    </style>
</head>
<body>
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
                <a class="nav-link active" href="help_support.php">Help Center</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="about_us.php">About Us</a>
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

<iframe src="chatbot.html" style="border:none; position:fixed; bottom:0; right:0; width:300px; height:400px; z-index:1000;"></iframe>

<div class="container mt-4">
    <h1>Help & Support</h1>

    <!-- FAQs -->
    <div class="mt-4">
        <h2>Frequently Asked Questions</h2>
        <div class="accordion" id="faqAccordion">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        How do I add a new transaction?
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        To add a new transaction, go to the Transactions page and click on the "Add New Transaction" button. Fill out the form with the transaction details and click "Submit".
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        How do I edit my profile information?
                    </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        To edit your profile information, go to the Settings page and update your personal details in the Profile Information section. Click "Update Profile" to save your changes.
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingThree">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        How do I change my password?
                    </button>
                </h2>
                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        To change your password, go to the Settings page and update your password in the Account Settings section. Enter your old password, new password, and confirm the new password. Click "Update Account" to save your changes.
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Contact Information -->
    <div class="mt-4">
        <h2>Contact Information</h2>
        <p>If you need further assistance, please contact our support team:</p>
        <ul>
            <li>Email: support@fintrack.com</li>
            <li>Phone: +123-456-7890</li>
        </ul>
    </div>

    <!-- Chat Support -->
    <div class="mt-4">
        <h2>Chat Support</h2>
        <p>Click the button below to start a chat with our support team:</p>
        <button class="btn btn-primary">Start Chat</button>
    </div>

    <!-- Submit a Support Ticket -->
    <div class="mt-4">
        <h2>Submit a Support Ticket</h2>
        <form id="supportTicketForm">
            <div class="mb-3">
                <label for="ticketSubject" class="form-label">Subject</label>
                <input type="text" id="ticketSubject" class="form-control">
            </div>
            <div class="mb-3">
                <label for="ticketDescription" class="form-label">Description</label>
                <textarea id="ticketDescription" class="form-control" rows="4"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit Ticket</button>
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

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
<script src="js/script.js"></script>
</body>
</html>
