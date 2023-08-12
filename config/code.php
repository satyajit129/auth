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
                $isChecked = 1;

                $insertQuery = "INSERT INTO signup (name, email, password, is_checked) VALUES ('$name', '$email', '$hashedPassword', '$isChecked')";
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
