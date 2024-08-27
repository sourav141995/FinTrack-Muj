<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Goals - FinTrack</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
    /* Global Styles */
/* Internal CSS for Transactions page */

/* Navigation Bar Design Start */
.navbar {
    background-color: #004d40; /* Dark green background */
    padding: 1rem; /* Match padding */
    transition: background-color 0.3s;
    margin-bottom: 20px; /* Space below navbar */
    position: fixed; /* Fixes navbar to the top */
    top: 0; /* Aligns navbar to the top of the page */
    left: 0; /* Aligns navbar to the left edge */
    width: 100%; /* Full width */
    z-index: 1000; /* Ensures navbar is above other content */
}

.navbar:hover {
    background-color: #00332d; /* Darker green on hover */
}

.navbar-brand {
    font-size: 1.5rem; /* Match font size */
    color: #fff;
    display: flex;
    align-items: center;
}

.navbar-brand img {
    width: 40px; /* Match logo size */
    margin-right: 10px;
}

.navbar a {
    color: #fff;
    margin-left: 1rem; /* Spacing between links */
    transition: color 0.3s;
}

.navbar a:hover,
.navbar a.active {
    color: #aed581; /* Light green for active or hover */
}

.navbar .form-inline {
    display: flex;
    justify-content: center;
    flex-grow: 1;
}

.navbar .form-inline .form-control {
    width: 250px; /* Adjust width to match other pages */
    transition: width 0.3s ease-in-out;
}

.navbar .form-inline .form-control:focus {
    width: 300px; /* Expanded width on focus */
}

.navbar .btn-outline-light {
    color: #fff;
    border-color: #fff;
    margin-left: 8px;
}

.navbar .btn-outline-light:hover {
    color: #004d40;
    background-color: #aed581;
    border-color: #aed581;
}

/* Navigation Bar Link Styles */
.navbar-nav .nav-link {
    color: #fff;
    margin-left: 1rem; /* Spacing between nav links */
    transition: color 0.3s;
}

.navbar-nav .nav-link:hover,
.navbar-nav .nav-link.active {
    color: #aed581; /* Light green for active or hover */
}
/* Navigation Bar Design End */

/* Button Styles */
.btn-primary {
    background-color: #27ae60; /* Green color for primary buttons */
    border-color: #27ae60;
}

.btn-primary:hover {
    background-color: #2ecc71;
    border-color: #2ecc71;
}

.btn-secondary {
    background-color: #ecf0f1; /* Light color for secondary buttons */
    border-color: #bdc3c7;
}

.btn-secondary:hover {
    background-color: #bdc3c7;
    border-color: #aab7b8;
}

/* Table Styles */
.table {
    background-color: #fff; /* White background for table */
}

.table-striped tbody tr:nth-of-type(odd) {
    background-color: #f9f9f9; /* Light grey for striped rows */
}

/* Footer Design Start */
footer {
    background-color: #004d40;
    color: #fff;
    padding: 1rem; /* Match padding with navbar */
    text-align: center;
    margin-top: 2rem;
}

.footer-links a {
    color: #aed581;
    margin: 0 0.5rem;
    text-decoration: none;
}

.footer-links a:hover {
    text-decoration: underline;
}
/* Footer Design End */

/* Additional Styles */
.logo {
    max-width: 150px; /* Adjust the width as needed */
    height: auto;     /* Maintain aspect ratio */
}

.table th, .table td {
    text-align: center; /* Center-align text in table cells */
}

.card {
    border: 1px solid #ddd;
    border-radius: 8px;
}

.card-title {
    font-size: 1.25rem;
    margin-bottom: 1rem;
}

.btn-custom {
    background-color: #28a745;
    color: #ffffff;
}

.btn-custom:hover {
    background-color: #218838;
    color: #ffffff;
}

.form-control {
    border-radius: 0.25rem;
}
</style>
</head>
<body>

<!-- Navigation Bar -->
<nav class="navbar navbar-expand-lg navbar-dark">
    <a class="navbar-brand" href="index.php">
        <img src="images/FinTrack.png" alt="FinTrack Logo"> FinTrack
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav me-auto">
            <!-- Left side links -->
            <li class="nav-item">
                <a class="nav-link" href="dashboard.php">Dashboard</a>
            </li>
            <li class="nav-item">
            <li class="nav-item">
                <a class="nav-link active" href="goals.php">Goals</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="transactions.php">Transactions</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="reports.php">Reports</a>
            </li>
        </ul>
        <form class="d-flex mx-auto">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-light" type="submit">Search</button>
        </form>
        <ul class="navbar-nav ms-auto">
            <!-- Right side links -->
            <li class="nav-item">
                <a class="nav-link" href="index.php">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="help_support.php">Help Center</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="login_signup.php">Login</a>
            </li>
        </ul>
    </div>
</nav>

<!-- Feedback Modal -->
<iframe src="chatbot.html" style="border:none; position:fixed; bottom:0; right:0; width:300px; height:400px; z-index:1000;"></iframe>


