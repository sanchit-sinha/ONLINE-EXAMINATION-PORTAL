<?php
    include '../connecting_database.php';
    // change sam92
    $sql1 = "SELECT * from user_tests WHERE User_Name = 'Sam92'";
    $result1 = mysqli_query($conn, $sql1);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <!-- change -->
        user
    </title>
    <link rel="stylesheet" href="Assets/Css/style-user.css">
    <style>
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
        <a href="testuser.html">TESTS</a><br><br>
        <a href="examportal.html">EXAM PORTAL</a><br><br>
      </div>

    <!-- <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; TESTS</span> -->

    <div id = "greetings" style="text-align: center;">
        <!-- change -->
        <h1>Hello user</h1>
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
            while($row1 = mysqli_fetch_array($result1)) { ?>
                <?php
                    $testname = $row1['test_name'];
                    $sql2 = "SELECT * from test_details WHERE test_name = '$testname'";
                    $result2 = mysqli_query($conn, $sql2);
                    $row2 = mysqli_fetch_array($result2)
                ?>
                <?php
                    $starttime = $row2['start_time'];
                    $endtime = $row2['end_time'];
                    $submissiontime = $row1['submission_time'];

                    date_default_timezone_set('Asia/Kolkata');
                    $currenttime = date('Y-m-d H:i:s');

                    // DEBUG
                    // echo $row2['start_time'];
                    // echo $endtime."<br>"; 
                    // if($submissiontime == NULL){
                    //     echo "got";
                    // }
                    // if($submissiontime <= $endtime){
                    //     echo "gotattemp";
                    // }
                    // echo $submissiontime."<br>"; 
                    // if($submissiontime != NULL and ($submissiontime <= $endtime)){
                    //     echo "got";
                    // }

                ?>

                <?php
                    // testname totalquestions totalmarks view-paper download-paper
                    $testname = $row1['test_name'];
                    $totalquestions = $row2['total_questions'];
                    $totalmarks = $row2['total_marks'];
                    $testfilepath = "../uploads/" . $row1['test_name'].".pdf";  

                    // echo $testname."<br>";
                    // echo $totalquestions."<br>";
                    // echo $totalmarks."<br>";
                    // echo $testfilepath."<br>";

                    if(($submissiontime != NULL) && ($submissiontime <= $endtime)){
                        // attempted
                        $arr = array();
                        array_push($arr , $testname , $totalquestions , $totalmarks , $testfilepath);
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
                <h2>ATTEMPTED</h2>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th><h3>#</h3></th>
                            <th><h3>Test Name</h3></th>
                            <th><h3>File Name</h3></th>
                            <th><h3>Total Questions </h3></th>
                            <th><h3>Total Marks</h3></th>
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
                                $tfpath = $attempted[$i1][3];
                            ?>

                            <!-- continue -->
                        </tr>
                        <?php } ?>
                </table>
            </div>
            <div id = "Notattempted_tests">
                <h2>NOT ATTEMPTED TESTS</h2>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th><h3>#</h3></th>
                            <th><h3>Test Name</h3></th>
                            <th><h3>File Name</h3></th>
                            <th><h3>Total Questions </h3></th>
                            <th><h3>Total Marks</h3></th>
                            <!-- Subject to change on manual uploading -->
                            <th><h3>View-Paper</h3></th>
                            <th><h3>Download-Paper</h3></th>
                            <!-- incorporate later -->
                            <!-- <th><h3>View Mistakes</h3></th> -->
                        </tr>
                    </thead>
                </table>
            </div>
            <div id = "Upcoming_tests">
                <h2>UPCOMING</h2>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th><h3>#</h3></th>
                            <th><h3>Test Name</h3></th>
                            <th><h3>File Name</h3></th>
                            <th><h3>Total Questions </h3></th>
                            <th><h3>Total Marks</h3></th>
                            <!-- Subject to change on manual uploading -->
                            <th><h3>View-Paper</h3></th>
                            <th><h3>Download-Paper</h3></th>
                            <!-- incorporate later -->
                            <!-- <th><h3>View Mistakes</h3></th> -->
                        </tr>
                    </thead>
                </table>
            </div>
            <div id = "Live_tests">
                <h2>TESTS LIVE</h2>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th><h3>#</h3></th>
                            <th><h3>Test Name</h3></th>
                            <th><h3>File Name</h3></th>
                            <th><h3>Total Questions </h3></th>
                            <th><h3>Total Marks</h3></th>
                            <!-- Subject to change on manual uploading -->
                            <th><h3>View-Paper</h3></th>
                            <th><h3>Download-Paper</h3></th>
                            <!-- incorporate later -->
                            <!-- <th><h3>View Mistakes</h3></th> -->
                        </tr>
                    </thead>
                </table>
            </div>
            
        </div>
    </div>



</body>
</html>