<?php
    include '../connecting_database.php';
    session_start();
    $user = $_SESSION['username'];

    $sql = "SELECT * FROM contactform WHERE User_Name = '$user'";
    $result = mysqli_query($conn , $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form</title>
    <link rel="stylesheet" href="Assets/Css/style-user.css">
    <link rel="stylesheet" href="../assets/CSS/users.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <style>
        body {font-family: Arial, Helvetica, sans-serif;}
        * {box-sizing: border-box;}

        input[type=text], select, textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            margin-top: 6px;
            margin-bottom: 16px;
            resize: vertical;
        }

        input[type=submit] {
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type=submit]:hover {
            background-color: #45a049;
        }

        .container {
            display: block;
            margin:auto;
            max-width: 80vw;
            position: relative;
            border-radius: 5px;
            background-color: #f2f2f2;
            padding: 20px;
        }
        #query-table{
            display : block;
            margin : auto;
            max-width : 90vw;
        }
        table, th, td {
            border: 1px solid black;
        }
    </style>
</head>
<body>

        <div id = "query-table">
            <br><br>
            <h1  style = "text-align:center; font-weight:bolder"> QUERY-RECORDS</h1>
            <table class = "w3-table-all">
                <thead>
                    <tr>
                        <th class = "w3-blue"><p style="text-align: center;">STATUS</p></th>
                        <th class = "w3-blue"><p style="text-align: center; ">QUERY NO.</p></th>
                        <th class = "w3-blue"><p style="text-align: center; ">TIME STAMP</p></th>
                        <th class = "w3-blue"><p style="text-align: center;">SUBJECT</p></th>
                        <th class = "w3-blue"><p style="text-align: center;">QUERY</p></th>
                        <th class = "w3-blue"><p style="text-align: center;">RESPONSE</p></th>
                    </tr>
                </thead>
                <?php
                    $i = 1;
                    while($row = mysqli_fetch_array($result)){
                ?>
                    <?php 
                        $subject = $row['subject'];
                        $query = $row['query'];
                        $querytime = $row['query_date'];
                        
                        $status = $row['resolved'];
                        $reply = $row['reply'];

                        // echo $subject."<br>";
                        // echo $query."<br>";
                        // echo $querytime."<br>";
                        // echo $status."<br>";

                        $class = array();
                        array_push($class , 'w3-red' , 'w3-green');
                    ?>

                    <tr class= '<?php echo $class[$status] ; ?>'>
                        <td>
                            <p style="text-align: center; font-weight: bolder; font-size : 16px; ">
                                <?php 
                                     if($status == 1){
                                         echo "RESOLVED\n";
                                     }
                                     else echo "NOT RESOLVED";
                                ?>
                            </p>
                        </td>
                        <td>
                            <p style="text-align: center; font-weight: bolder; font-size : 16px; ">
                                <?php 
                                    echo $i++;
                                ?>
                            </p>
                        </td>
                        <td>
                            <p style="text-align: center; font-weight: bolder; font-size : 16px; ">
                                <?php 
                                    echo $querytime;
                                ?>
                            </p>
                        </td> 
                        <td>
                            <p style="text-align: center; font-weight: bolder; font-size : 16px; ">
                                <?php 
                                    echo $subject;
                                ?>
                            </p>
                        </td>
                        <td>
                            <p style="text-align: center; font-weight: bolder; font-size : 16px; ">
                                <?php 
                                    echo $query;
                                ?>
                            </p>
                        </td>
                        <td>
                            <p style="text-align: center; font-weight: bolder; font-size : 16px; ">
                                <?php 
                                    echo $reply;
                                ?>
                            </p>
                        </td>
                    </tr>

                <?php } ?>

            </table>
        </div>
</body>
</html>