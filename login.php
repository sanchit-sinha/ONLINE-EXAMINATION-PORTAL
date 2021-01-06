<?php
    include 'connecting_database.php';

    $loginusername = $_POST['username'];
    $loginuserpassword = $_POST['userpassword'];

    $sql = "SELECT * from user_details WHERE User_Name = '$loginusername' AND Password = '$loginuserpassword'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
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
    else{
        echo "<h2 style='color:red; text-align:center;'>Invalid User Name or Password !!</h2><br>";
        include 'signup.html';
    }
    $conn->close();
?>