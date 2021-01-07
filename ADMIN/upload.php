<?php

include '../connecting_database.php';

//check if form is submitted
if (isset($_POST['submit']))
{
    $testname = $_POST['name_of_test2'];
    $filename = $_FILES['file1']['name'];
    $correctresponse = $_POST['display_correct_responses'];
    $total_questions = $_POST['no_ofques2'];
    $starttime = $_POST['starttime2'];
    $endtime = $_POST['endtime2'];
    $totalmarks = $_POST['total_marks2'];

    // echo $testname."<br>";
    // echo $filename."<br>";
    // echo $correctresponse."<br>";
    // echo $total_questions."<br>";
    // echo $starttime."<br>";
    // echo $endtime."<br>";
    // echo $totalmarks."<br>";

    // exit();

    //upload file
    if($filename != '')
    {
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $allowed = ['pdf', 'txt', 'doc', 'docx', 'png', 'jpg', 'jpeg',  'gif'];
    
        //check if file type is valid
        if (in_array($ext, $allowed))
        {
            $newname = $testname . ".pdf";
            // echo $newname."<br>";
            // echo $_FILES['file1']['tmp_name'] . "<br>";
            // echo $testname."<br>";
            // echo $filename."<br>";
            // echo $correctresponse."<br>";
            // echo $total_questions."<br>";
            // echo $starttime."<br>";
            // echo $endtime."<br>";
            // echo $totalmarks."<br>";    
            $path = '../uploads/';

            // if(move_uploaded_file($_FILES['file1']['tmp_name'],($path . $newname)) == true){
            //     echo "Moved!";
            // }
            // else{
            //     echo "Not Moved!";
            // }
            // exit();
            $querymaxid = "SELECT SNo FROM uploaded_test_details ORDER BY SNo DESC LIMIT 1";
            $result = mysqli_query($conn , $querymaxid);
            $Sno =  mysqli_fetch_array($result)[0] + 1;

            move_uploaded_file($_FILES['file1']['tmp_name'],($path . $newname));

            $sql = "INSERT INTO `uploaded_test_details` (`SNo`,`test_name`, `file_name`, `correct_response`) VALUES('$Sno','$testname', '$newname','$correctresponse')";
            mysqli_query($conn, $sql);
            $sql2 = "INSERT INTO `test_details` (`test_name`, `total_questions`, `total_marks`, `start_time`, `end_time`, `correct_responses`) VALUES('$testname', '$total_questions','$totalmarks','$starttime','$endtime','$correctresponse')";
            mysqli_query($conn, $sql2);
            header("Location: admin.php?st=success");
            
        }
        else
        {
            header("Location: admin.php?st=error");
        }
    }
    else
        header("Location: admin.php");
}
?>