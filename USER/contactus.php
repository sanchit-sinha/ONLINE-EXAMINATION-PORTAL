<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form</title>
    <link rel="stylesheet" href="Assets/Css/style-user.css">
    <link rel="stylesheet" href="../assets/CSS/users.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <style>
        body {font-family: Arial, Helvetica, sans-serif;}
        * {box-sizing: border-box;}

        input[type=text], select, textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            margin-top: 6px;
            margin-bottom: 16px;
            resize: vertical;
        }

        input[type=submit] {
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type=submit]:hover {
            background-color: #45a049;
        }

        .container {
            display: block;
            margin:auto;
            max-width: 80vw;
            position: relative;
            border-radius: 5px;
            background-color: #f2f2f2;
            padding: 20px;
        }
    </style>
</head>
<body>
    <div id="myNav" class="overlay">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <div class="overlay-content">
            <a href="users.php">TESTS</a><br><br>
            <a href="examportal.php">EXAM PORTAL</a><br><br>
            <a href="contactus.php">CONTACT US</a><br><br>
        </div>
      </div>
      
      <span style="font-size:30px;cursor:pointer; color:blue; font-weight:bolder;" onclick="openNav()">&#9776; Menu</span>

 

        <div class="container">
            <div id = "logout" style="text-align: right;">
                <button onclick="logout_user" class="w3-button w3-red">
                    <a href="../logout.php">LOGOUT</a>
                </button>
                <h1 style="text-align: left; font-weight: bolder;">CONTACT US</h1>       
            </div>

            <form action="contact.php" method="POST">
                <label for="fname">Full Name</label>
                <?php 
                    session_start();
                    $fname = $_SESSION["fullname"];
                ?>
                <input type="text" id="fullname" name="fullname" required value = '<?php echo $fname; ?>' readonly>

                <label for="subject">Subject</label>
                <input type="text" id="subject" name="subject" required placeholder="Write your subject here">
          
          
              <label for="Query">Query</label>
              <textarea id="query" name="query" required placeholder="Enter your query here." style="height:200px"></textarea>
          
              <input type="submit" name="submit" value="Submit">
            </form>
          </div>


          <script>
            function openNav() {
              document.getElementById("myNav").style.width = "40%";
            }
            
            function closeNav() {
              document.getElementById("myNav").style.width = "0%";
            }
            </script>
</body>
</html>

<?php
    echo "<br><br><br>";
    include 'queries.php';
?>