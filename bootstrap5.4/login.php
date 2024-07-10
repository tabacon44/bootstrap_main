<?php
session_start(); // Start session to manage user login state

// Check if the user is already logged in, redirect to index.php if true
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true){
    header('Location: index.php');
    exit;
}

// Include your database connection file (dbcon.php)
include('dbcon.php');

// Initialize variables to hold username and password
$username = $password = '';
$errors = array(); // Array to store validation errors

// Process login form submission
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

    // If no errors, attempt to authenticate user
    if(empty($errors)){
        $query = "SELECT * FROM users WHERE username = '$username'";
        $result = mysqli_query($conn, $query);

        if(mysqli_num_rows($result) === 1){
            $user = mysqli_fetch_assoc($result);
            if(password_verify($password, $user['password'])){
                // Password verification successful, set session variables
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $user['username'];
                $_SESSION['user_id'] = $user['id']; // You may adjust as per your database structure

                // Redirect to index.php or any other page after successful login
                header('Location: index.php');
                exit;
            } else {
                $errors['login'] = 'Invalid username or password';
            }
        } else {
            $errors['login'] = 'Invalid username or password';
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
    <style>
        body {
            background-color: #f8f9fa; /* Light gray background color */
            padding-top: 50px; /* Add padding to the top of the body */
        }
        .form-signin {
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
            margin-top: 10px; /* Added margin */
        }
        .btn-primary:hover {
            background-color: #0069d9;
            border-color: #0062cc;
        }
        .error {
            color: red;
            font-size: 14px;
            margin-top: 5px;
        }
    </style>
</head>
<body class="text-center">
    <form class="form-signin" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
        <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
        
        <?php if(isset($errors['login'])): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $errors['login']; ?>
            </div>
        <?php endif; ?>

        <label for="inputUsername" class="sr-only">Username</label>
        <input type="text" id="inputUsername" name="username" class="form-control" placeholder="Username" value="<?php echo htmlspecialchars($username); ?>" required autofocus>
        <div class="error"><?php echo isset($errors['username']) ? $errors['username'] : ''; ?></div>

        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
        <div class="error"><?php echo isset($errors['password']) ? $errors['password'] : ''; ?></div>

        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
        <a href="register.php" class="btn btn-lg btn-primary btn-block">Register</a> <!-- Added Register button -->
    </form>
</body>
</html>


