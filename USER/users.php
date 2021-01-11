<?php
    // $_SESSION["username"] = $row["User_Name"];
    // $_SESSION["fullname"]= $row["Full_Name"];
    session_start();
    $user = $_SESSION["username"];
    include '../connecting_database.php';
    $sql1 = "SELECT * from test_details";
    $result1 = mysqli_query($conn, $sql1);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php echo $user; ?>
    </title>
    <link rel="stylesheet" href="Assets/Css/style-user.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="../assets/CSS/users.css">
    <style>
        body{
            /* background-image: url("../assets/images/bg.jpeg"); */
            background-size: cover;
            background-repeat: no-repeat;
            /* text-align: center; */
            /* margin-top: 15%; */
        }
        #container{
            /* text-align: center; */
            display: block ;
            max-width: 90vw;
        }
        h2{
            color : rgb(2, 108, 149);
        }
        table, th, td {
            border: 1px solid black;
        }
        h3{
            text-align : center;
        }
    </style>
</head>
<body>

    <!-- <div class="sidenav">
        <a href='users.php'>TESTS</a><br><br>
        <a href="examportal.php">EXAM PORTAL</a><br><br>
        <a href="contactus.html">CONTACT US</a><br><br>
      </div> -->
    

      <div id = "container-menu">
        <div id="myNav" class="overlay">
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
            <div class="overlay-content">
                <a href="users.php">TESTS</a><br><br>
                <a href="examportal.php">EXAM PORTAL</a><br><br>
                <a href="contactus.php">CONTACT US</a><br><br>
            </div>
        </div>
        
        <span style="font-size:30px;cursor:pointer; color:blue; font-weight:bolder;" onclick="openNav()">&#9776; Menu</span>
    </div>



    <div id = "greetings" style="text-align: center;">
        <h1 style="font-weight:bolder;">Hello <?php echo $_SESSION["fullname"] ?> !</h1>
        <div id = "logout" style="text-align: right;">
            <button onclick="logout_user" class="w3-button w3-red">
                <a href="../logout.php">LOGOUT</a>
            </button>
        </div>
    </div>


    <!-- creating required arrays -->
    <?php
        $attempted = array();
        $notattempted = array();
        $upcoming = array();
        $live = array();
    ?>


    <div id = "container">
        <div id = "tests">

        <?php
            $i = 1;
            // test_details column
            while($row1 = mysqli_fetch_array($result1)) { ?>
                <?php
                    $testname = $row1['test_name'];
                    $sql2 = "SELECT * from user_tests WHERE test_name = '$testname' AND User_Name = '$user'";
                    $result2 = mysqli_query($conn, $sql2);
                    $row2 = mysqli_fetch_array($result2);
                ?>
                <?php
                    $starttime = $row1['start_time'];
                    $endtime = $row1['end_time'];
                    $submissiontime = $row2['submission_time'];
                    $marksobtained = $row2['user_marks'];

                    $uuser = $row2['User_Name'];
                    date_default_timezone_set('Asia/Kolkata');
                    $currenttime = date('Y-m-d H:i:s');

                    $correctresponse = $row1['correct_responses'];

                    // DEBUG
                    // echo $testname."<br>";
                    // echo $starttime."<br>";
                    // echo $endtime."<br>";
                    // echo $submissiontime."<br>";
                    // if($submissiontime == NULL) echo $testname."<br>";
                    // echo $currenttime."<br>";
                ?>

                <?php
                    // testname totalquestions totalmarks view-paper download-paper
                    $totalquestions = $row1['total_questions'];
                    $totalmarks = $row1['total_marks'];
                    $testfilepath = "../uploads/" . $row1['test_name'].".pdf";  
                    // echo $testname."<br>";
                    // echo $totalquestions."<br>";
                    // echo $totalmarks."<br>";
                    // echo $testfilepath."<br>";

                    if(($submissiontime != NULL) && ($submissiontime <= $endtime) && ($uuser == $user)){
                        // attempted 
                        $arr = array();
                        array_push($arr , $testname , $totalquestions , $totalmarks ,$marksobtained, $testfilepath,$correctresponse);
                        array_push($attempted , $arr);
                    }
                    if(($submissiontime == NULL) && ($currenttime > $endtime)){
                        // notattempted
                        $arr = array();
                        array_push($arr , $testname , $totalquestions , $totalmarks , $testfilepath);
                        array_push($notattempted , $arr);
                    }
                    if(($submissiontime === NULL) && ($starttime > $currenttime)){
                        // upcoming
                        $arr = array();
                        array_push($arr , $testname , $totalquestions , $totalmarks , $starttime, $endtime);
                        array_push($upcoming , $arr);
                    }
                    if(($submissiontime == NULL) && ($starttime <= $currenttime) && ($currenttime <= $endtime)){
                        // live
                        $arr = array();
                        array_push($arr , $testname , $totalquestions , $totalmarks , $testfilepath,$correctresponse);
                        array_push($live , $arr);
                    }

                ?>

            <?php } ?>


            <div id = "Live_tests">
                <h2 style="font-weight:bolder;"> TESTS LIVE</h2>
                <table class="w3-table-all">
                    <thead>
                        <tr class="w3-green">
                            <th><h3>#</h3></th>
                            <th><h3>Test Name</h3></th>
                            <th><h3>Total Questions </h3></th>
                            <th><h3>Total Marks</h3></th>
                            <th><h3>LINK</h3></th>
                            <!-- Subject to change on manual uploading -->
                            <!-- incorporate later -->
                            <!-- <th><h3>View Mistakes</h3></th> -->
                        </tr>
                    </thead>

                    <?php for ($i1 = 0; $i1 < count($live); $i1++) { ?>
                        <tr>
                            <?php 
                                $tname = $live[$i1][0];
                                $nques = $live[$i1][1];
                                $tmark = $live[$i1][2];
                                $tfpath = $live[$i1][3];
                                $cresponse = $live[$i1][4];

                                // echo $tname." ".$nques." ".$tmark. " ".$tfpath ;
                            ?>
                            <!-- continue -->
                            <td><span style="color: red; text-align:center;"><?php echo $i1+1; ?></span></td>
                            <td><span style="color: red; text-align:center;"><?php echo $tname; ?></span></td>
                            <td><span style="color: red; text-align:center;"><?php echo $nques; ?></span></td>
                            <td><span style="color: red; text-align:center;"><?php echo $tmark; ?></span></td>
                            <!-- Subject to change on manual uploading -->
                            <?php if($cresponse == "manually_entered_test_details"){ ?>
                                <td><a href="examsite.php"><span style="color: red;font-size:20px">Give Exam</span></a></td>
                            <?php } else { ?>
                                <td><a href="examportal.php"><span style="color: red;font-size:20px">Give Exam</span></a></td>
                            <?php } ?>
                        </tr>
                    <?php } ?>
                </table>
                </div>
                <br><br><br>
            <div id = "Attempted_tests">
                <h2 style="font-weight:bolder;">ATTEMPTED</h2>
                <table class="w3-table-all">
                    <thead>
                        <tr class="w3-cyan">
                            <th><h3>#</h3></th>
                            <th><h3>Test Name</h3></th>
                            <th><h3>Total Questions </h3></th>
                            <th><h3>Total Marks</h3></th>
                            <th><h3>Marks Obtained</h3></th>
                            <!-- Subject to change on manual uploading -->
                            <th><h3>View-Paper</h3></th>
                            <th><h3>Download-Paper</h3></th>
                            <th><h3>Test Analysis</h3></th>
                            <!-- incorporate later -->
                            <!-- <th><h3>View Mistakes</h3></th> -->
                        </tr>
                    </thead>

                    <?php for ($i1 = 0; $i1 < count($attempted); $i1++) { ?>
                        <tr >
                            <?php 
                                $tname = $attempted[$i1][0];
                                $nques = $attempted[$i1][1];
                                $tmark = $attempted[$i1][2];
                                $umarks = $attempted[$i1][3];
                                $tfpath = $attempted[$i1][4];
                                $cresponse = $attempted[$i1][5];

                                // echo $tname." ".$nques." ".$tmark. " ".$tfpath ;
                            ?>
                            <!-- continue -->
                            <td><span style="color: green; text-align:center;"><?php echo $i1+1; ?></span></td>
                            <td><span style="color: green; text-align:center;"><?php echo $tname; ?></span></td>
                            <td><span style="color: green; text-align:center;"><?php echo $nques; ?></span></td>
                            <td><span style="color: green; text-align:center;"><?php echo $tmark; ?></span></td>
                            <td><span style="color: green; text-align:center;"><?php echo $umarks; ?></span></td>
                            <!-- Subject to change on manual uploading -->
                            <?php if($cresponse == "manually_entered_test_details"){ ?>
                                <td><span style="color: green; text-align:center;">-</span></td>
                                <td><span style="color:green; text-align:center;">-</span></td>
                                <td><span style="color:green; text-align:center;"><a href="subjectiveanalysis.php?username=<?php echo $user; ?>&testname=<?php echo $tname; ?>" target="_blank" >Test Analysis</span></td>
                            <?php } else { ?>
                                <td><span style="color: green; text-align:center;"><a href="../uploads/<?php echo $tname.".pdf"; ?>" target="_blank">View</a></span></td>
                            <td><span style="color:green; text-align:center;"><a href="../uploads/<?php echo $tname.".pdf"; ?>" download>Download</span></td>
                            <td><span style="color:green; text-align:center;"><a href="analysis.php?username=<?php echo $user; ?>&testname=<?php echo $tname; ?>" target="_blank" >Test Analysis</span></td>
                            <?php } ?>
                            
                        </tr>
                        <?php } ?>

                </table>
            </div>
            <br><br><br>

            <div id = "Notattempted_tests">
                <h2 style="font-weight:bolder;">NOT ATTEMPTED TESTS</h2>
                <table class="w3-table-all">
                    <thead>
                        <tr class="w3-red">
                            <th><h3>#</h3></th>
                            <th><h3>Test Name</h3></th>
                            <th><h3>Total Questions </h3></th>
                            <th><h3>Total Marks</h3></th>
                            <!-- Subject to change on manual uploading -->
                            <th><h3>View-Paper</h3></th>
                            <th><h3>Download-Paper</h3></th>
                            <!-- incorporate later -->
                            <!-- <th><h3>View Mistakes</h3></th> -->
                        </tr>
                    </thead>

                    <?php for ($i1 = 0; $i1 < count($notattempted); $i1++) { ?>
                        <tr>
                            <?php 
                                $tname = $notattempted[$i1][0];
                                $nques = $notattempted[$i1][1];
                                $tmark = $notattempted[$i1][2];
                                $tfpath = $notattempted[$i1][3];

                                // echo $tname." ".$nques." ".$tmark. " ".$tfpath ;
                            ?>
                            <!-- continue -->
                            <td><?php echo $i1+1; ?></td>
                            <td><?php echo $tname; ?></td>
                            <td><?php echo $nques; ?></td>
                            <td><?php echo $tmark; ?></td>
                            <!-- Subject to change on manual uploading -->
                            <td><a href="../uploads/<?php echo $tname.".pdf"; ?>" target="_blank">View</a></td>
                            <td><a href="../uploads/<?php echo $tname.".pdf"; ?>" download>Download</td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
            <br><br><br>

                <h2 style="font-weight:bolder;">UPCOMING</h2>
                <table class="w3-table-all">
                    <thead>
                        <tr class="w3-blue">
                            <th><h3>#</h3></th>
                            <th><h3>Test Name</h3></th>
                            <!-- Subject to change on manual uploading -->
                            <th><h3>Start Time</h3></th>
                            <th><h3>End Time</h3></th>
                            <!-- incorporate later -->
                            <!-- <th><h3>View Mistakes</h3></th> -->
                        </tr>
                    </thead>
                    <?php for ($i1 = 0; $i1 < count($upcoming); $i1++) { ?>
                        <tr>
                            <?php 
                                $tname = $upcoming[$i1][0];
                                $nques = $upcoming[$i1][1];
                                $tmark = $upcoming[$i1][2];
                                $st = $upcoming[$i1][3];
                                $et = $upcoming[$i1][4];

                                // echo $tname." ".$nques." ".$tmark. " ".$tfpath ;
                            ?>
                            <!-- continue -->
                            <td><?php echo $i1+1; ?></td>
                            <td><?php echo $tname; ?></td>
                            <!-- Subject to change on manual uploading -->
                            <td><?php echo $st; ?></td>
                            <td><?php echo $et; ?></td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
            
        </div>
    </div>


    <!-- SCRIPTS -->
    <script src="../assets/JS/mynav.js"></script>
</body>
</html>