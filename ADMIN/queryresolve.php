<?php 
    include '../connecting_database.php';

    $Sno = $_POST['queryno'];
    $fname = $_POST['fname'];

    $search = "SELECT * FROM user_details WHERE Full_Name = '$fname'";
    $result = mysqli_query($conn , $search);
    $row = mysqli_fetch_array($result);

    $user = $row['User_Name'];

    $vartime = "reply".$Sno;
    $reply = $_POST[$vartime];

    $resolved = 1;

    $sql = "UPDATE contactform SET resolved = '$resolved' , reply= '$reply' , User_Name='$user' WHERE SNo= '$Sno'";
 
    if(mysqli_query($conn , $sql)){
        header('Location: user_analysis.php');
    }
    else{
        echo '<script>alert("There was an error in resolving the query")</script>';
    }
?>