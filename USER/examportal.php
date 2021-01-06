<?php
    session_start();
    $user = $_SESSION["username"];
    $fname = $_SESSION["fullname"];
    include '../connecting_database.php';
    $sql1 = "SELECT * from test_details";
    $result1 = mysqli_query($conn, $sql1);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exam Portal</title>
    <link rel="stylesheet" href="Assets/Css/style-user.css">
    <link rel="stylesheet" href="../assets/CSS/users.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <style>
        body{
            /* background-image: url("../assets/images/bg.jpeg"); */
            background-size: cover;
            background-repeat: no-repeat;
            /* text-align: center; */
            /* margin-top: 15%; */
        }
        #livetest{
            text-align: center;
            display: block ;
            /* max-width: 15vw; */
        }
        #submit{
            padding:10px;
            color:white;
            background-color:green;
        }
        input[type=checkbox] {
            transform: scale(2);
            -ms-transform: scale(2);
            -webkit-transform: scale(2);
            padding: 10px;
        }
        table, th, td {
            border: 1px solid black;
        }
    </style>
</head>
<body onload = "starttimer(); generate_responses();">
    <!-- <div class="sidenav">
        <a href="users.php">TESTS</a><br><br>
        <a href="examportal.php">EXAM PORTAL</a><br><br>
        <a href="contactus.html">CONTACT US</a><br><br>
      </div> -->
      <div id = "container-menu">
        <div id="myNav" class="overlay">
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
            <div class="overlay-content">
                <a href="users.php">TESTS</a><br><br>
                <a href="examportal.php">EXAM PORTAL</a><br><br>
                <a href="contactus.pph">CONTACT US</a><br><br>
            </div>
        </div>
        
        <span style="font-size:30px;cursor:pointer; color:blue; font-weight:bolder;" onclick="openNav()">&#9776; Menu</span>
    </div>



      <div id = "logout" style="text-align: right;">
            <button onclick="logout_user" class="w3-button w3-red">
                <a href="../logout.php">LOGOUT</a>
            </button>
        </div>
    <div id = "livetest">
        <h1>Welcome to your Exam Portal!!</h1>
        <div id = "user_details" style=" margin-left:8%; margin-right:1%;">
            <table class = "details w3-table-all">
            <thead>
                    <tr class = "w3-red">
                        <th><h3>#</h3></th>
                        <th><h3>User Name</h3></th>
                        <th><h3>Test Name </h3></th>
                        <th><h3>Total Questions</h3></th>
                        <th><h3>Total Marks</h3></th>
                        <!-- Subject to change on manual uploading -->
                    </tr>
            </thead>

            <tbody>
                <?php
                $i = 1;
                while($row1 = mysqli_fetch_array($result1)) { ?>
                <tr>
                    <?php
                        $sql2 = "SELECT * from user_tests WHERE test_name = '$testname'";
                        $result2 = mysqli_query($conn, $sql2);
                        $row2 = mysqli_fetch_array($result2);
                    ?>

                    <?php
                        
                        $stime = $row1['start_time'];
                        $etime = $row1['end_time'];
                        $submissiontime = $row2['submission_time'];
                        date_default_timezone_set('Asia/Kolkata');
                        $currenttime = date('Y-m-d H:i:s');
            
                    ?>
                
                    <?php
                        if(($submissiontime == NULL) && ($stime <= $currenttime) && ($currenttime <= $etime)){ ?>
                            <?php 
                                $tname = $row1['test_name'];
                                $tques = $row1['total_questions'];
                                $tmarks = $row1['total_marks'];
                                $correctresponse = $row1['correct_responses'];
                                
                                $starttime = $stime;
                                $endtime = $etime;
                            ?>

                            <td><?php echo $i++; ?></td>
                            <td><?php echo $user; ?></td>
                            <td><?php echo $tname; ?></td>
                            <td><?php echo $tques; ?></td>
                            <td><?php echo $tmarks; ?></td>
                    <?php } ?>
                </tr>
                <?php } ?>
                </tbody>
        </table>
        </div>
        
        <?php 
            $_SESSION['total_questions']=$tques;
            $_SESSION['total_marks']=$tmarks;
            $_SESSION['testname']=$tname;
            $_SESSION['correctresponses']=$correctresponse;
            // $_SESSION['variable_name']=variable_value;
        ?>
        
        <div id = "MAIN EXAM">
            <br><br><br><br>
        <?php
            if(($submissiontime == NULL) && ($starttime <= $currenttime) && ($currenttime <= $endtime)){ ?>
                    <a href="../uploads/<?php echo $tname.".pdf"; ?>" target="_blank"><h1>View Question Paper</h1></a>
                    <a href="../uploads/<?php echo $tname.".pdf"; ?>" download><h1>Download Question Paper</h1></a>

                    <br><br><br>
                    <h1 style = "color:red;" id="demo"></h1>
                    <?php
                        $split = date_parse_from_format('Y-m-d h:i:s', $endtime);
               
                        $yr1 = $split['year'];
                        $mnth1 = $split['month'];
                        $dy1 = $split['day'];
                        $hr1 = $split['hour'];
                        $sc1 = $split['second'];
                        $mn1 = $split['minute'];
                        $monthName = date('F', mktime(0, 0, 0, $mnth1, 10)); 

                        
                    ?>  

                    <form action="usersubmit.php" method="POST">
                        <h1>
                        <div id = "responsesheet" >

                        </div>
                        </h1>
                    </form>



                    <?php } ?>

        </div>
    </div>
    

    <!-- SCRIPTS -->
    <script src="../assets/JS/mynav.js"></script>
    <script>
        function starttimer(){
            // Set the date we're counting down to
            var countDownDate = new Date("<?php echo $monthName . " " . $dy1 . " ".",".$yr1 ." $hr1".":".$mn1.":".$sc1;?>").getTime();

            // Update the count down every 1 second
            var x = setInterval(function() {

            // Get today's date and time
            var now = new Date().getTime();

            // Find the distance between now and the count down date
            var distance = countDownDate - now;

            // Time calculations for days, hours, minutes and seconds
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            // Display the result in the element with id="demo"
            document.getElementById("demo").innerHTML = days + "d " + hours + "h "
            + minutes + "m " + seconds + "s ";

            // If the count down is finished, write some text
            if (distance < 0) {
                clearInterval(x);
                document.getElementById("demo").innerHTML = "EXPIRED";
                document.getElementById("responsesheet").style.display = "none";
            }
            }, 1000);
        }
        function generate_responses(){
            var n = <?php echo $tques; ?>;
            var str = "<h3>";
            for(i = 1 ; i <= Number(n) ; i++){
                if(i == 1){
                    str += "<p>USER RESPONSE SHEET:</p>";
                    str += "<p>Marking scheme for each question : [+4 , -2] </p>"
                }
                
                var num = i.toString();
                str += num;

                str += " : <input type=\"checkbox\" name=\""
                str += num
                str += "a\"" 
                str += "id = \"" 
                str += num 
                str += "a\">"

                str += " : <input type=\"checkbox\" name=\""
                str += num
                str += "b\"" 
                str += "id = \"" 
                str += num 
                str += "b\">"

                str += " : <input type=\"checkbox\" name=\""
                str += num
                str += "c\"" 
                str += "id = \"" 
                str += num 
                str += "c\">"

                str += " : <input type=\"checkbox\" name=\""
                str += num
                str += "d\"" 
                str += "id = \"" 
                str += num 
                str += "d\">" + "<br>"

            }
            str += "</h3>" ;
            str += "<button id = 'submit' onclick = 'calulate_respones();' class='w3-button w3-green'> SUBMIT  </button>";
            document.getElementById("responsesheet").innerHTML = str;
        }
    </script>
</body>
</html>