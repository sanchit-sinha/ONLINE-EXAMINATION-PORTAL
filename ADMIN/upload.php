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
    //upload file
    if($filename != '')
    {
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $allowed = ['pdf', 'txt', 'doc', 'docx', 'png', 'jpg', 'jpeg',  'gif'];
    
        //check if file type is valid
        if (in_array($ext, $allowed))
        {
            $path = '/opt/lampp/htdocs/ONLINE-EXAMINATION-PORTAL/uploads/';
            move_uploaded_file($_FILES['file1']['tmp_name'],($path . $testname));

            $sql = "INSERT INTO `Online_Examination_System`.`uploaded_test_details` (`test_name`, `file_name`, `correct_response`) VALUES('$testname', '$filename','$correctresponse')";
            mysqli_query($conn, $sql);
            $sql2 = "INSERT INTO `Online_Examination_System`.`test_details` (`test_name`, `total_questions`, `total_marks`, `start_time`, `end_time`, `correct_responses`) VALUES('$testname', '$total_questions','$totalmarks','$starttime','$endtime','$correctresponse')";
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