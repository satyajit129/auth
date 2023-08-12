<?php
require_once "config/db.php";

if (isset($_POST['login'])){
    $email = mysqli_real_escape_string($con,$_POST['email']);
    $password = mysqli_real_escape_string($con,$_POST['password']);

    $email_search = "SELECT * FROM signup WHERE email ='$email' LIMIT 1 ";
    $emailResult = mysqli_query($con, $email_search);

    $email_count = mysqli_num_rows($emailResult);

    if ($email_count) {
        $user_password = mysqli_fetch_assoc($emailResult);
        $db_pass = $user_password['password'];
        $password_decode = password_verify($password, $db_pass);
        if ($password_decode){
            echo "login successful";
        }else{
            echo "password incorrect";
        }
    }
    else{
        echo "invalid email";
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
            <form method="POST" action="login.php">
            <h2 class="text-center">Please Log In</h2>
                <div class="form-group mb-3">
                    <label>Email address</label>
                    <input type="email" class="form-control" name="email" placeholder="Enter email" required> 
                </div>
                <div class="form-group mb-3">
                    <label>Password</label>
                    <input type="password" class="form-control" name="password" placeholder="Password" required>
                </div>
                <button type="submit" name="login" class="btn btn-primary btn-sm">Submit</button>
                <br><label class="form-label">Forgot Password? No Worry <a href="recover_email.php">Click here to recover
                </a> </label>
            <br><label class="form-label">Don't Have an Account? <a href="signup.php">PLease Sign up </a> </label>
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