<?php 
    include '../connecting_database.php';

    if(isset($_POST['submit'])){

        session_start();

        $user = $_SESSION['username'];
        $fullname = $_POST['fullname'];
        $subject = $_POST['subject'];
        $query = $_POST['query'];

        // echo $fullname."<br>";
        // echo $subject."<br>";
        // echo $query."<br>";
        // echo $user;

        $resolved = 0 ;
        $querymaxid = "SELECT SNo FROM contactform ORDER BY SNo DESC LIMIT 1";
        $result = mysqli_query($conn , $querymaxid);
        $Sno =  mysqli_fetch_array($result)[0] + 1;

        $reply = '-';

        $sql = "INSERT INTO `contactform` (`SNo`, `User_Name`, `fullname`, `subject`, `query`, `resolved`, `reply`) VALUES ('$Sno', '$user', '$fullname', '$subject', '$query', '$resolved','$reply');";
        if(mysqli_query($conn, $sql)){
            include 'contactus.php';
            echo "<h3 style='color:green; text-align:center; font-weight:bolder;'>We will contact you shortly!!</h3><br>";
        }
        else{
            echo '<script>alert("There was an error in submitting the message")</script>';
        }

    }
?>