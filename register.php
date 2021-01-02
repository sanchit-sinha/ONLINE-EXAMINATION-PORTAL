<?php 
    $new_user_registerd = false;
    $user_already_exists = false;
    include 'connecting_database.php';  

    $inputusername = $_POST['input_username'];
    $inputuserpassword = $_POST['input_userpassword'];
    $inputuserfull_name = $_POST['input_userfullname'];
    $inputusermobilenumber = $_POST['input_usermobilenumber'];
    $isadmin = 0;
    $usercheck = "SELECT * from user_details WHERE User_Name = '$inputusername'";
    $result = $conn->query($usercheck);

    if ($result->num_rows > 0) {
        // echo "OLD";
        $user_already_exists = true;
    } 
    else{
        $insert = "INSERT INTO user_details VALUES ('$inputusername', '$inputuserpassword', '$inputuserfull_name', '$inputusermobilenumber', '$isadmin');";     
        if($conn->query($insert) == TRUE){
            $new_user_registerd = true;
            // echo '<script>alert("You have been successfully registered")</script>';
            // header("location:index.html"); 
        }
        else{
            echo "ERROR: $sql <br> $conn->error";
        } 
    }
    $conn->close();

 ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIGN UP</title>
    <style>
        body{
            text-align: center;
            /* margin-top: 10%; */
        }
        #input_userfullname, #input_usermobilenumber, #input_username ,#input_userpassword, #register_button, #signup, #login_button{
            padding-top: 26px;
            padding-bottom: 26px;
            padding-left: 40px;
            padding-right: 40px;
            /* margin: 8px; */
        }
        #goback{
            padding: 8px
            max-width : 20vw;
        }
        #container{
            /* margin-left: 40vw; */
            text-align: center;
            display: block ;
            max-width: 20vw;
        }
        #register_button, #login_button{
            width: 100%;
            position: relative;
        }
        button{
            cursor: pointer;
        }
    </style>
</head>
<body>
   <div id = "container" style="text-align: center;">
       <a href = "index.html">
         <button id ="goback">
            <p>LOGIN</p>
        </button>
        </a>    
        <form id = "signup_form" action="register.php" method="POST">
            <h1>SIGN UP</h1>
            <input id = "input_userfullname" type = "text" name = "input_userfullname" placeholder="Enter your Full Name" required> <br>
            <input id = "input_username" type = "text" name = "input_username" placeholder="Enter User Name" required> <br>
            <input id = "input_userpassword" type = "password" name = "input_userpassword" placeholder="Enter your password" required> <br>
            <input id = "input_usermobilenumber" type = "number" name = "input_usermobilenumber" placeholder="Enter your Mobile Number" required> <br>
            <button id = "register_button" type="submit">
                REGISTER 
            </button>
        </form>

        <?php 
            if($new_user_registerd == true){
                // echo" <div id = 'successfully_registered'> <br>";
                echo "You have been successfully registered <br>";
                echo "<script>document.getElementById('signup_form').style.display = 'none'</script>";
                include 'index.html';
                // echo" <form action='index.html' method='POST'> <br> <button id = 'login_button' type='submit'> LOGIN   </button>  </form> <br>";
                // echo "</div>";
            }
            if($user_already_exists == true){
                echo "User Name already exists";
            }
        ?>
    </div> 

</body>
</html> 
