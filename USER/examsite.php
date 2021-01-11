<?php 
    session_start();
    $user = $_SESSION["username"];
    $fname = $_SESSION["fullname"];
    include '../connecting_database.php';
    $sql1 = "SELECT * from test_details";
    $result1 = mysqli_query($conn, $sql1);;
    

    $i = 1;
    while($row1 = mysqli_fetch_array($result1)) { 
        $sql2 = "SELECT * from user_tests WHERE test_name = '$testname'";
        $result2 = mysqli_query($conn, $sql2);
        $row2 = mysqli_fetch_array($result2);
        
        $stime = $row1['start_time'];
        $etime = $row1['end_time'];
        $submissiontime = $row2['submission_time'];
        date_default_timezone_set('Asia/Kolkata');
        $currenttime = date('Y-m-d H:i:s');

        if(($submissiontime == NULL) && ($stime <= $currenttime) && ($currenttime <= $etime)){
                $tname = $row1['test_name'];
                $tques = $row1['total_questions'];
                $tmarks = $row1['total_marks'];
                $correctresponse = $row1['correct_responses'];
                
                $starttime = $stime;
                $endtime = $etime;
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <title>EXAML LIVE</title>

<style>
    body {margin:0;}

    .navbar {
    overflow: hidden;
    background-color: #333;
    position: fixed;
    top: 0;
    width: 100%;
    }
    input[type=checkbox] {
    transform: scale(2);
    -ms-transform: scale(2);
    -webkit-transform: scale(2);
    padding: 10px;
    }
    .navbar a {
    float: left;
    display: block;
    color: #f2f2f2;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
    font-size: 17px;
    }

    .navbar a:hover {
    background: #ddd;
    color: black;
    }

    .main {
    padding: 16px;
    margin-top: 75px;
    height: 1500px; /* Used in this example to enable scrolling */
    }
        * {
        box-sizing: border-box;
        }

        input[type=text],input[type=number], select, textarea {
        width: 100%;
        padding: 12px;
        border: 1px solid #ccc;
        border-radius: 4px;
        resize: vertical;
        }

        label {
        padding: 12px 12px 12px 0;
        display: inline-block;
        }

        input[type=submit] {
        background-color: #4CAF50;
        color: white;
        padding: 12px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        float: right;
        }

        input[type=submit]:hover {
        background-color: #45a049;
        }

        .container {
        border-radius: 5px;
        background-color: #f2f2f2;
        padding: 20px;
        max-width : 80vw;
        margin-left : 10vw;
        }

        .col-25 {
        float: left;
        width: 25%;
        margin-top: 6px;
        }

        .col-75 {
            float: left;
            width: 75%;
            margin-top: 6px;
        }
        .col-75text{
            float: left;
            width: 75%;
            margin-top: 6px;
            background-color : white;
            border: 1px solid #ccc;
            border-radius: 4px;
            resize: vertical;
        }

        /* Clear floats after the columns */
        .row:after {
        content: "";
        display: table;
        clear: both;
        }

        /* Responsive layout - when the screen is less than 600px wide, make the two columns stack on top of each other instead of next to each other */
        @media screen and (max-width: 600px) {
        .col-25, .col-75, .col-75text, input[type=submit] {
            width: 100%;
            margin-top: 0;
        }
        }
        /* The container */
        .containerr {
        display: block;
        position: relative;
        padding-left: 35px;
        margin-bottom: 12px;
        cursor: pointer;
        font-size: 22px;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        }

        /* Hide the browser's default checkbox */
        .containerr input {
        position: absolute;
        opacity: 0;
        cursor: pointer;
        height: 0;
        width: 0;
        }

        /* Create a custom checkbox */
        .checkmark {
        position: absolute;
        top: 0;
        left: 0;
        height: 25px;
        width: 25px;
        background-color: red;
        }

        /* On mouse-over, add a grey background color */
        .containerr:hover input ~ .checkmark {
        background-color: #ccc;
        }

        /* When the checkbox is checked, add a blue background */
        .containerr input:checked ~ .checkmark {
        background-color: #2196F3;
        }

        /* Create the checkmark/indicator (hidden when not checked) */
        .checkmark:after {
        content: "";
        position: absolute;
        display: none;
        }

        /* Show the checkmark when checked */
        .containerr input:checked ~ .checkmark:after {
        display: block;
        }

        /* Style the checkmark/indicator */
        .containerr .checkmark:after {
        left: 9px;
        top: 5px;
        width: 5px;
        height: 10px;
        border: solid white;
        border-width: 0 3px 3px 0;
        -webkit-transform: rotate(45deg);
        -ms-transform: rotate(45deg);
        transform: rotate(45deg);
    }
    .block {
  display: block;
  width: 50%;
  border: none;
  background-color: #4CAF50;
  color: white;
  padding: 14px 28px;
  font-size: 16px;
  cursor: pointer;
  text-align: center;
}

.block:hover {
  background-color: #ddd;
  color: black;
}
div {outline-color:black;}

.outset {
    outline-style: outset;
    padding  : 16px;
}

.form-inline {  
  display: flex;
  flex-flow: row wrap;
  align-items: center;
}

.form-inline label {
  margin: 5px 10px 5px 0;
}

.form-inline input {
  vertical-align: middle;
  margin: 5px 10px 5px 0;
  padding: 10px;
  background-color: #fff;
  border: 1px solid #ddd;
}



@media (max-width: 800px) {
  .form-inline input {
    margin: 10px 0;
  }
  
  .form-inline {
    flex-direction: column;
    align-items: stretch;
  }
}
.w3-button {
    width:150px;
    margin-bottom : 175px;
    margin-left : 2px;
    margin-right : 2px;
}
</style>
</head>

<body onload = "starttimer();">
<form action ="subjective_submit.php" method = "POST">


        <div class="navbar">
            <!-- <h1 style = "color : white; margin-left : 12px;"> EXAM LIVE </h1> -->
            <h1 style = "margin-left : 15%; color:red; text-align : center; display : inline-block" id="demo"></h1>
            <button class = "block" type="submit">SUBMIT </button>
        </div>

        <div class = "main">

        <input type = "text" style = "display : none ;" name = "testnamevalue" value = '<?php echo $tname; ?>' readonly;>
        <input type = "text" style = "display : none ;" name = "usernamevalue" value = '<?php echo $user; ?>' readonly;>
        <input type = "text" style = "display : none ;" name = "fullnamevalue" value = '<?php echo $fname; ?>' readonly;>
        <input type = "text" style = "display : none ;" name = "totalquestionvalue" value = '<?php echo $tques; ?>' readonly;>
            <?php 
                // echo $tname."<br>";
                // echo $tques."<br>";
                // echo $tmarks."<br>";
                // echo $correctresponse."<br>";
                // echo $starttime."<br>";
                // echo $endtime."<br>";


                $split = date_parse_from_format('Y-m-d h:i:s', $endtime);
        
                $yr1 = $split['year'];
                $mnth1 = $split['month'];
                $dy1 = $split['day'];
                $hr1 = $split['hour'];
                $sc1 = $split['second'];
                $mn1 = $split['minute'];
                $monthName = date('F', mktime(0, 0, 0, $mnth1, 10)); 

            
            
                $n = $tques;
                    for($i = 1 ; $i <= $n ; $i++){
                        $search =  "SELECT * from manually_entered_test_details WHERE question_number = '$i' AND test_name = '$tname'";
                        $result = mysqli_query($conn, $search);
                        $row = mysqli_fetch_array($result);

                        $pstatement = $row['problem_statement'];
                        $pmarks = $row['positive_marks'];
                        $nmarks = $row['negative_marks'];
                        $optiona = $row['optiona'];
                        $optionb = $row['optionb'];
                        $optionc = $row['optionc'];
                        $optiond = $row['optiond'];

                        // echo $pstatement."<br>";
                        // echo $pmarks."<br>";
                        // echo $nmarks."<br>";
                        // echo $optiona."<br>";
                        // echo $optionb."<br>";
                        // echo $optionc."<br>";
                        // echo $optiond."<br>";

                        $str = '
                        <div class="container">
                            <div class="outset">
                                <div class="row">
                                    <div class="col-25">
                                    <label for="question_no">Q'.$i.') </label>
                                    </div>
                                </div>
                            
                                

                                <div class="row">
                                    <div class="col-25">
                                    <label for="marking_scheme">Marking Scheme : </label>
                                    </div>
                                    <div class="col-75">
                                    <input type="text" style = "width:45%; text-align : center;" id="positive_marking_scheme" name="positive_marking_scheme" placeholder="Positive Marks" value = "+'.$pmarks.'" readonly >
                                    <input type="text" style = "width:45%; text-align : center;" id="negative_marking_scheme" name="negative_marking_scheme" placeholder="Negative Marks" value = "'.$nmarks.'" readonly >
                                    </div>
                                </div>
                                ';
                                    $len =  strlen($pstatement);
                                    $start = '<img src="http://latex.codecogs.com/gif.latex?' ; 
                                    $end = '" border="0"/>';
                                    $ques = '';
                                    for($j = 0 ; $j < $len ; $j++){
                                        if($pstatement[$j] != '$') $ques = $ques.$pstatement[$j];
                                        else{
                                            $j++;
                                            $ques = $ques.$start;
                                            while($pstatement[$j] != '$'){
                                                if($pstatement[$j] == '$') break;
                                                $ques = $ques.$pstatement[$j];
                                                $j++;
                                            }
                                            // output += '<br></div>';
                                            $ques =  $ques.$end;
                                        }
                                    }
                                    // echo $ques;
                                    $str = $str.'                           
                                    <div class = "row">
                                    <div class="col-25">
                                <label for="question">Question</label>
                                    </div>
                                    <div class="col-75text" style="height:200px">
                                        <p id = "previewquestion_'.$i.'" style = "text-align : left; color:black;">'.$ques.' </p>
                                    </div>
                                </div>';

                                $len =  strlen($optiona);
                                    $start = '<img src="http://latex.codecogs.com/gif.latex?' ; 
                                    $end = '" border="0"/>';
                                    $opa = '';
                                    for($j = 0 ; $j < $len ; $j++){
                                        if($optiona[$j] != '$') $opa = $opa.$optiona[$j];
                                        else{
                                            $j++;
                                            $opa = $opa.$start;
                                            while($optiona[$j] != '$'){
                                                if($optiona[$j] == '$') break;
                                                $opa = $opa.$optiona[$j];
                                                $j++;
                                            }
                                            // output += '<br></div>';
                                            $opa =  $opa.$end;
                                        }
                                    }

                                $str = $str . '<div class = "row">
                                        <div class="col-25">
                                        <h1>a)</h1> 
                                        </div>
                                        <div class="col-75text" style="height:100px; " name="previewoptionvalue_a"  >
                                            <p id = "previewoptionvalue_'.$i.'a" style = "text-align : left; color:black;">'.$opa.'</p>
                                        </div>
                                </div>';
                                // b

                                $len =  strlen($optionb);
                                    $start = '<img src="http://latex.codecogs.com/gif.latex?' ; 
                                    $end = '" border="0"/>';
                                    $opb = '';
                                    for($j = 0 ; $j < $len ; $j++){
                                        if($optionb[$j] != '$') $opb = $opb.$optionb[$j];
                                        else{
                                            $j++;
                                            $opb = $opb.$start;
                                            while($optionb[$j] != '$'){
                                                if($optionb[$j] == '$') break;
                                                $opb = $opb.$optionb[$j];
                                                $j++;
                                            }
                                            // output += '<br></div>';
                                            $opb =  $opb.$end;
                                        }
                                    }

                                $str = $str . '<div class = "row">
                                        <div class="col-25">
                                        <h1>b)</h1> 
                                        </div>
                                        <div class="col-75text" style="height:100px; " name="previewoptionvalue_b"  >
                                            <p id = "previewoptionvalue_'.$i.'b" style = "text-align : left; color:black;">'.$opb.'</p>
                                        </div>
                                </div>';
                                
                                // c
                                $len =  strlen($optionc);
                                    $start = '<img src="http://latex.codecogs.com/gif.latex?' ; 
                                    $end = '" border="0"/>';
                                    $opc = '';
                                    for($j = 0 ; $j < $len ; $j++){
                                        if($optionc[$j] != '$') $opc = $opc.$optionc[$j];
                                        else{
                                            $j++;
                                            $opc = $opc.$start;
                                            while($optionc[$j] != '$'){
                                                if($optionc[$j] == '$') break;
                                                $opc = $opc.$optionc[$j];
                                                $j++;
                                            }
                                            // output += '<br></div>';
                                            $opc =  $opc.$end;
                                        }
                                    }

                                $str = $str . '<div class = "row">
                                        <div class="col-25">
                                        <h1>c)</h1> 
                                        </div>
                                        <div class="col-75text" style="height:100px; " name="previewoptionvalue_c"  >
                                            <p id = "previewoptionvalue_'.$i.'c" style = "text-align : left; color:black;">'.$opc.'</p>
                                        </div>
                                </div>';

                                // d
                                $len =  strlen($optiond);
                                    $start = '<img src="http://latex.codecogs.com/gif.latex?' ; 
                                    $end = '" border="0"/>';
                                    $opd = '';
                                    for($j = 0 ; $j < $len ; $j++){
                                        if($optiond[$j] != '$') $opd = $opd.$optiond[$j];
                                        else{
                                            $j++;
                                            $opd = $opd.$start;
                                            while($optiond[$j] != '$'){
                                                if($optiond[$j] == '$') break;
                                                $opd = $opd.$optiond[$j];
                                                $j++;
                                            }
                                            // output += '<br></div>';
                                            $opd =  $opd.$end;
                                        }
                                    }

                                $str = $str . '<div class = "row">
                                        <div class="col-25">
                                        <h1>d)</h1> 
                                        </div>
                                        <div class="col-75text" style="height:100px; " name="previewoptionvalue_d"  >
                                            <p id = "previewoptionvalue_'.$i.'d" style = "text-align : left; color:black;">'.$opd.'</p>
                                        </div>
                                </div>';


                            $str = $str.'<br>
                            <div class = "row">
                                <div class="col-25">
                                </div>
                                <div class="col-75"  style = " font-size : 26px;">
                                <div class="form-check-inline">
                                <label class="form-check-label" for="check1">
                                    <input type="checkbox" class="form-check-input" name="optionn'.$i.'[]" value = "a"  >a
                                </label>
                                </div>
                                <div class="form-check-inline">
                                <label class="form-check-label" for="check1">
                                    <input type="checkbox" class="form-check-input" name="optionn'.$i.'[]" value = "b"  >b
                                </label>
                                </div>
                                <div class="form-check-inline">
                                <label class="form-check-label" for="check1">
                                    <input type="checkbox" class="form-check-input" name="optionn'.$i.'[]" value = "c"  >c
                                </label>
                                </div>
                                <div class="form-check-inline">
                                <label class="form-check-label" for="check1">
                                    <input type="checkbox" class="form-check-input" name="optionn'.$i.'[]" value = "d"  >d
                                </label>
                                </div>
                                    
                                </div>
                            </div>


                            </div>
                                    
                        </div><br><br><br><br><br>';

                        echo $str;
                    }
                ?>
        </div>
    </form>

    
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
        </script>
</body>
</html>