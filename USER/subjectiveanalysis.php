<?php 
    include '../connecting_database.php';

    $user=$_GET['username'];
    $tname=$_GET['testname'];

    // echo $tname;
    include '../connecting_database.php';
    
    $sql1 = "SELECT * from test_details WHERE test_name = '$tname'";
    $result1 = mysqli_query($conn, $sql1);
    $row1 = mysqli_fetch_array($result1);

    $tques = $row1['total_questions'];
    $tmarks = $row1['total_marks'];
    // echo $tques."<br>";

    $sql2 = "SELECT * from user_tests WHERE test_name = '$tname' AND User_Name = '$user'";
    $result2 = mysqli_query($conn, $sql2);
    $row2 = mysqli_fetch_array($result2);

    $userresponse = $row2['user_response'];
    // echo $userresponse;

    $umarks = $row2['user_marks']; 


    $correctresponsesheet = array();
    $userresponsesheet = array();

    for($i = 1 ; $i <= $tques ; $i++){
        $arr = array();
        array_push($arr , 0,0,0,0);
        array_push($userresponsesheet , $arr);
    }

    $index =0 ;
    $len =  strlen($userresponse);
        for($i = 1 ; $i < $len;$i++){
        if($userresponse[$i] == '&'){
            $c = $userresponse[$i - 1];
            if($c === 'a'){
                $userresponsesheet[$index][0] = 1;
            }
            else if($c === 'b'){
                $userresponsesheet[$index][1] = 1;
            }
            else if($c === 'c'){
                $userresponsesheet[$index][2] = 1;
            }
            else if($c === 'd'){
                $userresponsesheet[$index][3] = 1;
            }
        }        
        if($userresponse[$i] == '|') $index++;
    }
    
    // for($i = 0 ; $i < $tques ; $i++){
    //     for($j = 0 ; $j < 4 ; $j++){
    //         echo $userresponsesheet[$i][$j];
    //     }
    //     echo "<br>";
    // }

    $pmarks = array();
    $nmarks = array();
    for($i = 1;  $i <= $tques ;$i++){
        $sql3 = "SELECT * from manually_entered_test_details WHERE test_name = '$tname' AND question_number = '$i'";
        // echo $sql;
        $result3 = mysqli_query($conn , $sql3);

        $row3 = mysqli_fetch_array($result3);

        array_push($pmarks , $row3['positive_marks']);
        array_push($nmarks , $row3['negative_marks']);

        $correctresponse = $row3['correct_response'];

        $len = strlen($correctresponse);
        $arr = array();
        array_push($arr , 0 ,0 , 0, 0);
        
        for($j = 0 ; $j < $len ; $j++){
            if($correctresponse[$j] == 'a') $arr[0] = 1;
            if($correctresponse[$j] == 'b') $arr[1] = 1;
            if($correctresponse[$j] == 'c') $arr[2] = 1;
            if($correctresponse[$j] == 'd') $arr[3] = 1;
        }

        array_push($correctresponsesheet , $arr);
    }

    // for($i = 0 ; $i < $tques ; $i++){
    //     for($j = 0 ; $j < 4 ; $j++){
    //         echo $correctresponsesheet[$i][$j];
    //     }
    //     echo "<br>";
    // }



    $qcorrect = 0 ;
    $qincorrect = 0;
    $qleft = 0;
    for($i = 0 ; $i < $tques ; $i++){
        $left = 1;
        for($j = 0 ; $j < 4 ; $j++){
            if($userresponsesheet[$i][$j] == 1) $left = 0;
        }
        if($left == 1) $qleft++;
        else{
            $ok = 1 ;
            for($j = 0 ; $j < 4 ; $j++){
                if($userresponsesheet[$i][$j] != $correctresponsesheet[$i][$j]) $ok = 0;
            }
            if($ok == 1) $qcorrect++;
            else $qincorrect++;
        }
    }


    $class = array();
    for($i = 0; $i < $tques ; $i++){
        $left = 1;
        $correct = 1;
        for($j = 0 ; $j < 4 ; $j++){
            if($userresponsesheet[$i][$j] != 0) $left = 0;
            if($userresponsesheet[$i][$j] != $correctresponsesheet[$i][$j]) $correct = 0;
        }
        
        if($left == 1){
            array_push($class , 'w3-white');
        }
        else if($correct == 1){
            array_push($class , 'w3-green');
        }
        else{
            array_push($class , 'w3-red');
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Assets/Css/embededexam.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <title>TEST ANALYSIS</title>
    <style>
        #container{
            display : block;
            margin : auto;
            max-width : 60vw;
        }
        #main-analysis{
            display : block;
            margin : auto;
            max-width : 90vw;
        }
        table, th, td {
            border: 1px solid black;
        }
    </style>
