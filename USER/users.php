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
    <style>
        body{
            background-image: url("../assets/images/bg.jpeg");
            background-size: cover;
            background-repeat: no-repeat;
            text-align: center;
            /* margin-top: 15%; */
        }
        #container{
            /* text-align: center; */
            display: block ;
            /* max-width: 15vw; */
        }
        h2{
            color : rgb(2, 108, 149);
        }
    </style>
</head>
<body>

    <div class="sidenav">
        <!-- change -->
        <a href='users.php'>TESTS</a><br><br>
        <a href="examportal.php">EXAM PORTAL</a><br><br>
      </div>

    <!-- <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; TESTS</span> -->

    <div id = "greetings" style="text-align: center;">
        <h1>Hello <?php echo $_SESSION["fullname"] ?></h1>
        <div id = "logout" style="text-align: right;">
            <button onclick="logout_user">
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
                        array_push($arr , $testname , $totalquestions , $totalmarks ,$marksobtained, $testfilepath);
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
                        array_push($arr , $testname , $totalquestions , $totalmarks , $testfilepath);
                        array_push($upcoming , $arr);
                    }
                    if(($submissiontime == NULL) && ($starttime <= $currenttime) && ($currenttime <= $endtime)){
                        // live
                        $arr = array();
                        array_push($arr , $testname , $totalquestions , $totalmarks , $testfilepath);
                        array_push($live , $arr);
                    }

                ?>

            <?php } ?>



            <div id = "Attempted_tests">
                <h2 style="text-align:left">ATTEMPTED</h2>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th><h3>#</h3></th>
                            <th><h3>Test Name</h3></th>
                            <th><h3>Total Questions </h3></th>
                            <th><h3>Total Marks</h3></th>
                            <th><h3>Marks Obtained</h3></th>
                            <!-- Subject to change on manual uploading -->
                            <th><h3>View-Paper</h3></th>
                            <th><h3>Download-Paper</h3></th>
                            <!-- incorporate later -->
                            <!-- <th><h3>View Mistakes</h3></th> -->
                        </tr>
                    </thead>

                    <?php for ($i1 = 0; $i1 < count($attempted); $i1++) { ?>
                        <tr>
                            <?php 
                                $tname = $attempted[$i1][0];
                                $nques = $attempted[$i1][1];
                                $tmark = $attempted[$i1][2];
                                $umarks = $attempted[$i1][3];
                                $tfpath = $attempted[$i1][4];

                                // echo $tname." ".$nques." ".$tmark. " ".$tfpath ;
                            ?>
                            <!-- continue -->
                            <td><span style="color: green;"><?php echo $i1+1; ?></span></td>
                            <td><span style="color: green;"><?php echo $tname; ?></span></td>
                            <td><span style="color: green;"><?php echo $nques; ?></span></td>
                            <td><span style="color: green;"><?php echo $tmark; ?></span></td>
                            <td><span style="color: green;"><?php echo $umarks; ?></span></td>
                            <!-- Subject to change on manual uploading -->
                            <td><span style="color: green;"><a href="../uploads/<?php echo $tname.".pdf"; ?>" target="_blank">View</a></span></td>
                            <td><span style="color: rgreened;"><a href="../uploads/<?php echo $tname.".pdf"; ?>" download>Download</span></td>
                        </tr>
                        <?php } ?>

                </table>
            </div>
            <div id = "Notattempted_tests">
                <h2 style="text-align:left">NOT ATTEMPTED TESTS</h2>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
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
                <h2 style="text-align:left">UPCOMING</h2>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
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
                    <?php for ($i1 = 0; $i1 < count($upcoming); $i1++) { ?>
                        <tr>
                            <?php 
                                $tname = $upcoming[$i1][0];
                                $nques = $upcoming[$i1][1];
                                $tmark = $upcoming[$i1][2];
                                $tfpath = $upcoming[$i1][3];

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
            <div id = "Live_tests">
                <h2 style="text-align:left"> TESTS LIVE</h2>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th><h3>#</h3></th>
                            <th><h3>Test Name</h3></th>
                            <th><h3>Total Questions </h3></th>
                            <th><h3>Total Marks</h3></th>
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

                                // echo $tname." ".$nques." ".$tmark. " ".$tfpath ;
                            ?>
                            <!-- continue -->
                            <td><span style="color: red;"><?php echo $i1+1; ?></span></td>
                            <td><span style="color: red;"><?php echo $tname; ?></span></td>
                            <td><span style="color: red;"><?php echo $nques; ?></span></td>
                            <td><span style="color: red;"><?php echo $tmark; ?></span></td>
                            <!-- Subject to change on manual uploading -->
                            <td><a href="examportal.php"><span style="color: red;">Give Exam</span></a><td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
            
        </div>
    </div>



</body>
</html>