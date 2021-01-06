<?php
    include '../connecting_database.php';

    $sql = "SELECT * FROM contactform WHERE resolved = '0'";
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
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        input:focus,
        select:focus,
        textarea:focus,
        button:focus {
            outline: none;
        }
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
            max-width : 80vw;
        }
        table, th, td {
            border: 1px solid black;
        }
        .button {
            background-color: #4CAF50; /* Green */
            border: none;
            color: white;
            padding: 15px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
        }
        .button5 {border-radius: 50%;}
        #submit{
            border-radius: 50%;
            background-color : green;
            color:white;
            padding : 5px;
            width : 3vw;
        }
    </style>
</head>
<body>

        <div id = "query-table">
            <br><br>
            <h1  style = "text-align:center; font-weight:bolder"> PENDING QUERIES </h1>
            <table class = "w3-table-all">
                <thead>
                    <tr>
                        <th class = "w3-blue"><p style="text-align: center; ">#</p></th>
                        <th class = "w3-blue"><p style="text-align: center; ">TIME POSTED</p></th>
                        <th class = "w3-blue"><p style="text-align: center; ">USER NAME</p></th>
                        <th class = "w3-blue"><p style="text-align: center;">SUBJECT</p></th>
                        <th class = "w3-blue"><p style="text-align: center;">QUERY</p></th>
                        <th class = "w3-blue"><p style="text-align: center;">REPLY</p></th>
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
                        
                        $fname = $row['fullname'];
                        $status = $row['resolved'];
                        $reply = $row['reply'];

                        $id = $row['SNo'];

                        // echo $subject."<br>";
                        // echo $querytime."<br>";
                        // echo $status."<br>";

                    ?>

                    <tr class= 'w3-yellow'; >
                        <form action = "queryresolve.php" method = "POST">
                                <td>
                                <p style="text-align: center; font-weight: bolder; font-size : 16px; ">
                                    <?php 
                                        echo $i++;
                                    ?>
                                </p>
                            </td>
                                <p style="text-align: center; font-weight: bolder; font-size : 16px; display : none;">
                                    <input class = 'w3-yellow' type='text'  name= "queryno" readonly value = '<?php echo $id; ?>'>
                                </p>
                                <p style="text-align: center; font-weight: bolder; font-size : 16px; display : none;">
                                    <input class = 'w3-yellow' type='text'  name= "fname" readonly value = '<?php echo $fname; ?>'>
                                </p>
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
                                        echo $fname;
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
                                    <textarea class = 'w3-white' name= '<?php echo "reply".$id; ?>' cols='20' rows='10' placeholder='Reply..'></textarea>
                                    <div id = "button" style = "text-align : center;"> 
                                         <button id = "submit"> 
                                            <!-- <p style="font-weight : bolder;">RESOLVE</p> -->
                                            <p></p>
                                             <i class="fa fa-arrow-right"></i>
                                             <p></p>
                                         </button>
                                    </div>
                            </td>
                        </form>
                    </tr>
                <?php } ?>

            </table>
        </div>
</body>
</html>