<?php
    $userresponse = "|1a&|2d&||4d&|5b&|6a&|||9c&|10b&|11a&|12a&|13a&|";
    $correctresponse = "|1a&|2d&|3c&|4d&|5b&|6a&|7b&|8a&|9c&|10b&|11a&|12a&|13a&|";
    $tques = 13;

    echo $userresponse;
    echo "<br>";
    echo $correctresponse;

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

    echo "<br>";
    for($i = 0 ; $i < $tques ; $i++){
        echo $i." )";
        for($j = 0 ; $j < 4 ; $j++){
            echo $userresponsesheet[$i][$j]." ";
        }
        echo "<br>";
    }
    echo "<br>";
    echo "<br>";
    for($i = 0 ; $i < $tques ; $i++){
        echo $i." )";
        for($j = 0 ; $j < 4 ; $j++){
            echo $correctresponsesheet[$i][$j]." ";
        }
        echo "<br>";
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
            else {
                echo "ques ".$i;
                $qincorrect++;
            }
        }
    }

    echo $qcorrect."<br>";
    echo $qincorrect."<br>";
    echo $qleft."<br>";
?>