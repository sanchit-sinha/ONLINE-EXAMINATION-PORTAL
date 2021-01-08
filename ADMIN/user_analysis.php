<?php 
     include '../connecting_database.php';

     $sql1 = "SELECT * from user_tests";
     $result1 = mysqli_query($conn, $sql1);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMIN</title>
    <link rel="stylesheet" href="Assets/Css/style-admin.css">
    <link rel="stylesheet" href="../assets/CSS/users.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <style>
        body{
            background-image: url("../assets/images/bg.jpeg");
            background-size: cover;
            background-repeat: no-repeat;
            /* margin-top: 15%; */
        }
        #numberofquestions ,#testname, #enter_manually, #upload_pdf, #responsegenerator,#name_of_test{
            padding: 16px;
            /* margin: 8px; */
        }
        #container{
            /* text-align: center; */
            display: block ;
            margin:auto;
            max-width: 84vw;
        }
        #signup , #login_button{
            width: 100%;
            position: relative;
        }
        button{
            cursor: pointer;
        }
        input[type=text], select {
        width: 100%;
        padding: 12px 20px;
        margin: 8px 0;
        display: inline-block;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
        }
        input[type=number], select {
        width: 100%;
        padding: 12px 20px;
        margin: 8px 0;
        display: inline-block;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
        }
        input[type=datetime-local], select {
        width: 100%;
        padding: 12px 20px;
        margin: 8px 0;
        display: inline-block;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
        }
        input[type=submit] {
        width: 100%;
        background-color: #4CAF50;
        color: white;
        padding: 14px 20px;
        margin: 8px 0;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        }

        input[type=submit]:hover {
        background-color: #45a049;
        }
        legend{
            text-align : center;
        }
        table, th, td {
            border: 1px solid black;
        }
    </style>
</head>
<body>
    <div id="myNav" class="overlay">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <div class="overlay-content">
            <a href="../logout.php"> LOGOUT</a><br><br>
            <a href="admin.php">CREATE TESTS</a><br><br>
            <a href="user_analysis.php">USER ANALYSIS</a><br><br>
            <a href="preview_tests.php">PREVIEW TESTS</a><br><br>
        </div>
      </div>

      <span style="font-size:30px;cursor:pointer; color:blue; font-weight:bolder;" onclick="openNav()">&#9776; Menu</span>

    <div id = "container">
    <h1  style = "text-align:center; font-weight:bolder"> SCORE CARD</h1>

        <table class = "w3-table-all">
            <thead>
                <tr>
                    <th class = "w3-green"><p style="text-align: center; font-size:16px; font-weight:bolder;">#</p></th>
                    <th class = "w3-green"><p style="text-align: center; font-size:16px; font-weight:bolder;">User Name</p></th>
                    <th class = "w3-green"><p style="text-align: center; font-size:16px; font-weight:bolder;">Test Name</p></th>
                    <th class = "w3-green"><p style="text-align: center; font-size:16px; font-weight:bolder;">Total Questions</p></th>
                    <th class = "w3-green"><p style="text-align: center; font-size:16px; font-weight:bolder;">Total Marks</p></th>
                    <th class = "w3-green"><p style="text-align: center; font-size:16px; font-weight:bolder;">Marks Scored</p></th>
                    <th class = "w3-green"><p style="text-align: center; font-size:16px; font-weight:bolder;">Correct Questions</p></th>
                    <th class = "w3-green"><p style="text-align: center; font-size:16px; font-weight:bolder;">Incorrect Questions</p></th>
                    <th class = "w3-green"><p style="text-align: center; font-size:16px; font-weight:bolder;">Unattempted Questions</p></th>
                    <th class = "w3-green"><p style="text-align: center; font-size:16px; font-weight:bolder;">View Paper</p></th>
                    <th class = "w3-green"><p style="text-align: center; font-size:16px; font-weight:bolder;">Complete Analysis</p></th>
                </tr>
            </thead>
            <?php
                $i = 1;
                while($row1 = mysqli_fetch_array($result1)) { ?>
                    <?php 
                        $user = $row1['User_Name'];
                        $tname = $row1['test_name'];
                        $umarks = $row1['user_marks'];
                        $qcorrect = $row1['correct_questions'];
                        $qincorrect = $row1['incorrect_questions'];
                        $qleft = $row1['unattempted_questions'];

                        $sql2 = "SELECT * from test_details WHERE test_name = '$tname'";
                        $result2 = mysqli_query($conn, $sql2);
                        $row2 = mysqli_fetch_array($result2);

                        $sql3 = "SELECT * from user_details WHERE User_Name = '$user'";
                        $result3 = mysqli_query($conn, $sql3);
                        $row3 = mysqli_fetch_array($result3);

                        $fname = $row3['Full_Name'];

                        $tques = $row2['total_questions'];
                        $tmmarks = $row2['total_marks'];
                    ?>
                    <tr>
                        <td><p style="text-align:center; font-size:16px; font-weight:bolder;"><?php echo $i++; ?></p></td>
                        <td><p style="text-align:center; font-size:16px; font-weight:bolder;"><?php echo $fname ;?></p></td>
                        <td><p style="text-align:center; font-size:16px; font-weight:bolder;"><?php echo $tname; ?></p></td>
                        <td><p style="text-align:center; font-size:16px; font-weight:bolder;"><?php echo $tques; ?></p></td>
                        <td><p style="text-align:center; font-size:16px; font-weight:bolder;"><?php echo $tmmarks; ?></p></td>
                        <td><p style="text-align:center; font-size:16px; font-weight:bolder;"><?php echo $umarks; ?></p></td>
                        <td><p style="text-align:center; font-size:16px; font-weight:bolder;"><?php echo $qcorrect; ?></p></td>
                        <td><p style="text-align:center; font-size:16px; font-weight:bolder;"><?php echo $qincorrect; ?></p></td>
                        <td><p style="text-align:center; font-size:16px; font-weight:bolder;"><?php echo $qleft; ?></p></td>
                        <td><p style="text-align:center; font-size:16px; font-weight:bolder;"><a href="../uploads/<?php echo $tname.".pdf"; ?>" target="_blank">View</a></p></td>
                        <td><p style="text-align:center; font-size:16px; font-weight:bolder;"><a href="../USER/analysis.php?username=<?php echo $user; ?>&testname=<?php echo $tname; ?>" target="_blank" >Complete Analysis</p></td>
                    </tr>
                <?php } ?>
        </table>
    </div>  
    <script src="../assets/JS/mynav.js"></script>

</body>

<?php
    include 'query.php';
?>