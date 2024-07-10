<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UC ICT Congress Registration System</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
    <style>
        body {
            background-color: #f8f9fa; /* Light gray background color */
            padding-top: 50px; /* Add padding to the top of the body */
        }
        .module-link {
            text-decoration: none; /* Remove underline from links */
            color: #333; /* Dark text color */
            transition: all 0.3s ease; /* Smooth transition for hover effects */
        }
        .module-link:hover {
            color: #007bff; /* Change text color to blue on hover */
        }
        .module-box {
            background-color: #fff; /* White background for module boxes */
            border-radius: 8px; /* Rounded corners */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Light shadow */
            padding: 20px; /* Padding inside the module boxes */
            text-align: center; /* Center align text inside boxes */
            margin-bottom: 20px; /* Bottom margin between boxes */
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col">
                <h1 class="mt-4">Choose your Transaction</h1>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="module-box">
                    <a href="student.php" class="module-link">
                        <h2>Review Students</h2>
                    </a>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="module-box">
                    <a href="search.php" class="module-link">
                        <h2>Attendance</h2>
                    </a>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="module-box">
                    <a href="raffle.php" class="module-link">
                        <h2>Raffle</h2>
                    </a>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="module-box">
                    <a href="report.php" class="module-link">
                        <h2>Report (By Campus)</h2>
                    </a>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="module-box">
                    <a href="summary.php" class="module-link">
                        <h2>Report (By Summary)</h2>
                    </a>
                </div>
            </div>
        </div>
        <!-- Add a new row for the logout button -->
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="module-box">
                    <a href="logout.php" class="module-link">
                        <h2>Logout</h2>
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

