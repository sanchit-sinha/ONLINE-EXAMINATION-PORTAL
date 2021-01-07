<?php
    include '../connecting_database.php';
    // fetch files
    $sql = "SELECT * FROM uploaded_test_details";
    $result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMIN</title>
    <link rel="stylesheet" href="Assets/Css/style-admin.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

    <style>
        body{
            background-image: url("../assets/images/bg.jpeg");
            background-size: cover;
            background-repeat: no-repeat;
            text-align: center;
            /* margin-top: 15%; */
        }
        #numberofquestions ,#testname, #enter_manually, #upload_pdf, #responsegenerator,#name_of_test{
            padding: 16px;
            /* margin: 8px; */
        }
        #container{
            display: block ;
            margin : auto;
            max-width: 80vw;
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
    </style>
</head>
<body>
    <div class="sidenav">
    <a href="../logout.php"> LOGOUT</a><br><br>
    <a href="admin.php">CREATE TESTS</a><br><br>
        <a href="user_analysis.php">USER ANALYSIS</a><br><br>
        <a href="preview_tests.php">PREVIEW TESTS</a><br><br>
      </div>

    <div id = "container">
    <div class="row">
            <div class="col-xs-8 col-xs-offset-2">
                <table class="table table-striped table-hover w3-table-all">
                    <thead>
                        <tr class = "w3-red"> 
                            <br><br>
                            <th><h3>#</h3></th>
                            <th><h3>Test Name</h3></th>
                            <th><h3>START TIME  </h3></th>
                            <th><h3>END TIME  </h3></th>
                            <th><h3>File Name</h3></th>
                            <th><h3>View</h3></th>
                            <th><h3>Download</h3></th>
                            <th><h3>CHANGE TEST</h3></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $i = 1;
                    while($row = mysqli_fetch_array($result)) { ?>
                    <?php 
                        $tname = $row['test_name'];
                        $sql2 = "SELECT * FROM test_details WHERE test_name = '$tname'";
                        $result2 = mysqli_query($conn, $sql2);

                        $row2 = mysqli_fetch_array($result2);
                        $stime = $row2['start_time'];
                        $etime = $row2['end_time']; 
                    ?>
                    <tr>
                        <td><?php echo $i++; ?></td>
                        <td><?php echo $row['test_name']; ?></td>
                        <td><?php echo $stime; ?></td>
                        <td><?php echo $etime;?></td>
                        <td><?php echo $row['file_name']; ?></td>
                        <td><a href="../uploads/<?php echo $row['file_name']; ?>" target="_blank">View</a></td>
                        <td><a href="../uploads/<?php echo $row['file_name']; ?>" download>Download</td>
                        <td>
                            
                        </td>
                    </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>  
</body>