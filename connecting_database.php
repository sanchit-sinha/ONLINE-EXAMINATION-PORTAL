<?php
    $adminservername = "localhost";
    $adminusername = "root";
    $adminpassword = "";
    $admindbname = "examlive";


    $conn = mysqli_connect($adminservername , $adminusername , $adminpassword , $admindbname);
    if(!$conn){
        die("Connection failed");
    }
?>