<div class="container mt-4">
    <h1>Goals</h1>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <button class="btn btn-primary" data-toggle="modal" data-target="#addGoalModal">Add New Goal</button>
    </div>

    <!-- Filter Form -->
    <h3>Filter Goals</h3>
    <form id="filterForm">
        <div class="form-group">
            <label for="statusFilter">Status</label>
            <select class="form-control" id="statusFilter">
                <option value="">All</option>
                <option value="achieved">Achieved</option>
                <option value="pending">Pending</option>
            </select>
        </div>
        <div class="form-group">
            <label for="deadlineFilter">Deadline</label>
            <input type="date" class="form-control" id="deadlineFilter">
        </div>
        <button type="submit" class="btn btn-primary">Apply Filters</button>
    </form>

    <!-- Categories -->
    <h3 class="mt-4">Categories</h3>
    <div class="btn-group" role="group" aria-label="Goal Categories">
        <button type="button" class="btn btn-secondary">All</button>
        <button type="button" class="btn btn-secondary">Financial</button>
        <button type="button" class="btn btn-secondary">Health</button>
        <button type="button" class="btn btn-secondary">Personal Development</button>
    </div>

    <!-- Goal List -->
    <div class="container mt-4" id="goalList">
        <!-- Sample Goal Card -->
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">Emergency Fund</h5>
                <p class="card-text">Target Amount: $5000</p>
                <p class="card-text">Deadline: 2024-12-31</p>
                <div class="progress mb-2">
                    <div class="progress-bar bg-success" role="progressbar" style="width: 50%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">50%</div>
                </div>
                <button class="btn btn-success btn-sm" onclick="markAsAchieved(this)">Mark as Achieved</button>
                <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editGoalModal">Edit</button>
                <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteGoalModal">Delete</button>
            </div>
        </div>
    </div>

    <!-- Progress Overview -->
    <div class="container mt-4 progress-overview">
        <h3>Progress Overview</h3>
        <canvas id="goalsChart" width="400" height="200"></canvas>
    </div>

    <!-- Modals for Adding, Editing, and Deleting Goals -->
    
    <!-- Add Goal Modal -->
    <div class="modal fade" id="addGoalModal" tabindex="-1" aria-labelledby="addGoalModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addGoalModalLabel">Add New Goal</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="goalTitle" class="form-label">Goal Title</label>
                            <input type="text" class="form-control" id="goalTitle">
                        </div>
                        <div class="mb-3">
                            <label for="goalAmount" class="form-label">Target Amount</label>
                            <input type="number" class="form-control" id="goalAmount">
                        </div>
                        <div class="mb-3">
                            <label for="goalDeadline" class="form-label">Deadline</label>
                            <input type="date" class="form-control" id="goalDeadline">
                        </div>
                        <div class="mb-3">
                            <label for="goalCategory" class="form-label">Category</label>
                            <select class="form-control" id="goalCategory">
                                <option value="financial">Financial</option>
                                <option value="health">Health</option>
                                <option value="personal_development">Personal Development</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Save Goal</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Goal Modal -->
    <div class="modal fade" id="editGoalModal" tabindex="-1" aria-labelledby="editGoalModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editGoalModalLabel">Edit Goal</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="editGoalTitle" class="form-label">Goal Title</label>
                            <input type="text" class="form-control" id="editGoalTitle" value="Emergency Fund">
                        </div>
                        <div class="mb-3">
                            <label for="editGoalAmount" class="form-label">Target Amount</label>
                            <input type="number" class="form-control" id="editGoalAmount" value="5000">
                        </div>
                        <div class="mb-3">
                            <label for="editGoalDeadline" class="form-label">Deadline</label>
                            <input type="date" class="form-control" id="editGoalDeadline" value="2024-12-31">
                        </div>
                        <div class="mb-3">
                            <label for="editGoalCategory" class="form-label">Category</label>
                            <select class="form-control" id="editGoalCategory">
                                <option value="financial">Financial</option>
                                <option value="health">Health</option>
                                <option value="personal_development">Personal Development</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Goal Modal -->
    <div class="modal fade" id="deleteGoalModal" tabindex="-1" aria-labelledby="deleteGoalModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteGoalModalLabel">Delete Goal</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this goal?</p>
                    <button type="button" class="btn btn-danger">Delete</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>

</div> <!-- End of container -->

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

<!-- Optional JavaScript; choose one of the two! -->
<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- Chart.js for Goals Progress Overview -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Example chart script
    var ctx = document.getElementById('goalsChart').getContext('2d');
    var goalsChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Achieved', 'Pending'],
            datasets: [{
                label: '# of Goals',
                data: [3, 5],
                backgroundColor: ['#228B22', '#006400']
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Example script to mark a goal as achieved
    function markAsAchieved(button) {
        button.textContent = 'Achieved';
        button.classList.remove('btn-success');
        button.classList.add('btn-secondary');
    }
</script>
</body>
</html>
