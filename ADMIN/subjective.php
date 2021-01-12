<?php 
    include '../connecting_database.php';

    $tname = $_POST['testnamevalue'];
    $qno = $_POST['qno'];
    $totalqno = $_POST['totalqno'];
    // echo $tname ."<br>";
    // echo $qno ;

    $search =  "SELECT * from manually_entered_test_details WHERE question_number = '$qno' AND test_name = '$tname'";
    // echo $search;
    $result = mysqli_query($conn, $search);
    $row = mysqli_fetch_array($result);

    
    $update_part = false;
    if($result->num_rows){
        $update_part = true;

        $pstatement = $row['problem_statement'];
        $pmarks = $row['positive_marks'];
        $nmarks = $row['negative_marks'];
        $optiona = $row['optiona'];
        $optionb = $row['optionb'];
        $optionc = $row['optionc'];
        $optiond = $row['optiond'];



        // echo $pstatement."<br>";
        // echo $pmarks."<br>";
        // echo $nmarks."<br>";
        // echo $optiona."<br>";
        // echo $optionb."<br>";
        // echo $optionc."<br>";
        // echo $optiond."<br>";
    }
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

        input[type=text],input[type=number], select, textarea {
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
  padding: 14px 28px;
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
  padding: 10px;
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
    <?php 
        if($update_part){
            echo '<h1 style = "text-align : center; font-size:50px;"> PREVIEW QUESTION </h1>';
            // $i = $qno;
            $n = $qno;
                    for($i = $n ; $i <= $n ; $i++){
                        $search =  "SELECT * from manually_entered_test_details WHERE question_number = '$i' AND test_name = '$tname'";
                        $result = mysqli_query($conn, $search);
                        $row = mysqli_fetch_array($result);

                        $pstatement = $row['problem_statement'];
                        $pmarks = $row['positive_marks'];
                        $nmarks = $row['negative_marks'];
                        $optiona = $row['optiona'];
                        $optionb = $row['optionb'];
                        $optionc = $row['optionc'];
                        $optiond = $row['optiond'];

                        // echo $pstatement."<br>";
                        // echo $pmarks."<br>";
                        // echo $nmarks."<br>";
                        // echo $optiona."<br>";
                        // echo $optionb."<br>";
                        // echo $optionc."<br>";
                        // echo $optiond."<br>";

                        $str = '
                        <div class="container">
                            <div class="outset">
                                <div class="row">
                                    <div class="col-25">
                                    <label for="question_no">Q'.$i.') </label>
                                    </div>
                                </div>
                            
                                

                                <div class="row">
                                    <div class="col-25">
                                    <label for="marking_scheme">Marking Scheme : </label>
                                    </div>
                                    <div class="col-75">
                                    <input type="text" style = "width:45%; text-align : center;" id="positive_marking_scheme" name="positive_marking_scheme" placeholder="Positive Marks" value = "+'.$pmarks.'" readonly >
                                    <input type="text" style = "width:45%; text-align : center;" id="negative_marking_scheme" name="negative_marking_scheme" placeholder="Negative Marks" value = "'.$nmarks.'" readonly >
                                    </div>
                                </div>
                                ';
                                    $len =  strlen($pstatement);
                                    $start = '<img src="http://latex.codecogs.com/gif.latex?' ; 
                                    $end = '" border="0"/>';
                                    $ques = '';
                                    for($j = 0 ; $j < $len ; $j++){
                                        if($pstatement[$j] != '$') $ques = $ques.$pstatement[$j];
                                        else{
                                            $j++;
                                            $ques = $ques.$start;
                                            while($pstatement[$j] != '$'){
                                                if($pstatement[$j] == '$') break;
                                                $ques = $ques.$pstatement[$j];
                                                $j++;
                                            }
                                            // output += '<br></div>';
                                            $ques =  $ques.$end;
                                        }
                                    }
                                    // echo $ques;
                                    $str = $str.'                           
                                    <div class = "row">
                                    <div class="col-25">
                                <label for="question">Question</label>
                                    </div>
                                    <div class="col-75text" style="height:200px">
                                        <p id = "previewquestion_'.$i.'" style = "text-align : left; color:black;">'.$ques.' </p>
                                    </div>
                                </div>';

                                $len =  strlen($optiona);
                                    $start = '<img src="http://latex.codecogs.com/gif.latex?' ; 
                                    $end = '" border="0"/>';
                                    $opa = '';
                                    for($j = 0 ; $j < $len ; $j++){
                                        if($optiona[$j] != '$') $opa = $opa.$optiona[$j];
                                        else{
                                            $j++;
                                            $opa = $opa.$start;
                                            while($optiona[$j] != '$'){
                                                if($optiona[$j] == '$') break;
                                                $opa = $opa.$optiona[$j];
                                                $j++;
                                            }
                                            // output += '<br></div>';
                                            $opa =  $opa.$end;
                                        }
                                    }

                                $str = $str . '<div class = "row">
                                        <div class="col-25">
                                        <h1>a)</h1> 
                                        </div>
                                        <div class="col-75text" style="height:100px; " name="previewoptionvalue_a"  >
                                            <p id = "previewoptionvalue_'.$i.'a" style = "text-align : left; color:black;">'.$opa.'</p>
                                        </div>
                                </div>';
                                // b

                                $len =  strlen($optionb);
                                    $start = '<img src="http://latex.codecogs.com/gif.latex?' ; 
                                    $end = '" border="0"/>';
                                    $opb = '';
                                    for($j = 0 ; $j < $len ; $j++){
                                        if($optionb[$j] != '$') $opb = $opb.$optionb[$j];
                                        else{
                                            $j++;
                                            $opb = $opb.$start;
                                            while($optionb[$j] != '$'){
                                                if($optionb[$j] == '$') break;
                                                $opb = $opb.$optionb[$j];
                                                $j++;
                                            }
                                            // output += '<br></div>';
                                            $opb =  $opb.$end;
                                        }
                                    }

                                $str = $str . '<div class = "row">
                                        <div class="col-25">
                                        <h1>b)</h1> 
                                        </div>
                                        <div class="col-75text" style="height:100px; " name="previewoptionvalue_b"  >
                                            <p id = "previewoptionvalue_'.$i.'b" style = "text-align : left; color:black;">'.$opb.'</p>
                                        </div>
                                </div>';
                                
                                // c
                                $len =  strlen($optionc);
                                    $start = '<img src="http://latex.codecogs.com/gif.latex?' ; 
                                    $end = '" border="0"/>';
                                    $opc = '';
                                    for($j = 0 ; $j < $len ; $j++){
                                        if($optionc[$j] != '$') $opc = $opc.$optionc[$j];
                                        else{
                                            $j++;
                                            $opc = $opc.$start;
                                            while($optionc[$j] != '$'){
                                                if($optionc[$j] == '$') break;
                                                $opc = $opc.$optionc[$j];
                                                $j++;
                                            }
                                            // output += '<br></div>';
                                            $opc =  $opc.$end;
                                        }
                                    }

                                $str = $str . '<div class = "row">
                                        <div class="col-25">
                                        <h1>c)</h1> 
                                        </div>
                                        <div class="col-75text" style="height:100px; " name="previewoptionvalue_c"  >
                                            <p id = "previewoptionvalue_'.$i.'c" style = "text-align : left; color:black;">'.$opc.'</p>
                                        </div>
                                </div>';

                                // d
                                $len =  strlen($optiond);
                                    $start = '<img src="http://latex.codecogs.com/gif.latex?' ; 
                                    $end = '" border="0"/>';
                                    $opd = '';
                                    for($j = 0 ; $j < $len ; $j++){
                                        if($optiond[$j] != '$') $opd = $opd.$optiond[$j];
                                        else{
                                            $j++;
                                            $opd = $opd.$start;
                                            while($optiond[$j] != '$'){
                                                if($optiond[$j] == '$') break;
                                                $opd = $opd.$optiond[$j];
                                                $j++;
                                            }
                                            // output += '<br></div>';
                                            $opd =  $opd.$end;
                                        }
                                    }

                                $str = $str . '<div class = "row">
                                        <div class="col-25">
                                        <h1>d)</h1> 
                                        </div>
                                        <div class="col-75text" style="height:100px; " name="previewoptionvalue_d"  >
                                            <p id = "previewoptionvalue_'.$i.'d" style = "text-align : left; color:black;">'.$opd.'</p>
                                        </div>
                                </div>';


                            $str = $str.'<br>
                            <div class = "row">
                                <div class="col-25">
                                </div>
                                <div class="col-75"  style = " font-size : 26px;">
                                <div class="form-check-inline">
                                
                                    
                                </div>
                            </div>


                            </div>
                                    
                        </div><br><br><br><br><br>';

                        echo $str;
                    }
            
        }
    ?>




        <?php 
            // change it 
            $i = $_POST['qno'];

            echo "<h1 style =  'text-align : center; font-size:50px;'> ENTER QUESTION </h1>";
                $str = '
                <div class="container">
                    <form action="feed_subjective_to_database.php" method = "POST">
                    <div class="outset">
                    <input type="text" id="testname" name="testname" placeholder="Name of Test" value = "'.$tname.'" style="display:none;" readonly>
                    <input type="text" id="tqno" name="total_qno" placeholder="Total Question" value = "'.$totalqno.'" style="display:none;" readonly>
                        <div class="row">
                            <div class="col-25">
                            <label for="question_no">Question Number : </label>
                            </div>
                            <div class="col-75">
                            <input type="text"  readonly name="question_number"  placeholder="Enter Question Number" value = "'.$i.'">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-25">
                            <label for="type_of_question">Type of Question : </label>
                            </div>
                            <div class="col-75">
                            <select id="type_of_question" name="type_of_question">
                                <option value="multiple_correct">MULTI CORRECT</option>
                                <option value="single_correct">SINGLE CORRECT</option>
                                <option value="integer_type">INTEGER TYPE</option>
                                <option value="passage_type">PASSAGE TYPE</option>
                                <option value="matrix_type">MATRIX TYPE</option>
                            </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-25">
                            <label for="tag_of_question">Tag of Question : </label>
                            </div>
                            <div class="col-75">
                            <select id="tag_of_question" name="tag_of_question">
                                <option value="multiple_correct">MULTI CORRECT</option>
                                <option value="single_correct">SINGLE CORRECT</option>
                                <option value="integer_type">INTEGER TYPE</option>
                                <option value="passage_type">PASSAGE TYPE</option>
                                <option value="matrix_type">MATRIX TYPE</option>
                            </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-25">
                            <label for="marking_scheme">Marking Scheme : </label>
                            </div>
                            <div class="col-75">
                            <input type="number" style = "width:45%;" id="positive_marking_scheme" name="positive_marking_scheme" placeholder="Positive Marks" value = "4">
                            <input type="number" style = "width:45%;" id="negative_marking_scheme" name="negative_marking_scheme" placeholder="Negative Marks" value = "-2">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-25">
                            <label for="question">Question</label>
                            </div>
                            <div class="col-75">
                            <textarea id="questionvalue_'.$i.'" name ="questionvalue" placeholder="Enter Question" style="height:200px"></textarea>
                        </div>
                        </div>
                        <br><br>

                        
                        <div class="col-25">
                            </div>
                        <div class = "row">
                            <div class="col-75">
                            <a class = "block w3-blue" id="preview_'.$i.'" name="preview"  href="#"  onclick="preview_question('.$i.');" >PREVIEW QUESTION </a>
                            </div>
                        </div>
                        <br><br>
                        <div class="col-25">
                            </div>
                        <div class = "row">
                            <div class="col-75text" style="height:200px">
                                <p id = "previewquestion_'.$i.'" style = "text-align : left; color:gray;">Preview Question here </p>
                            </div>
                        </div>
                        <p> OPTIONS </p>
              

                                <label class="containerr"> 
                                <div class = "row">
                                        <div class="col-25">
                                        <input type="checkbox" name="optionn[]" value = "a">
                                            <span class="checkmark" style = "text-align : center;"> a </span>
                                        </div>
                                        <div class="col-75">
                                            <textarea id="optionvalue_'.$i.'a" name="optionvalue_a" placeholder="Enter Option A" style="height:200px;"></textarea>
                                        </div>

                                        <div class="col-25">
                                        </div>
                                        <div class = "row">
                                            <div class="col-75">
                                            <a  id = "previewbutton_'.$i.'a" class = "block w3-blue" href="#"  onclick="preview_option('.$i.',1)">PREVIEW OPTION A</a>
                                            </div>
                                        </div>

                                        <div class="col-25">
                                        </div>
                                        <div class="col-75text" style="height:200px; " name="previewoptionvalue_a"  >
                                            <p id = "previewoptionvalue_'.$i.'a" style = "text-align : left; color:gray;">Preview Option A here </p>
                                        </div>

                                        </div>
                                </label>

                                <label class="containerr"> 
                                <div class = "row">
                                        <div class="col-25">
                                        <input type="checkbox" name="optionn[]" value = "b">
                                            <span class="checkmark" style = "text-align : center;"> b </span>
                                        </div>
                                        <div class="col-75">
                                            <textarea id="optionvalue_'.$i.'b" name="optionvalue_b" placeholder="Enter Option B" style="height:200px;"></textarea>
                                        </div>

                                        <div class="col-25">
                                        </div>
                                        <div class = "row">
                                            <div class="col-75">
                                            <a  id = "previewbutton_'.$i.'b" class = "block w3-blue" href="#"  onclick="preview_option('.$i.',2);">PREVIEW OPTION B</a>
                                            </div>
                                        </div>

                                        <div class="col-25">
                                        </div>
                                        <div class="col-75text" style="height:200px; " name="previewoptionvalue_b" >
                                            <p id = "previewoptionvalue_'.$i.'b" style = "text-align : left; color:gray;">Preview Option B here </p>
                                        </div>

                                        </div>

                                </label>

                                <label class="containerr"> 
                                <div class = "row">
                                        <div class="col-25">
                                        <input type="checkbox" name="optionn[]" value = "c">
                                            <span class="checkmark" style = "text-align : center;"> c </span>
                                        </div>
                                        <div class="col-75">
                                            <textarea id="optionvalue_'.$i.'c"name="optionvalue_c" placeholder="Enter Option C" style="height:200px;"></textarea>
                                        </div>

                                        <div class="col-25">
                                        </div>
                                        <div class = "row">
                                            <div class="col-75">
                                            <a  id = "previewbutton_'.$i.'c" class = "block w3-blue" href="#"  onclick="preview_option('.$i.',3);">PREVIEW OPTION C</a>
                                            </div>
                                        </div>

                                        <div class="col-25">
                                        </div>
                                        <div class="col-75text" style="height:200px; " name="previewoptionvalue_c"  >
                                            <p id = "previewoptionvalue_'.$i.'c" style = "text-align : left; color:gray;">Preview Option C here </p>
                                        </div>

                                        </div>


                                </label>

                                <label class="containerr"> 
                                <div class = "row">
                                        <div class="col-25">
                                        <input type="checkbox" name="optionn[]" value = "d">
                                            <span class="checkmark" style = "text-align : center;"> d </span>
                                        </div>
                                        <div class="col-75">
                                            <textarea id="optionvalue_'.$i.'d" name="optionvalue_d" placeholder="Enter Option D" style="height:200px;"></textarea>
                                        </div>

                                        <div class="col-25">
                                        </div>
                                        <div class = "row">
                                            <div class="col-75">
                                            <a id = "previewbutton_'.$i.'d" class = "block w3-blue"  href="#"  onclick="preview_option('.$i.',4);">PREVIEW OPTION D</a>
                                            </div>
                                        </div>

                                        <div class="col-25">
                                        </div>
                                        <div class="col-75text" style="height:200px; " name="previewoptionvalue_d"  >
                                            <p id = "previewoptionvalue_'.$i.'d" style = "text-align : left; color:gray;">Preview Option D here </p>
                                        </div>

                                        </div>
                                </label>



                        <div class = "row">
                            <button class = "block" id="submit" name="submit">SAVE</button>
                        </div>
                    </div>

                </form>
                </div>';

                echo $str;
         ?>
    
         <script>
                function preview_question(num){
                    var ID = "questionvalue_"  + num ;
                    var mssg = document.getElementById(ID).value;
                    var n = mssg.length;


                    var output = '';
                    var start = '<img src="http://latex.codecogs.com/gif.latex?' ; 
                    var end = '" border="0"/>';
                    for(i = 0 ; i < n ; i++){
                        if(mssg[i] != '$') output += mssg[i];
                        else{
                            i++;
                            output += start;
                            while(mssg[i] != '$'){
                                if(mssg[i] == '$') break;
                                output += mssg[i];
                                i++;
                            }
                            // output += '<br></div>';
                            output +=  end;
                        }
                    }

                    var IDpreview = "previewquestion_" + num;
                    document.getElementById(IDpreview).innerHTML  = output;
                    // document.getElementById(IDpreview).style.color = "";
                }
                function preview_option(num , option){
                    var ID = "optionvalue_";
                    var str = '';
                    if(option == 1) str = 'a';
                    else if(option == 2) str = 'b';  
                    else if(option == 3) str = 'c';
                    else if(option == 4) str = 'd';

                    ID += num;
                    ID += str;
                    // alert(ID);

                    var mssg = document.getElementById(ID).value;
                    var n = mssg.length;


                    var output = '';
                    var start = '<img src="http://latex.codecogs.com/gif.latex?' ; 
                    var end = '" border="0"/>';
                    for(i = 0 ; i < n ; i++){
                        if(mssg[i] != '$') output += mssg[i];
                        else{
                            i++;
                            output += start;
                            while(mssg[i] != '$'){
                                if(mssg[i] == '$') break;
                                output += mssg[i];
                                i++;
                            }
                            // output += '<br></div>';
                            output +=  end;
                        }
                    }

                    var IDpreview = "previewoptionvalue_";
                    IDpreview += num;
                    IDpreview += str;

                    document.getElementById(IDpreview).innerHTML  = output;

                }
        </script>
</body>
</html>