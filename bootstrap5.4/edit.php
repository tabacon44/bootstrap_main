<?php
    // Include your database connection file (dbcon.php)
    include('dbcon.php');

    // Check if ID is set in the URL
    if(isset($_GET['ID'])){
        $ID = $_GET['ID'];

        // Check if the form is submitted
        if(isset($_POST['submit'])){
            // Get the form data
            $campus = $_POST['campus'];
            $FName = $_POST['FName'];
            $LName = $_POST['LName'];
            $amount = $_POST['amount'];
            $attended = $_POST['attended'];

            // Update the database
            $update = "UPDATE students SET campus = '$campus', FName = '$FName', LName = '$LName', amount = '$amount', attended = '$attended' WHERE ID = $ID";
            $result = mysqli_query($conn, $update);

            if($result){
                echo "<script>
                        window.alert('Updated Successfully');
                        window.location.href='student.php';
                        </script>";
            } else {
                echo "<script>
                        window.alert('Update Failed');
                      </script>";
            }
        } else {
            // Fetch the existing student data
            $sql = "SELECT * FROM students WHERE ID = $ID AND attended = 'NO'";
            $result = mysqli_query($conn, $sql);

            // Check if a row was returned
            if(mysqli_num_rows($result) > 0){
                $row = mysqli_fetch_assoc($result);
                $ID = $row['ID'];
                $campus = $row['campus'];
                $FName = $row['FName'];
                $LName = $row['LName'];
                $amount = $row['amount'];
                $attended = $row['attended'];
            } else {
                echo "<script>
                        window.alert('No student found or student has already attended');
                        window.location.href='student.php';
                      </script>";
                exit;
            }
        }
    } else {
        echo "<script>
                window.alert('No ID provided');
                window.location.href='student.php';
              </script>";
        exit;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
    <title>Update Student</title>
</head>
<body>
    <form method="POST">
        <div class="container d-flex justify-content-start mt-5">
            <h1>Update Student</h1>
        </div>
        <div class="container d-flex justify-content-center mt-5">
            <div class="form-group">
                <label for="ID">ID:</label>
                <input type="text" name="ID" value="<?php echo $ID; ?>" readonly>
            </div><br>
        </div>
        <div class="container d-flex justify-content-center mt-5">
            <div class="form-group">
                <label for="campus">Select Campus:</label>
                <select name="campus" id="campus">
                    <option value="UC-Main" <?php if($campus == 'UC-Main') echo 'selected'; ?>>UC-Main</option>
                    <option value="UC-Banilad" <?php if($campus == 'UC-Banilad') echo 'selected'; ?>>UC-Banilad</option>
                    <option value="UC-LM" <?php if($campus == 'UC-LM') echo 'selected'; ?>>UC-LM</option>
                    <option value="UC-PT" <?php if($campus == 'UC-PT') echo 'selected'; ?>>UC-PT</option>
                </select>
            </div>
        </div>
        <div class="container d-flex justify-content-center mt-5">
            <div class="form-group">
                <label for="FName">First Name:</label>
                <input type="text" name="FName" value="<?php echo $FName; ?>">
            </div><br>
        </div>
        <div class="container d-flex justify-content-center mt-5">
            <div class="form-group">
                <label for="LName">Last Name:</label>
                <input type="text" name="LName" value="<?php echo $LName; ?>">
            </div><br>
        </div>
        <div class="container d-flex justify-content-center mt-5">
            <div class="form-group">
                <label for="amount">Amount:</label>
                <input type="number" name="amount" value="<?php echo $amount; ?>">
            </div><br>
        </div>
        <div class="container d-flex justify-content-center mt-5">
            <div class="form-group">
                <label for="attended">Attended:</label>
                <select name="attended" id="attended">
                    <option value="YES" <?php if($attended == 'YES') echo 'selected'; ?>>Yes</option>
                    <option value="NO" <?php if($attended == 'NO') echo 'selected'; ?>>No</option>
                </select>
            </div><br>
        </div>
        <div class="container d-flex justify-content-end mt-5">
            <button class="btn btn-primary" type="submit" name="submit">Update Student</button>
        </div>
    </form>
    <div class="container d-flex justify-content-end mt-5">
        <a href="student.php"><button class="btn btn-danger">Go Back</button></a>
    </div>
</body>
</html>
