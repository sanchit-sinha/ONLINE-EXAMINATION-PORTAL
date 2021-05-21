<?php

include '../connecting_database.php';
    session_start();
    $user = $_SESSION["username"];
    $fname = $_SESSION["fullname"];
    $tques =  $_SESSION['total_questions'];
    $tmarks= $_SESSION['total_marks'];
    $tname = $_SESSION['testname'];
    $correctresponse = $_SESSION['correctresponses'];

    // echo $user."<br>".$fname."<br>".$tques."<br>".$tmarks."<br>".$tname."<br>";
    $userresponse = "";
    for($i = 1 ; $i <= $tques ; $i++){
        if($i == 1){
            $userresponse = $userresponse."|";
        }
        $str1 = $i . "a";
        $str2 = $i . "b";
        $str3 = $i . "c";
        $str4 = $i . "d";
        
        if(isset($_POST[$str1])){
            $userresponse = $userresponse.$str1."&";
        }
        if(isset($_POST[$str2])){
            $userresponse = $userresponse.$str2."&";

        }
        if(isset($_POST[$str3])){
            $userresponse = $userresponse.$str3."&";

        }
        if(isset($_POST[$str4])){
            $userresponse = $userresponse.$str4."&";

        }
        $userresponse = $userresponse."|";
    }
    

    $umarks = 0 ;
    $correctresponsesheet = array();
    $userresponsesheet = array();

    for($i = 1 ; $i <= $tques ; $i++){
        $arr = array();
        array_push($arr , 0,0,0,0);
        array_push($correctresponsesheet , $arr);
        array_push($userresponsesheet , $arr);
    }

    // for($i = 1 ; $i < $tques ; $i++){
    //     for($j = 0 ; $j < 4 ; $j++){
    //         echo $userresponsesheet[$i][$j];
    //     }
    // }

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

    // echo "<br>";
    // for($i = 0 ; $i < $tques ; $i++){
    //     for($j = 0 ; $j < 4 ; $j++){
    //         echo $userresponsesheet[$i][$j]." ";
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

    // echo $qcorrect."<br>";
    // echo $qincorrect."<br>";
    // echo $qleft."<br>";


    $_SESSION['userans'] = $userresponsesheet;
    $_SESSION['correctans'] = $correctresponsesheet;

    $umarks = $qleft * 0 + $qcorrect * 4 - $qincorrect * 2;
    // INSERT INTO `user_tests` (`S No.`, `User_Name`, `test_name`, `submission_time`, `correct_questions`, `incorrect_questions`, `unattempted_questions`, `user_response`, `user_marks`) VALUES (NULL, 'Sam92', 'paper6', NULL, NULL, NULL, NULL, NULL, NULL);
    $querymaxid = "SELECT SNo FROM user_tests ORDER BY SNo DESC LIMIT 1";
    $result = mysqli_query($conn , $querymaxid);
    $Sno =  mysqli_fetch_array($result)[0] + 1;


    $sql = "INSERT INTO `user_tests` (`SNo`, `User_Name`, `test_name`, `correct_questions`, `incorrect_questions`, `unattempted_questions`, `user_response`, `user_marks`) VALUES ('$Sno', '$user', '$tname', '$qcorrect', '$qincorrect', '$qleft', '$userresponse', '$umarks');";
    if(mysqli_query($conn, $sql)){
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