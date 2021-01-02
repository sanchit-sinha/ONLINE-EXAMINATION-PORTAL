<?php
    $adminservername = "localhost";
    $adminusername = "root";
    $adminpassword = "";
    $admindbname = "Online_Examination_System";

    $conn = mysqli_connect($adminservername , $adminusername , $adminpassword , $admindbname);
    if(!$conn){
        die("Connection failed due to 	");
    }
?>