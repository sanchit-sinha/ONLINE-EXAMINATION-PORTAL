<?php 
    include '../connecting_database.php';

    $user=$_GET['username'];
    $tname=$_GET['testname'];

    // echo $tname;

    $sql1 = "SELECT * from test_details WHERE test_name = '$tname'";
    $result1 = mysqli_query($conn, $sql1);
    $row1 = mysqli_fetch_array($result1);

    $tques = $row1['total_questions'];
    $correctresponse = $row1['correct_responses'];
    $tmarks = $row1['total_marks'];
    // echo $tques."<br>";
    // echo $correctresponse."<br>";

    $sql2 = "SELECT * from user_tests WHERE test_name = '$tname' AND User_Name = '$user'";
    $result2 = mysqli_query($conn, $sql2);
    $row2 = mysqli_fetch_array($result2);

    $userresponse = $row2['user_response'];
    // echo $userresponse;


    $umarks = 0 ;
    $correctresponsesheet = array();
    $userresponsesheet = array();

    for($i = 1 ; $i <= $tques ; $i++){
        $arr = array();
        array_push($arr , 0,0,0,0);
        array_push($correctresponsesheet , $arr);
        array_push($userresponsesheet , $arr);
    }

    $len =  strlen($correctresponse);
    $index = 0;
    for($i = 1 ; $i < $len;$i++){
        if($correctresponse[$i] == '&'){
            $c = $correctresponse[$i - 1];
            if($c === 'a'){
                $correctresponsesheet[$index][0] = 1;
            }
            else if($c === 'b'){
                $correctresponsesheet[$index][1] = 1;
            }
            else if($c === 'c'){
                $correctresponsesheet[$index][2] = 1;
            }
            else if($c === 'd'){
                $correctresponsesheet[$index][3] = 1;
            }
        }        
        if($correctresponse[$i] == '|') $index++;
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

    // echo $qcorrect."<br>";
    // echo $qincorrect."<br>";
    // echo $qleft."<br>";

    $umarks = 4*$qcorrect - 2*$qincorrect;

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
    <title><?php echo $tname."-"; ?>ANALYSIS</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
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
        <div id = "main-analysis">
            <table class="w3-table-all">
                <thead>
                <tr>
                    <th class = "w3-cyan"><p style="text-align: center; font-size: larger;">Status</p></th>
                    <th class = "w3-cyan"><p style="text-align: center; font-size: larger;">QUESTION NUMBER</p></th>
                    <th class = "w3-cyan"><p style="text-align: center; font-size: larger;">USER RESPONSE</p></th>
                    <th class = "w3-cyan"><p style="text-align: center; font-size: larger;">CORRECT RESPONSE</p></th>
                </tr>
                </thead>
                <?php for($i = 0 ; $i < $tques ; $i++) { ?>
                    <tr class= '<?php echo $class[$i] ; ?>' >
                        <td> 
                            <p style="text-align: center; font-weight: bolder; font-size : 16px; ">
                                <?php 
                                    $left = 1;
                                    $correct = 1;
                                    for($j = 0 ; $j < 4 ; $j++){
                                        if($userresponsesheet[$i][$j] != 0) $left = 0;
                                        if($userresponsesheet[$i][$j] != $correctresponsesheet[$i][$j]) $correct = 0;
                                    }
                                    
                                    if($left == 1){
                                        echo "NOT ATTEMPTED";
                                    }
                                    else if($correct == 1){
                                        echo "CORRECT";
                                    }
                                    else{
                                        echo "WRONG";
                                    }
                                ?>
                            </p> 
                        </td>
                        <td> 
                            <p style="text-align: center; font-weight: bolder; font-size : 16px; ">
                                <?php echo "Q".($i + 1); ?>
                            </p> 
                        </td>
                        <td> 
                            <p style="text-align: center; font-weight: bolder; font-size : 16px;">
                                <?php 
                                    $left = 1;
                                    if($userresponsesheet[$i][0] == 1){
                                        $left = 0;
                                        echo "A  ";
                                    }
                                    if($userresponsesheet[$i][1] == 1){
                                        $left = 0;
                                        echo "B  ";
                                    }
                                    if($userresponsesheet[$i][2] == 1){
                                        $left = 0;
                                        echo "C  ";
                                    }
                                    if($userresponsesheet[$i][3] == 1){
                                        $left = 0;
                                        echo "D  ";
                                    }

                                    if($left == 1) echo "-";
                                ?>
                            </p> 
                        </td>
                        <td> 
                            <p style="text-align: center; font-weight: bolder; font-size : 16px;">
                                <?php 
                                    $left = 1;
                                    if($correctresponsesheet[$i][0] == 1){
                                        $left = 0;
                                        echo "A  ";
                                    }
                                    if($correctresponsesheet[$i][1] == 1){
                                        $left = 0;
                                        echo "B  ";
                                    }
                                    if($correctresponsesheet[$i][2] == 1){
                                        $left = 0;
                                        echo "C  ";
                                    }
                                    if($correctresponsesheet[$i][3] == 1){
                                        $left = 0;
                                        echo "D  ";
                                    }

                                    if($left == 1) echo "-";
                                ?>
                            </p> 
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </div>
</body>
</html>