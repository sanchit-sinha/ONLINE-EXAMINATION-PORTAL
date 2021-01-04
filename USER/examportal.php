<?php
    session_start();
    $user = $_SESSION["username"];
    $fname = $_SESSION["fullname"];
    include '../connecting_database.php';
    $sql1 = "SELECT * from user_tests WHERE User_Name = '$user'";
    $result1 = mysqli_query($conn, $sql1);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exam Portal</title>
    <link rel="stylesheet" href="Assets/Css/style-user.css">
    <style>
        #livetest{
            text-align: center;
            display: block ;
            /* max-width: 15vw; */
        }
    </style>
</head>
<body>
    <div class="sidenav">
        <!-- change -->
        <a href="users.php">TESTS</a><br><br>
        <a href="examportal.html">EXAM PORTAL</a><br><br>
      </div>

      <div id = "logout" style="text-align: right;">
            <button onclick="logout_user">
                <a href="../logout.php">LOGOUT</a>
            </button>
        </div>
    <div id = "livetest">
        <h1>Welcome to your Exam Portal!!</h1>
        <div id = "user_details" style="text-align:center; margin-left:40%;">
            <table class = "details">
            <thead>
                    <tr>
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
                        $tname = $row1['test_name'];
                        $sql2 = "SELECT * from test_details WHERE test_name = '$tname'";
                        $result2 = mysqli_query($conn, $sql2);
                        $row2 = mysqli_fetch_array($result2)
                    ?>

                    <?php
                        $starttime = $row2['start_time'];
                        $endtime = $row2['end_time'];
                        $submissiontime = $row1['submission_time'];

                        date_default_timezone_set('Asia/Kolkata');
                        $currenttime = date('Y-m-d H:i:s');
                    ?>
                    
                    <?php
                        if(($submissiontime == NULL) && ($starttime <= $currenttime) && ($currenttime <= $endtime)){ ?>
                            <td><?php echo $i++; ?></td>
                            <td><?php echo $user; ?></td>
                            <td><?php echo $tname; ?></td>
                            <td><?php echo $row2['total_questions']; ?></td>
                            <td><?php echo $row2['total_marks']; ?></td>
                    <?php } ?>
                </tr>
                <?php } ?>
                </tbody>
        </table>
        </div>
        
        
        <div id = "MAIN EXAM">
        <?php
            if(($submissiontime == NULL) && ($starttime <= $currenttime) && ($currenttime <= $endtime)){ ?>
                    <a href="../uploads/<?php echo $tname.".pdf"; ?>" target="_blank"><h1>View Question Paper</h1></a>
                    <a href="../uploads/<?php echo $tname.".pdf"; ?>" download><h1>Download Question Paper</h1></a>

                    <p id="demo"></p>
                    <?php
                        echo $endtime."<br>";
                        $split = date_parse_from_format('Y-m-d h:i:s', $endtime);
               
                        $yr1 = $split['year'];
                        $mnth1 = $split['month'];
                        $dy1 = $split['day'];
                        $hr1 = $split['hour'];
                        $sc1 = $split['second'];
                        $mn1 = $split['minute'];
                        $msc1 = 0;

                        $split2 = date_parse_from_format('Y-m-d h:i:s', $currenttime);
               
                        $yr2 = $split2['year'];
                        $mnth2 = $split2['month'];
                        $dy2 = $split2['day'];
                        $hr2 = $split2['hour'];
                        $sc2 = $split2['second'];
                        $mn2 = $split2['minute'];
                        $msc2 = 0;

                    ?>  
            <?php } ?>
        </div>
    </div>
    
    <script>
        // Set the date we're counting down to
        // var countDownDate = new Date("Jan 5, 2021 15:37:25").getTime();
        // var countDownDate = new Date(2018, 11, 24, 10, 33, 30, 0);
        var yrr = <?php echo $yr1; ?>;
        var mnthr = <?php echo $mnth1; ?>;
        var dyr = <?php echo $dy1; ?>;
        var hrr = <?php echo $hr1; ?>;
        var mnr = <?php echo $mn1; ?>;
        var scr = <?php echo $sc1; ?>;
        var countDownDate = new Date(yrr , mnthr , dyr , hrr , mnr , scr , 0 ).getTime();
        
        // Update the count down every 1 second
        var x = setInterval(function() {

        // Get today's date and time
        var yrr1 = <?php echo $yr2; ?>;
        var mnthr1 = <?php echo $mnth2; ?>;
        var dyr1 = <?php echo $dy2; ?>;
        var hrr1 = <?php echo $hr2; ?>;
        var mnr1 = <?php echo $mn2; ?>;
        var scr1 = <?php echo $sc2; ?>;
        var now = new Date(yrr1 , mnthr1 , dyr1 , hrr1 , mnr1 , scr1 , 0).getTime();
        // var now = new Date().getTime();
        // alert(countDownDate);
        // alert(now);
            
        // Find the distance between now and the count down date
        var distance = countDownDate - now;
            
        // Time calculations for days, hours, minutes and seconds
        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);
            
        // Output the result in an element with id="demo"
        document.getElementById("demo").innerHTML = days + "d " + hours + "h "
        + minutes + "m " + seconds + "s ";
            
        // If the count down is over, write some text 
        if (distance < 0) {
            clearInterval(x);
            document.getElementById("demo").innerHTML = "EXPIRED";
        }
        }, 1000);
    </script>
</body>
</html>