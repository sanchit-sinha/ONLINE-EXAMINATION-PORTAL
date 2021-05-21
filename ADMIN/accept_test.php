<?php 
    include '../connecting_database.php';

    $tname = $_GET['testname1'];
    $qno = $_GET['questionnumber1'];

    // echo $tname ."<br>";
    // echo $qno ;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

    <title>MANUAL TEST</title>
    <style>
        * {
        box-sizing: border-box;
        }

        input[type=text],input[type=number],input[type=datetime-local],          select, textarea {
        width: 100%;
        padding: 12px;
        border: 1px solid #ccc;
        border-radius: 4px;
        resize: vertical;
        }

        label {
        padding: 12px 12px 12px 0;
        display: inline-block;
        }

        input[type=submit] {
        background-color: #4CAF50;
        color: white;
        padding: 12px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        float: right;
        }

        input[type=submit]:hover {
        background-color: #45a049;
        }

        .container {
        border-radius: 5px;
        background-color: #f2f2f2;
        padding: 20px;
        max-width : 80vw;
        margin-left : 10vw;
        }

        .col-25 {
        float: left;
        width: 25%;
        margin-top: 6px;
        }

        .col-75 {
            float: left;
            width: 75%;
            margin-top: 6px;
        }
        .col-75text{
            float: left;
            width: 75%;
            margin-top: 6px;
            background-color : white;
            border: 1px solid #ccc;
            border-radius: 4px;
            resize: vertical;
        }

        /* Clear floats after the columns */
        .row:after {
        content: "";
        display: table;
        clear: both;
        }

        /* Responsive layout - when the screen is less than 600px wide, make the two columns stack on top of each other instead of next to each other */
        @media screen and (max-width: 600px) {
        .col-25, .col-75, .col-75text, input[type=submit] {
            width: 100%;
            margin-top: 0;
        }
        }
        /* The container */
        .containerr {
        display: block;
        position: relative;
        padding-left: 35px;
        margin-bottom: 12px;
        cursor: pointer;
        font-size: 22px;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        }

        /* Hide the browser's default checkbox */
        .containerr input {
        position: absolute;
        opacity: 0;
        cursor: pointer;
        height: 0;
        width: 0;
        }

        /* Create a custom checkbox */
        .checkmark {
        position: absolute;
        top: 0;
        left: 0;
        height: 25px;
        width: 25px;
        background-color: red;
        }

        /* On mouse-over, add a grey background color */
        .containerr:hover input ~ .checkmark {
        background-color: #ccc;
        }

        /* When the checkbox is checked, add a blue background */
        .containerr input:checked ~ .checkmark {
        background-color: #2196F3;
        }

        /* Create the checkmark/indicator (hidden when not checked) */
        .checkmark:after {
        content: "";
        position: absolute;
        display: none;
        }

        /* Show the checkmark when checked */
        .containerr input:checked ~ .checkmark:after {
        display: block;
        }

        /* Style the checkmark/indicator */
        .containerr .checkmark:after {
        left: 9px;
        top: 5px;
        width: 5px;
        height: 10px;
        border: solid white;
        border-width: 0 3px 3px 0;
        -webkit-transform: rotate(45deg);
        -ms-transform: rotate(45deg);
        transform: rotate(45deg);
    }
    .block {
  display: block;
  width: 100%;
  border: none;
  background-color: #4CAF50;
  color: white;
  padding: 28px 28px;
  font-size: 16px;
  cursor: pointer;
  text-align: center;
}

.block:hover {
  background-color: #ddd;
  color: black;
}
div {outline-color:black;}

.outset {
    outline-style: outset;
    padding  : 16px;
}

.form-inline {  
  display: flex;
  flex-flow: row wrap;
  align-items: center;
}

.form-inline label {
  margin: 5px 10px 5px 0;
}

.form-inline input {
  vertical-align: middle;
  margin: 5px 10px 5px 0;
  background-color: #fff;
  border: 1px solid #ddd;
}



@media (max-width: 800px) {
  .form-inline input {
    margin: 10px 0;
  }
  
  .form-inline {
    flex-direction: column;
    align-items: stretch;
  }
}
.w3-button {
    width:150px;
    margin-bottom : 175px;
    margin-left : 2px;
    margin-right : 2px;
}
</style>
<script type="text/javascript" src="http://latex.codecogs.com/latexit.js"></script>

</head>
<body>
    <div class = "container">
    <form action = "accept_test.php" method = "POST">
        <div class="row">
                <div class="col-25">
                    <label for="testname">TEST NAME : </label>
                    </div>
                    <div class="col-75">
                    <input type="text" id="testname" name="testname" placeholder="Name of Test" value = '<?php echo $tname;?>'  readonly>
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="question_no">NUMBER OF QUESTIONS: </label>
                    </div>
                    <div class="col-75">
                    <input type="text" id="number_of_questions" name="number_of_questions" placeholder="Number of Questions" value = '<?php echo $qno; ?>' readonly>
                </div>
            </div>
            </div>
            <button class = "block" id="submit"><h2>START CREATING TEST </h2></button>
        </form>
        <?php 
          $tname = $_POST['testname'];
          $tques = $_POST['number_of_questions'];

          date_default_timezone_set('Asia/Kolkata');
          $currenttime = date('Y-m-d H:i:s');

          $insert = "INSERT INTO `test_details` (`test_name`, `total_questions`, `total_marks`, `start_time`, `end_time`, `correct_responses`) VALUES('$tname', '$tques','0','$currenttime','$currenttime','-')";
          echo $insert;
          exit();
          if(mysqli_query($conn , $insert)){
            header("Location: accept_test.php?testname1=$tname&questionnumber1=$tques");
          }
          else{
            echo "<script>alert('Error adding test!!');</script>";
          }
        ?>
</body>
</html>