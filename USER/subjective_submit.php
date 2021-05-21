<?php 
    include '../connecting_database.php';
    session_start();
    $user = $_POST["usernamevalue"];
    $fname = $_POST["fullnamevalue"];
    $tques =  $_POST['totalquestionvalue'];
    // $tmarks= $_POST['total_marks'];
    $tname = $_POST['testnamevalue'];

    // comment
    // echo $user."<br>";
    // echo $fname."<br>";
    // echo $tques."<br>";
    // // echo $tmarks."<br>";
    // echo $tname."<br>";
    // // echo $_POST['ass'];

    $userresponsesheet = array();
    $correctresponsesheet = array();

    $pmarks = array();
    $nmarks = array();

    for($i = 1;  $i <= $tques ;$i++){
        $sql = "SELECT * from manually_entered_test_details WHERE test_name = '$tname' AND question_number = '$i'";
        // echo $sql;
        $result = mysqli_query($conn , $sql);

        $row = mysqli_fetch_array($result);

        array_push($pmarks , $row['positive_marks']);
        array_push($nmarks , $row['negative_marks']);

        $correctresponse = $row['correct_response'];
        // echo $correctresponses."<br>";

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

    // comment
    // for($i = 0 ; $i < $tques ; $i++){
    //     for($j = 0 ; $j < 4 ; $j++){
    //         echo $correctresponsesheet[$i][$j];
    //     }
    //     echo "<br>";
    // }


    for($i = 1;  $i <= $tques ;$i++){
        // Loop to store and display values of individual checked checkbox.
        $var = "optionn".$i;
        $userresponehere = "";
        foreach($_POST[$var] as $selected){
            $userresponehere = $userresponehere.$selected;
        }
        // echo $userrespone;
        $len = strlen($userresponehere);
        $arr = array();
        array_push($arr , 0 ,0 , 0, 0);
        
        for($j = 0 ; $j < $len ; $j++){
            if($userresponehere[$j] == 'a') $arr[0] = 1;
            if($userresponehere[$j] == 'b') $arr[1] = 1;
            if($userresponehere[$j] == 'c') $arr[2] = 1;
            if($userresponehere[$j] == 'd') $arr[3] = 1;
        }

        array_push($userresponsesheet , $arr); 
    }

    $userresponse = "|";
    for($i = 0 ; $i < $tques ; $i++){
        if($userresponsesheet[$i][0] == 1){
            $userresponse = $userresponse.'a'."&";
        }
        if($userresponsesheet[$i][1] == 1){
            $userresponse = $userresponse.'b'."&";

        }
        if($userresponsesheet[$i][2] == 1){
            $userresponse = $userresponse.'c'."&";

        }
        if($userresponsesheet[$i][3] == 1){
            $userresponse = $userresponse.'d'."&";
        }
        $userresponse = $userresponse."|";
    }
    // comment
    // for($i = 0 ; $i < $tques ; $i++){
    //     for($j = 0 ; $j < 4 ; $j++){
    //         echo $userresponsesheet[$i][$j];
    //     }
    //     echo "<br>";
    // }

    $umarks = 0 ;
    $qleft = 0 ;
    $qcorrect = 0;
    $qincorrect = 0;
    for($i = 0 ; $i < $tques ; $i++){
        // echo $pmarks[$i]." ".$nmarks[$i]."<br>";
        $left = 1;
        $correct = 0;
        $incorrect = 0;

        for($j = 0 ; $j < 4 ; $j++){
            if($userresponsesheet[$i][$j] == 1) $left = 0;
        }
        if($left == 1) $qleft++;
        else{
            $correct = 1;
            $ok = 1 ;
            for($j = 0 ; $j < 4 ; $j++){
                if($userresponsesheet[$i][$j] != $correctresponsesheet[$i][$j]) {
                    $ok = 0;
                    $correct = 0 ;
                    $incorrect = 1;
                }
            }
            if($ok == 1) $qcorrect++;
            else $qincorrect++;
        }
        $umarks = $umarks + $correct * $pmarks[$i] + $incorrect * $nmarks[$i] + $left*0;
    }

    // comment
    // echo $umarks;


    $querymaxid = "SELECT SNo FROM user_tests ORDER BY SNo DESC LIMIT 1";
    $result = mysqli_query($conn , $querymaxid);
    $Sno =  mysqli_fetch_array($result)[0] + 1;

    // comment 
    // echo $Sno;
    // exit();
    $sql1 = "INSERT INTO `user_tests` (`SNo`, `User_Name`, `test_name`, `correct_questions`, `incorrect_questions`, `unattempted_questions`, `user_response`, `user_marks`) VALUES ('$Sno', '$user', '$tname', '$qcorrect', '$qincorrect', '$qleft', '$userresponse', '$umarks');";
    if(mysqli_query($conn, $sql1)){
        // include 'users.php';
        $msg = "You have obtained ".$umarks." marks";
        echo "<script>alert('$msg');</script>";
        echo '<script type="text/javascript">'; 
            echo 'window.location.href = "users.php";';
        echo '</script>';
    }
    else{
        echo '<script>alert("There was an error in submitting the test")</script>';
    }

?>