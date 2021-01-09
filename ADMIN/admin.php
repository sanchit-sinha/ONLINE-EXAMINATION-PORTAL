<?php
    include '../connecting_database.php';
    // fetch files
    $sql = "SELECT * FROM uploaded_test_details";
    $result = mysqli_query($conn, $sql);

    $querymaxid = "SELECT test_name FROM test_details ORDER BY test_name DESC LIMIT 1";
    $result1 = mysqli_query($conn , $querymaxid);
    $str =  mysqli_fetch_array($result1)[0];
    
    // echo $str;
    $num = '';
    $len = strlen($str);
    for($i = 3 ; $i < $len ;  $i++) $num = $num."$str[$i]";

    $id =  number_format($num) + 1;
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
            /* max-width: 15vw; */
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
        <div id = "create_tests">
                <h3>Enter the details of the new test</h3>
                <form action="front_subjective.php" method = "GET">
                    <h3 >TEST NAME : </h3>
                    <!-- <input type = "text" id = "testname" name = "testname" placeholder = "Enter test name" onblur = "fill_testname();" readonly value = '<?php echo "HTS".$id; ?>'> <br><br> -->
                    <input type = "text" id = "testname1" name = "testname1" placeholder = "Enter test name"  readonly value = '<?php echo "HTS".$id; ?>'> <br><br>
                    <h3>NO. OF QUESTIONS : </h3>
                    <input type="number" required id="numberofquestions" name = "questionnumber1" placeholder="No. of questions" onblur="generate_questions();generate_response_sheet();">
                    <br><br>
                    <div id="button_for_subjective_questions" style="display : block; margin:auto; text-align : center; ">
                        <button id = "enter_manually"  class="w3-button w3-green">
                            <span id = "display_on_button_enter_manually" >ENTER MANUALLY</span>
                        </button> 
                    </div>  
                </form>
                <br><br><br>
                <h1  style="display : block; margin:auto; text-align : center; "> OR </h1>
                <br><br><br>

                    <div id = "button_for_upload" style="display : block; margin:auto; text-align : center; ">
                    <button id = "upload_pdf" onclick="make_upload_panel_visible();" class="w3-button w3-green">
                        <span id="disaply_on_button_upload">
                            UPLOAD
                        </span>
                    </button> 
                     </div>
               
               
                     <br>
                <div class="row">
                        
                </div>
                <div id = "questions" style="display: none;">
                    <div id ="testname">
                        <h3>
                            <!-- TEST NAME: <input type="text" required name = "name_of_test1" id = "name_of_test1" readonly>  -->
                            TEST NAME:  <input type = "text" id = "testnameq" name = "testnameq" placeholder = "Enter test name"  readonly value = '<?php echo "HTS".$id; ?>'> <br><br>
                            NO. OF QUESTIONS: <input type="numberq" required name = "no_ofques1q" id = "no_ofques1" readonly><br>
                            START TIME : <input name = "starttime1q" type = "datetime-local"> 
                            END TIME : <input name = "endtime1q" type = "datetime-local">  <br>
                        </h3>
                    </div>
                    <div id = "allquestions" >
                        
                    </div>
                </div>
                <div id = "uploadpaper" style="display: none;">
                    <div class="row">
                        <div class="col-xs-8 col-xs-offset-2 well">
                        <form action="upload.php" method="post" enctype="multipart/form-data">
                        <div style="text-align: center;">
                            <h3 style="text-align: center;">Select File to Upload:</h3>
                        </div>
                            <div class="form-group">
                                <input type="file" name="file1" />
                            </div>
                            <div class="form-group" id = "paper_upload" style="display: none;">
                                <input type="submit" name="submit" value="Upload" class="btn btn-info" style="background-color:black; color:white" />
                            </div>
                            <div id = "display_responses">
                                <h3>
                                TEST NAME:  <input type = "text" id = "name_of_test2" name = "name_of_test2" placeholder = "Enter test name"  readonly value = '<?php echo "HTS".$id; ?>'><br>
                                NO. OF QUESTIONS: <input type="number" required name = "no_ofques2" id = "no_ofques2" readonly><br>
                                START TIME : <input name = "starttime2" type = "datetime-local"> <br>
                                END TIME : <input name = "endtime2" type = "datetime-local">  <br>
                                <input type="text" required name = "display_correct_responses" id = "display_correct_responses" readonly style="display : none;"> <br>
                                Total Marks: <input type="number" required name = "total_marks2" id = "total_marks2" required> <br>
                                </h3>
                            </div>
                            <?php if(isset($_GET['st'])) { ?>
                                <div class="alert alert-danger text-center">
                                <?php if ($_GET['st'] == 'success') {
                                        echo "<script>alert('File Uploaded Successfully!');</script>";
                                    }
                                    else
                                    {
                                        echo "<script>alert('Invalid File Extension!');</script>";
                                    } ?>
                                </div>
                            <?php } ?>
                        </form>
                        </div>
                    </div>
                    <div id = "response_sheets">
                        <div id = "correct_response">
                        
                    
                        </div>
                    </div>

                    
                </div>

                <script src="../assets/JS/mynav.js"></script>
                <script>
                    // function fill_testname(){
                    //     var username = document.getElementById('testname').value;
                        
                    //     document.getElementById('name_of_test1').value = username;
                    //     document.getElementById('name_of_test2').value = username;
                    // }
                    function make_questions_visible(){
                        if(document.getElementById('questions').style.display == 'none') {
                            document.getElementById('questions').style.display = 'block';
                            document.getElementById('display_on_button_enter_manually').innerHTML = "X";
                            document.getElementById('display_on_button_enter_manually').style.color = "red";
                            document.getElementById('display_on_button_enter_manually').style.fontWeight = "1000";
                        }
                        else{
                            document.getElementById('questions').style.display = 'none';
                            document.getElementById('display_on_button_enter_manually').innerHTML = "ENTER MANUALLY";
                            document.getElementById('display_on_button_enter_manually').style.color = "black";
                            document.getElementById('display_on_button_enter_manually').style.fontWeight = "normal";
                        }
                    }

                    function make_upload_panel_visible(){
                        if(document.getElementById('uploadpaper').style.display == 'none') {
                            document.getElementById('uploadpaper').style.display = 'block';
                            document.getElementById('disaply_on_button_upload').innerHTML = "X";
                            document.getElementById('disaply_on_button_upload').style.color = "red";
                            document.getElementById('disaply_on_button_upload').style.fontWeight = "1000";
                        }
                        else{
                            document.getElementById('uploadpaper').style.display = 'none';
                            document.getElementById('disaply_on_button_upload').innerHTML = "UPLOAD";
                            document.getElementById('disaply_on_button_upload').style.color = "black";
                            document.getElementById('disaply_on_button_upload').style.fontWeight = "normal";
                        }
                    }

                    function generate_response_sheet(){
                        var n = document.getElementById('numberofquestions').value;
                        document.getElementById('no_ofques1').value = n;
                        document.getElementById('no_ofques2').value = n;
                       
                        var str = "<h3>";
                        for(i = 1 ; i <= Number(n) ; i++){
                            if(i == 1){
                                str += "<br><h2>CORRECT RESPONSE SHEET:</h2>";
                            }
                            
                            var num = i.toString();
                            str += num;

                            str += ": <input type=\"checkbox\" name=\""
                            str += num
                            str += "a\"" 
                            str += "id = \"" 
                            str += num 
                            str += "a\">"

                            str += ": <input type=\"checkbox\" name=\""
                            str += num
                            str += "b\"" 
                            str += "id = \"" 
                            str += num 
                            str += "b\">"

                            str += ": <input type=\"checkbox\" name=\""
                            str += num
                            str += "c\"" 
                            str += "id = \"" 
                            str += num 
                            str += "c\">"

                            str += ": <input type=\"checkbox\" name=\""
                            str += num
                            str += "d\"" 
                            str += "id = \"" 
                            str += num 
                            str += "d\">" + "<br>"

                        }
                        str += "</h3> <br>";
                        str += "<button id = 'responsegenerator' onclick = 'calulate_respones();' class='w3-button w3-green'> SAVE RESPONSES </button>";
                        document.getElementById("correct_response").innerHTML = str;
                    }

                    function calulate_respones(){
                        // paper_upload
                        document.getElementById('paper_upload').style.display = "block";
                        document.getElementById('paper_upload').style.color = "white";
                        var n = document.getElementById('numberofquestions').value;
                        str = "";

                        for(i = 1 ; i <= Number(n) ; i++){
                            if(i == 1) str += "|";
                            
                            var id1 = i.toString()+'a';
                            var id2 = i.toString()+'b';
                            var id3 = i.toString()+'c';
                            var id4 = i.toString()+'d';

                            var checkBox1 = document.getElementById(id1);
                            var checkBox2 = document.getElementById(id2);
                            var checkBox3 = document.getElementById(id3);
                            var checkBox4 = document.getElementById(id4);

                            if(checkBox1.checked == true){
                                str += id1;
                                str += "&";
                            }
                            if(checkBox2.checked == true){
                                str += id2;
                                str += "&";
                            }
                            if(checkBox3.checked == true){
                                str += id3;
                                str += "&";
                            }
                            if(checkBox4.checked == true){
                                str += id4;
                                str += "&";
                            }
                            str += "|";
                        }
                        document.getElementById("display_correct_responses").value = str;
                    }

                    function generate_questions(){
                        var n = document.getElementById('numberofquestions').value;

                        // while loop with save button triggerign add.php adding question to database
                        // change option as well to change the question triggering change.php

                        var str = "";

                        for(i = 1 ; i <= Number(n) ; i++){
                            if(i == 1){
                                str += "<br><h2>QUESTIONS</h2>";
                            }
                            
                            var idstring = i.toString() + "Q";
                            // str += idstring;
                            str += "<div id = 'Question" + i.toString() + "'> <br>"; 
                            str += "<h3>" + i.toString() + ".</h3> ";
                            str += "<textarea name =" + idstring + " id =" + idstring +  " cols='150' rows='10' placeholder='Enter your question'></textarea> ";
                            str += "  +  " + "<input type='text' placeholder = '+ve Marks' name= 'positive_marks_for_question"+ i.toString()+"' <br> ";
                            str += "  -  " + "<input type='text' placeholder = '-ve Marks' name= 'negative_marks_for_question"+ i.toString()+"' ";
                            str += "</div> <br>";
                            
                            str += "<div id = 'Tag_for_question" + i.toString() + "'> <br>";
                            str += " <h3>TAG :</h3> ";
                            str += "     <textarea type='text' name=" + "tag_" + idstring+ " cols='140' rows='2' placeholder='Tag of the question'></textarea> <br>";
                            str += "</div> <br>";
                            
                            str += "<div id = 'option_for_question" + i.toString() + "'> <br>";
                            str += "<h3>OPTIONS :</h3> "
                            str += "<div id = 'option" + i.toString() + "a'> <br>";
                            str += "<h3>a)</h3> ";
                            str += "<input type = 'checkbox' name = " + "checkbox_for_option_"+i.toString()+"a <br>";
                            str += " <textarea type='text' name=" + "value_for_option_" + i.toString() + "a  cols='140' rows='5' placeholder='Enter option'></textarea> <br>";
                            str += "<br>";
                            str += "</div> <br>";
                            
                            str += "<div id = 'option" + i.toString() + "b'> <br>";
                            str += "<h3>b)</h3> ";
                            str += "<input type = 'checkbox' name = " + "checkbox_for_option_"+i.toString()+"b <br>";
                            str += "     <textarea type='text' name=" + "value_for_option_" + i.toString() + "b  cols='140' rows='5'  placeholder='Enter option'></textarea> <br>";
                            str += "<br>";
                            str += "</div> <br>";
                            
                            str += "<div id = 'option" + i.toString() + "c'> <br>";
                            str += "<h3>c)</h3> ";
                            str += "<input type = 'checkbox' name = " + "checkbox_for_option_" + i.toString() + "c <br>";
                            str += "     <textarea type='text' name=" + "value_for_option_" + i.toString() + "c   cols='140' rows='5' placeholder='Enter option'></textarea> <br>";
                            str += "<br>";
                            str += "</div> <br>";
                            
                            str += "<div id = 'option" + i.toString() + "d'> <br>";
                            str += "<h3>d)</h3> ";
                            str += "<input type = 'checkbox' name = " + "checkbox_for_option_"+i.toString()+"d <br>";
                            str += "     <textarea type='text' name=" + "value_for_option_" + i.toString() + "d   cols='140' rows='5' placeholder='Enter option'></textarea> <br>";
                            str += "<br>";
                            str += "</div> <br>";
                            str += "</div> <br>";

                            // str += "<input typr"
                        }

                        document.getElementById("allquestions").innerHTML = str;
                    }
                </script>
        </div>
    </div>

</body>
</html>