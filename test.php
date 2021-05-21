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
        echo "OLD";
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
        body {font-family: Arial, Helvetica, sans-serif;}
        * {box-sizing: border-box}

        /* Full-width input fields */
        input[type=text], input[type=password] {
        width: 100%;
        padding: 15px;
        margin: 5px 0 22px 0;
        display: inline-block;
        border: none;
        background: #f1f1f1;
        }

        input[type=text]:focus, input[type=password]:focus {
        background-color: #ddd;
        outline: none;
        }

        hr {
        border: 1px solid #f1f1f1;
        margin-bottom: 25px;
        }

        /* Set a style for all buttons */
        button {
        background-color: #4CAF50;
        color: white;
        padding: 14px 20px;
        margin: 8px 0;
        border: none;
        cursor: pointer;
        width: 100%;
        opacity: 0.9;
        }

        button:hover {
        opacity:1;
        }

        /* Extra styles for the cancel button */
        .cancelbtn {
        padding: 14px 20px;
        background-color: #f44336;
        }

        /* Float cancel and signup buttons and add an equal width */
        .cancelbtn, .signupbtn {
        float: left;
        width: 50%;
        }

        /* Add padding to container elements */
        .container {
        padding: 16px;
        }

        /* Clear floats */
        .clearfix::after {
        content: "";
        clear: both;
        display: table;
        }

        /* Change styles for cancel button and signup button on extra small screens */
        @media screen and (max-width: 300px) {
        .cancelbtn, .signupbtn {
            width: 100%;
        }
        }
</style>
</head>
<body>
   <div id = "container">
           <!-- change action -->
        <form action="test.php" style="border:1px solid #ccc">
        <div class="container">
            <h1>Sign Up</h1>
            <p>Please fill in this form to create an account.</p>
            <hr>

            <label for="UserName"><b>User Name</b></label>
            <input type="text" placeholder="Enter User Name" name="input_username" required>

            <label for="FullName"><b>Full Name</b></label>
            <input type="text" placeholder="Full Name" name="input_userfullname" required>

            <label for="psw"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="input_userpassword" required>

            <label for="psw-repeat"><b>Repeat Password</b></label>
            <input type="password" placeholder="Repeat Password" name="input_userpassword_again" required>
            
            <label>
            <input type="checkbox" checked="checked" name="remember" style="margin-bottom:15px"> Remember me
            </label>
            

            <div class="clearfix">
            <button type="button" class="cancelbtn">Cancel</button>
            <button type="submit" class="signupbtn">Sign Up</button>
            </div>
        </div>
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
                // header('Location: index.html');
                echo " fdg f g";
            }
        ?>
    </div> 

</body>
</html> 
