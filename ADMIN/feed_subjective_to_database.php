<?php 
    include '../connecting_database.php';
    if(isset($_POST['submit'])){
        // on submitting 
        $tqno = $_POST['total_qno'];
        $qno = $_POST['question_number'];
        $tname = $_POST['testname'];
        $pstatement = $_POST['questionvalue'];
        $ptype = $_POST['type_of_question'];
        $ptag = $_POST['tag_of_question'];
        $pmarks = $_POST['positive_marking_scheme'];
        $nmarks = $_POST['negative_marking_scheme'];
        $optiona = $_POST['optionvalue_a'];
        $optionb = $_POST['optionvalue_b'];
        $optionc = $_POST['optionvalue_c'];
        $optiond = $_POST['optionvalue_d'];

        $correctresponse='';

        // Loop to store and display values of individual checked checkbox.
        foreach($_POST['optionn'] as $selected){
            $correctresponse = $correctresponse.$selected;
        }

        $querymaxid = "SELECT SNo FROM manually_entered_test_details ORDER BY SNo DESC LIMIT 1";
        $result2 = mysqli_query($conn , $querymaxid);
        $Sno =  mysqli_fetch_array($result2)[0] + 1;

        // echo $tqno . "<br>";
        // exit()
        // echo $tname . "<br>";
        // echo $ptype . "<br>";
        // echo $ptag . "<br>";
        // echo $pstatement . "<br>";
        // echo $pmarks . "<br>";
        // echo $nmarks . "<br>";
        // echo $optiona . "<br>";
        // echo $optionb . "<br>";
        // echo $optionc . "<br>";
        // echo $optiond . "<br>";
        // echo $correctresponse . "<br>";
        // echo $Sno;
    //     // INSERT INTO `manually_entered_test_details` (`SNo`, `test_name`, `question_number`, `created_datetime`, `problem_type`, `problem_statement`, `problem_tag`, `positive_marks`, `negative_marks`, `optiona`, `optionb`, `optionc`, `optiond`, `correct_response`) VALUES ('1', 'hello', '1', current_timestamp(), 'mcq', 'mcq', 'as', '4', '-2', 'a', 'b', 'c', 'd', 'ab');

        $place1 = 'Q'.$qno;

        $sql1 = "SELECT * from manually_entered_test_details WHERE test_name = '$tname' AND question_number = '$qno'";
        $result1 = mysqli_query($conn, $sql1);
        if ($result1->num_rows == 0) {
            $insert = "INSERT INTO `manually_entered_test_details` (`SNo`, `test_name`, `question_number`, `created_datetime`, `problem_type`, `problem_statement`, `problem_tag`, `positive_marks`, `negative_marks`, `optiona`, `optionb`, `optionc`, `optiond`, `correct_response`) VALUES ('$Sno', '$tname', '$qno', current_timestamp(), '$ptype', '$pstatement', '$ptag', '$pmarks', '$nmarks', '$optiona', '$optionb', '$optionc', '$optiond', '$correctresponse');";
            if($conn->query($insert) == TRUE){
                $st = "question".$qno;
                $url = "front_subjective.php?$place1=inserted&testname1=$tname&questionnumber1=$tqno";
                header("Location: $url");
                
                // $msg = $qno." has been successfully added!";
                // echo "<script>alert('$msg');</script>";
               
            }
            else{
                $url = "front_subjective.php?$place1=notinserted&testname1=$tname&questionnumber1=$tqno";
                header("Location: $url");


                // $msg = $qno." Not inserted";
                // echo "<script>alert('$msg');</script>";
            } 

    } 
        else{
            $update = "UPDATE manually_entered_test_details SET  problem_type= '$ptype' , problem_statement= '$pstatement' , problem_tag= '$ptag' , positive_marks= '$pmarks' , negative_marks='$nmarks' , optiona='$optiona' , optionb='$optionb',optionc='$optionc',optiond='$optiond' , correct_response='$correctresponse' WHERE question_number = '$qno' AND test_name = '$tname'";
            if($conn->query($update) == TRUE){
                // $msg = $qno." has been successfully updated!";
                // echo "<script>alert('$msg');</script>";

                $url = "front_subjective.php?$place1=updated&testname1=$tname&questionnumber1=$tqno";
                header("Location: $url");
            }
            else{
                $msg = $qno." Notupdated";
                $url = "front_subjective.php?$place1=notupdated&testname1=$tname&questionnumber1=$tqno";
                header("Location: $url");
                
                // echo "<script>alert('$msg');</script>";
            } 
        }
        $conn->close();

    }
?>