<?php 
    include 'connecting_database.php';  

    $inputusername = $_POST['input_username'];
    $inputuserpassword = $_POST['input_userpassword'];
    $inputuserfull_name = $_POST['input_userfullname'];
    $inputusermobilenumber = $_POST['input_usermobilenumber'];
    $isadmin = 0;

    // echo $inputusername."<br>";
    // echo $inputuserfull_name."<br>";
    // echo $inputuserpassword."<br>";
    // echo $inputusermobilenumber."<br>";

    

    $usercheck = "SELECT * from user_details WHERE User_Name = '$inputusername'";
    $result = $conn->query($usercheck);

    if ($result->num_rows > 0) {
        echo "User Name already exists !!";
        include 'index.html';
    } 
    else{
        $insert = "INSERT INTO user_details VALUES ('$inputusername', '$inputuserpassword', '$inputuserfull_name', '$inputusermobilenumber', '$isadmin');";     
        if($conn->query($insert) == TRUE){
            echo "User Name successfully registerd !";
            include 'index.html';
        }
        else{
            echo "Please try again !";
            include 'signup.html';
        } 
    }
    $conn->close();
?>
