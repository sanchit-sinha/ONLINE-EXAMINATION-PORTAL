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
    <style>
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
    </style>
</head>
<body>
    <div class="sidenav">
        <a href="admin.php">CREATE TESTS</a><br><br>
        <a href="user_analysis.html">USER ANALYSIS</a><br><br>
        <a href="preview_tests.html">PREVIEW TESTS</a><br><br>
      </div>

    <div id = "container">
        <div id = "create_tests">
                <h3>Enter the details of the new test</h3>
                <form action="main.php">
                    <h3 >TEST NAME : </h3>
                    <input type = "text" id = "testname" name = "testname" placeholder = "Enter test name" onblur = "fill_testname();"> <br><br>
                    <h3>NO. OF QUESTIONS : </h3>
                    <input type="number" required id="numberofquestions" placeholder="No. of questions" onblur="generate_questions();generate_response_sheet();">
                 </form>
                    <br><br>
                <button id = "enter_manually" onclick="make_questions_visible();">
                    <span id = "display_on_button_enter_manually" >ENTER MANUALLY</span>
                </button> 
                <button id = "upload_pdf" onclick="make_upload_panel_visible();">
                    <span id="disaply_on_button_upload">
                        UPLOAD
                    </span>
                </button> 
                <br>
                <div class="[row">
                        <div class="col-xs-8 col-xs-offset-2">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <br><br>
                                        <th><h3>#</h3></th>
                                        <th><h3>Test Name</h3></th>
                                        <th><h3>Time Created </h3></th>
                                        <th><h3>File Name</h3></th>
                                        <th><h3>View</h3></th>
                                        <th><h3>Download</h3></th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                $i = 1;
                                while($row = mysqli_fetch_array($result)) { ?>
                                <tr>
                                    <td><?php echo $i++; ?></td>
                                    <td><?php echo $row['test_name']; ?></td>
                                    <td><?php echo $row['created_datetime']; ?></td>
                                    <td><?php echo $row['file_name']; ?></td>
                                    <td><a href="../uploads/<?php echo $row['file_name']; ?>" target="_blank">View</a></td>
                                    <td><a href="../uploads/<?php echo $row['file_name']; ?>" download>Download</td>
                                </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                <div id = "questions" style="display: none;">
                    <div id ="testname">
                        <h3>
                            TEST NAME: <input type="text" required name = "name_of_test1" id = "name_of_test1" readonly> 
                            NO. OF QUESTIONS: <input type="number" required name = "no_ofques1" id = "no_ofques1" readonly><br>
                            START TIME : <input name = "starttime1" type = "datetime-local"> 
                            END TIME : <input name = "endtime1" type = "datetime-local">  <br>
                        </h3>
                    </div>
                    <div id = "allquestions" >
                        
                    </div>
                </div>
                <div id = "uploadpaper" style="display: none;">
                    <div class="row">
                        <div class="col-xs-8 col-xs-offset-2 well">
                        <form action="upload.php" method="post" enctype="multipart/form-data">
                            <legend><h3>Select File to Upload:</h3></legend>
                            <div class="form-group">
                                <input type="file" name="file1" />
                            </div>
                            <div class="form-group">
                                <input type="submit" name="submit" value="Upload" class="btn btn-info"/>
                            </div>
                            <div id = "display_responses">
                                <h3>
                                TEST NAME: <input type="text" required name = "name_of_test2" id = "name_of_test2" readonly><br>
                                NO. OF QUESTIONS: <input type="number" required name = "no_ofques2" id = "no_ofques2" readonly><br>
                                START TIME : <input name = "starttime2" type = "datetime-local"> 
                                END TIME : <input name = "endtime2" type = "datetime-local">  <br>
                                Correct Responses: <input type="text" required name = "display_correct_responses" id = "display_correct_responses" readonly> 
                                Total Marks: <input type="number" required name = "total_marks2" id = "total_marks2" required> 
                                </h3>
                            </div>
                            <?php if(isset($_GET['st'])) { ?>
                                <div class="alert alert-danger text-center">
                                <?php if ($_GET['st'] == 'success') {
                                        echo "File Uploaded Successfully!";
                                    }
                                    else
                                    {
                                        echo 'Invalid File Extension!';
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


                <script>
                    function fill_testname(){
                        var username = document.getElementById('testname').value;
                        
                        document.getElementById('name_of_test1').value = username;
                        document.getElementById('name_of_test2').value = username;
                    }
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
                        str += "<button id = 'responsegenerator' onclick = 'calulate_respones();'> CALCULATE CORRECT RESPONSE  </button>";
                        document.getElementById("correct_response").innerHTML = str;
                    }

                    function calulate_respones(){
                        var n = document.getElementById('numberofquestions').value;
                        str = "";

                        for(i = 1 ; i <= Number(n) ; i++){
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