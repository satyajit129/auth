<?php
require_once "config/db.php";

if (isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = $_POST['password'];
    $confirmpassword = $_POST['confirmpassword'];

    $emailquery = "SELECT * FROM signup WHERE email = '$email'";
    $emailResult = mysqli_query($con, $emailquery);
    $emailcount = mysqli_num_rows($emailResult);

    if ($emailcount > 0) {
        echo "This email already exists.";
    } else {
        if ($password === $confirmpassword) {
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

            if (isset($_POST['checkout'])) {
                $insertQuery = "INSERT INTO signup (name, email, password) VALUES ('$name', '$email', '$hashedPassword')";
                if (mysqli_query($con, $insertQuery)) {
                    echo "Data inserted successfully.";
                } else {
                    echo "Error inserting data: " . mysqli_error($con);
                }
            } else {
                echo "Checkbox not checked. Data not inserted.";
            }
        } else {
            echo "Passwords do not match.";
        }
    }
}
?>






<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>log in Functionality</title>
    <link rel="stylesheet" href="vendor/fontawesome.css">
    <link rel="stylesheet" href="vendor/solid.css">
    <link rel="stylesheet" href="vendor/css/bootstrap.css">
    <link rel="stylesheet" href="vendor/css/owlcarousel/owl.carousel.min.css">
    <link rel="stylesheet" href="vendor/css/owlcarousel/owl.theme.default.min.css">
    <link rel="stylesheet" href="main.css">
</head>

<body>

    <div class="center-container bg-danger">
        <div class="signup col-6 bg-light p-4 border rounded">
            <form method="POST" action="signup.php">
            <h2 class="text-center">Please Sign Up</h2>
                <div class="form-group mb-3">
                    <label>Name</label>
                    <input type="text" class="form-control" name="name" placeholder="Enter Name" required>
                </div>
                <div class="form-group mb-3">
                    <label>Email address</label>
                    <input type="email" class="form-control" name="email" placeholder="Enter email" required> 
                </div>
                <div class="form-group mb-3">
                    <label>Password</label>
                    <input type="password" class="form-control" name="password" placeholder="Password" required>
                </div>
                <div class="form-group mb-3">
                    <label> Confirm Password</label>
                    <input type="password" class="form-control" name="confirmpassword" placeholder="Confirm Password" required>
                </div>
                <div class="form-group mb-3 form-check">
                    <input type="checkbox" name="checkout" class="form-check-input">
                    <label class="form-check-label">Check me out</label>
                </div>
                <button type="submit" name="submit" class="btn btn-primary btn-sm">Submit</button>
                <br>
                <label class="form-label">Have An Account? <a href="login.php">PLease log in </a> </label>
            </form>
        </div>
    </div>

    <script src="vendor/js/jquery-3.6.1.min.js"></script>
    <script src="vendor/js/bootstrap.js"></script>
    <script src="vendor/js/countup/jquery.counterup.min.js"></script>
    <script src="vendor/js/waypoints/jquery.waypoints.js"></script>
    <script src="vendor/js/owlcarousel/owl.carousel.min.js"></script>
    <script src="vendor/js/script.js"></script>
</body>

</html>