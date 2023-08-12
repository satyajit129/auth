<?php
    $servername="localhost";
    $username="root";
    $password="";
    $databasename="auth";
    $con=mysqli_connect($servername,$username,$password,$databasename);
    if(!$con){
        echo "Database connection failed: " . mysqli_connect_error();
    }

?>