</head>
<body>
<div id = "container">
            <table class = "w3-table-all">
                <thead>
                    <tr>
                        <th class = "w3-green"><p style="text-align: center; ">Test Name</p></th>
                        <th class = "w3-green"><p style="text-align: center;">Total Marks</p></th>
                        <th class = "w3-green"><p style="text-align: center;">Correct Questions</p></th>
                        <th class = "w3-green"><p style="text-align: center;">Incorrect Questions</p></th>
                        <th class = "w3-green"><p style="text-align: center;">Unattempted Questions</p></th>
                        <th class = "w3-green"><p style="text-align: center;">Marks Secured</p></th>
                    </tr>
                </thead>
                <tr>
                <td> <p style="text-align: center; "><?php echo $tname; ?></p> </td>
                <td> <p style="text-align: center; "><?php echo $tmarks; ?></p> </td>
                <td> <p style="text-align: center; "><?php echo $qcorrect; ?></p> </td>
                <td> <p style="text-align: center; "><?php echo $qincorrect; ?></p> </td>
                <td> <p style="text-align: center; "><?php echo $qleft; ?></p> </td>
                <td> <p style="text-align: center; "><?php echo $umarks; ?></p> </td>
                </tr>
            </table>

            <br><br>

        </div>
    <div class = "main">
        <?php 

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

        // if($left == 1){
        //     array_push($class , 'w3-white');
        // }
        // else if($correct == 1){
        //     array_push($class , 'w3-green');
        // }
        // else{
        //     array_push($class , 'w3-red');
        // }

        $cresponse = '';
        $uresponse  = '';
        
        if($correctresponsesheet[$i - 1][0] == 1) $cresponse = $cresponse."A ";
        if($correctresponsesheet[$i - 1][1] == 1) $cresponse = $cresponse."B ";
        if($correctresponsesheet[$i - 1][2] == 1) $cresponse = $cresponse."C ";
        if($correctresponsesheet[$i - 1][3] == 1) $cresponse = $cresponse."D ";


        if($userresponsesheet[$i - 1][0] == 1) $uresponse = $uresponse."A ";
        if($userresponsesheet[$i - 1][1] == 1) $uresponse = $uresponse."B ";
        if($userresponsesheet[$i - 1][2] == 1) $uresponse = $uresponse."C ";
        if($userresponsesheet[$i - 1][3] == 1) $uresponse = $uresponse."D ";
    $str = '
    <div class="container">
    <table class = "w3-table-all">
        <thead>';
        if($class[$i - 1] == 'w3-red') $str = $str.'<th class = "'.$class[$i - 1].'"><p style="text-align: center; ">WRONG</p></th>';
        else if($class[$i - 1] == 'w3-green') $str = $str.'<th class = "'.$class[$i - 1].'"><p style="text-align: center; ">CORRECT</p></th>';
        else if($class[$i - 1] == 'w3-white') $str = $str.'<th class = "'.$class[$i - 1].'"><p style="text-align: center; ">NOT ATTEMPTED </p></th>';
        $str  = $str .'</thead>
    </table>
    <br><br>
    <table class = "w3-table-all">
                <thead>
                    <tr>
                        <th class = "'.$class[$i - 1].'"><p style="text-align: center; ">User Response</p></th>
                        <th class = "'.$class[$i - 1].'"><p style="text-align: center;">Correct Response</p></th>
                    </tr>
                </thead>
                <tr class = "'.$class[$i - 1].'">
                <td > <p style="text-align: center; ">'.$uresponse.'</p> </td>
                <td> <p style="text-align: center; ">'.$cresponse.'</p> </td>
                </tr>
    </table>
            <br><br>
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
        </div>


        </div>
                
    </div><br><br><br><br><br>';

    echo $str;
}

        ?>

    </div>
</body>
</html>