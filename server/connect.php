<?php
    $host = "localhost";
    $username = "root";
    $password ="";
    $database = "android_2";

    $conn = mysqli_connect($host,$username,$password,$database);
    mysqli_set_charset($conn, 'utf8');
?>