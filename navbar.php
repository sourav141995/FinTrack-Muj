<?php
// This file should be included in any PHP page where you need the navbar

// Start output buffering to include styles and avoid direct output
ob_start();
?>

<style>
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

</style>

<nav class="navbar navbar-expand-lg navbar-dark fixed-top">
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

<?php
// End output buffering and include styles
ob_end_flush();
?>
