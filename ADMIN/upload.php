<?php

include '../connecting_database.php';

//check if form is submitted
if (isset($_POST['submit']))
{
    $testname = $_POST['testname'];
    $filename = $_FILES['file1']['name'];
    $correctresponse = $_POST['display_correct_responses'];

    echo $testname . "<br>";
    echo $filename . "<br>";
    echo $correctresponse . "<br>";

    exit();

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