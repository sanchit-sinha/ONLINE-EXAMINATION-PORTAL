<?php
    include 'connecting_database.php';

    $loginusername = $_POST['username'];
    $loginuserpassword = $_POST['userpassword'];

    $sql = "SELECT * from user_details WHERE User_Name = '$loginusername'";
    $result = mysqli_query($conn, $sql);

    $convertpassword = password_hash($loginuserpassword , PASSWORD_BCRYPT);

    $ok = 0 ;
    while($row = mysqli_fetch_array($result)) { 
        if(password_verify($loginuserpassword , $row['Password'])) $ok = 1;
        if($ok == 1){
            session_start();
            $_SESSION["username"] = $row["User_Name"];
            $_SESSION["fullname"]= $row["Full_Name"];

            $isadmin = $row["isadmin"];
            $link = $user . ".php";
            if($isadmin == 0) header('Location: USER/users.php');
            else {
                header('Location: ADMIN/admin.php');
            }
        }
    } 
    if($ok == 0){
        echo "<h2 style='color:red; text-align:center;'>Invalid User Name or Password !!</h2><br>";
        include 'signup.html';
    }
    $conn->close();
?>