<?php
    include 'connecting_database.php';

    $loginusername = $_POST['username'];
    $loginuserpassword = $_POST['userpassword'];

    $sql = "SELECT * from user_details WHERE User_Name = '$loginusername' AND Password = '$loginuserpassword'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $user = $row["User_Name"];
            $name = $row["Full_Name"];

            $isadmin = $row["isadmin"];
            if($isadmin == 0) include 'users.php';
            else {
                header('Location: ADMIN/admin.html');
            }
        }
    } 
    else{
        echo "<h2>Invalid User Name or Password </h2><br>";
        include 'invalid_user.html';
    }
    $conn->close();
?>