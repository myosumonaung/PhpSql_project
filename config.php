<?php
    session_start(); // use for session
    ob_start(); // use for page navigation

    define('SITEURL', 'http://localhost/OS/');
    $sever_name = "localhost";
    $username = "root";
    $password = "";
    $dbname = "os_db";

    // Create connection in mysqli
    $conn = mysqli_connect($sever_name, $username, $password, $dbname);

    if ($conn) {
        // echo "connected";
    }else{
        die("Error on the connection".mysqli_error());
    }
?>