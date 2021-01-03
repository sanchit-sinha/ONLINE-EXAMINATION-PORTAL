<?php
    $arr = array();
    $arr1 = array();

    array_push($arr , 1);
    array_push($arr , 2);
    array_push($arr , 3);
    array_push($arr , 5);
    
    array_push($arr1 , $arr);
    array_push($arr1 , $arr);

    // echo $arr1;

    // for ($i = 0; $i < count($arr); $i++) {
    //     echo $arr[$i]." ";
    // }

    for ($i = 0; $i < count($arr1); $i++) {
        for($j = 0; $j < count($arr1[$i]) ;$j++){
            echo $arr1[$i][$j] . "<br>";
        }
    }
    
?>