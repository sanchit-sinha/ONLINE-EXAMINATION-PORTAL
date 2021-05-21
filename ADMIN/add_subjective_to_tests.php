<?php 
    include '../connecting_database.php';
    $tname = $_POST['finaltestname'];
    $tques = $_POST['finalnumber_of_questions'];
    $stime = $_POST['finalstarttime'];
    $etime = $_POST['finalendtime'];

    $tmarks = 0 ;
    // echo $tname."<br>";
    // echo $tques."<br>";
    // echo $stime."<br>";
    // echo $etime."<br>";

    $sql1 = "SELECT * from manually_entered_test_details WHERE test_name = '$tname'";
    $result1 = mysqli_query($conn, $sql1);

    while($row = mysqli_fetch_array($result1)){
        $tmarks += $row['positive_marks'];
    }

    // echo $tmarks."<br>";
    $correctresponse = "manually_entered_test_details";
    $insert = "INSERT INTO `test_details` (`test_name`, `total_questions`, `total_marks`, `start_time`, `end_time`, `correct_responses`) VALUES('$tname', '$tques','$tmarks','$stime','$etime','$correctresponse')";
    // echo $insert;
    // exit();
    if(mysqli_query($conn , $insert) == true) header("Location: admin.php?st=success");
    else{
        header("Location: admin.php?st=error");
    }
?>