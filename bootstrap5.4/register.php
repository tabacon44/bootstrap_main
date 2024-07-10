<?php
    // Include your database connection file (dbcon.php)
    include('dbcon.php');

    // Initialize variables to hold username and password
    $username = $password = '';
    $errors = array(); // Array to store validation errors

    // Process registration form submission
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        // Sanitize user input to prevent SQL Injection
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);

        // Validate form inputs
        if(empty($username)){
            $errors['username'] = 'Username is required';
        }
        if(empty($password)){
            $errors['password'] = 'Password is required';
        }

        // If no errors, insert new user into database
        if(empty($errors)){
            // Hash the password for security
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Prepare and execute SQL insert statement
            $query = "INSERT INTO users (username, password) VALUES ('$username', '$hashed_password')";
            $result = mysqli_query($conn, $query);

            if($result){
                // Registration successful, redirect to login page
                header("Location: login.php");
                exit;
            } else {
                $errors['db_error'] = 'Failed to register user. Please try again later.';
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
    <style>
        body {
            background-color: #f8f9fa; /* Light gray background color */
            padding-top: 50px; /* Add padding to the top of the body */
        }
        .form-signup {
            max-width: 380px;
            padding: 15px;
            margin: auto;
        }
        .form-control {
            position: relative;
            box-sizing: border-box;
            height: auto;
            padding: 10px;
            font-size: 16px;
        }
        .form-control:focus {
            z-index: 2;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            padding: 10px 16px;
            font-size: 16px;
            font-weight: bold;
            margin-top: 10px; /* Add margin to the top */
        }
        .btn-primary:hover {
            background-color: #0069d9;
            border-color: #0062cc;
        }
        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
            padding: 10px 16px;
            font-size: 16px;
            font-weight: bold;
            margin-top: 10px; /* Add margin to the top */
        }
        .btn-secondary:hover {
            background-color: #5a6268;
            border-color: #545b62;
        }
        .error {
            color: red;
            font-size: 14px;
            margin-top: 5px;
        }
    </style>
</head>
<body class="text-center">
    <form class="form-signup" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
        <h1 class="h3 mb-3 font-weight-normal">Register New Account</h1>

        <?php if(isset($errors['db_error'])): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $errors['db_error']; ?>
            </div>
        <?php endif; ?>

        <label for="inputUsername" class="sr-only">Username</label>
        <input type="text" id="inputUsername" name="username" class="form-control" placeholder="Username" value="<?php echo htmlspecialchars($username); ?>" required autofocus>
        <div class="error"><?php echo isset($errors['username']) ? $errors['username'] : ''; ?></div>

        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
        <div class="error"><?php echo isset($errors['password']) ? $errors['password'] : ''; ?></div>

        <button class="btn btn-lg btn-primary btn-block" type="submit">Register</button>
        <a href="login.php" class="btn btn-lg btn-secondary btn-block">Go Back</a>
    </form>
</body>
</html>


