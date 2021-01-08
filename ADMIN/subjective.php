<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MANUAL TEST</title>
    <style>
        * {
        box-sizing: border-box;
        }

        input[type=text], select, textarea {
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

        /* Clear floats after the columns */
        .row:after {
        content: "";
        display: table;
        clear: both;
        }

        /* Responsive layout - when the screen is less than 600px wide, make the two columns stack on top of each other instead of next to each other */
        @media screen and (max-width: 600px) {
        .col-25, .col-75, input[type=submit] {
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
</style>
</head>
<body>
    <div class = "container">
    <div class="row">
            <div class="col-25">
                <label for="testname">TEST NAME : </label>
                </div>
                <div class="col-75">
                <input type="text" id="testname" name="testname" placeholder="Name of Test">
            </div>
        </div>
        <div class="row">
            <div class="col-25">
                <label for="question_no">QUESTION NUMBER : </label>
                </div>
                <div class="col-75">
                <input type="text" id="number_of_questions" name="number_of_questions" placeholder="Number of Questions" >
            </div>
        </div>
        
    </div>
        <?php 
            // change it 
            $n = 5;

            echo "<h1 style =  'text-align : center; font-size:50px;'> ENTER QUESTIONS </h1>";
            for($i = 1 ; $i <= 5 ; $i++){
                $str = '
                <div class="container">
                    <form action="/action_page.php">
                    <div class="outset">
                        <div class="row">
                            <div class="col-25">
                            <label for="question_no">Question Number : </label>
                            </div>
                            <div class="col-75">
                            <input type="text" id="question_number" name="question_number_'.$i.'" placeholder="Question Number" value = "'.$i.'">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-25">
                            <label for="type_of_question">Type of Question : </label>
                            </div>
                            <div class="col-75">
                            <select id="type_of_question" name="type_of_question_'.$i.'">
                                <option value="multiple_correct">MULTI CORRECT</option>
                                <option value="single_correct">SINGLE CORRECT</option>
                                <option value="integer_type">INTEGER TYPW</option>
                                <option value="passage_type">PASSAGE TYPE</option>
                                <option value="matrix_type">MATRIX TYPE</option>
                            </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-25">
                            <label for="question">Question</label>
                            </div>
                            <div class="col-75">
                            <textarea id="question_value" name="question_'.$i.'" placeholder="Enter Question" style="height:200px"></textarea>
                        </div>
                        </div>
                        <br><br>

                        
                        <div class="col-25">
                            </div>
                        <div class = "row">
                            <div class="col-75">
                            <button class = "block" id="preview" name="preview_'.$i.'">PREVIEW</button>
                            </div>
                        </div>
                        <br><br>
                        <div class="col-25">
                            </div>
                        <div class = "row">
                            <div class="col-75">
                            <textarea id="previewx_box" name="previewbox_'.$i.'" placeholder="Preview Question" style="height:200px"></textarea>
                            </div>
                        </div>

                        <p> OPTIONS </p>
                            <label class="containerr"> 
                                <div class = "row">
                                        <div class="col-25">
                                        <input type="checkbox" name="option_'.$i.'a">
                                            <span class="checkmark" style = "text-align : center;"> a </span>
                                        </div>
                                        <div class="col-75">
                                            <textarea id="optionvalue" name="optionvalue_'.$i.'a" placeholder="Enter Option" style="height:200px"></textarea>
                                        </div>
                                    </div>
                                </label>

                                <label class="containerr"> 
                                <div class = "row">
                                        <div class="col-25">
                                            <input type="checkbox" name="option_'.$i.'b">
                                            <span class="checkmark" style = "text-align : center;"> b </span>
                                        </div>
                                        <div class="col-75">
                                            <textarea id="optionvalue" name="optionvalue_'.$i.'b" placeholder="Enter Option" style="height:200px"></textarea>
                                        </div>
                                    </div>
                                </label>

                                <label class="containerr"> 
                                <div class = "row">
                                        <div class="col-25">
                                            <input type="checkbox" name="option_'.$i.'c">
                                            <span class="checkmark" style = "text-align : center;"> c </span>
                                        </div>
                                        <div class="col-75">
                                            <textarea id="optionvalue" name="optionvalue_'.$i.'c" placeholder="Enter Option" style="height:200px"></textarea>
                                        </div>
                                    </div>
                                </label>

                                <label class="containerr"> 
                                <div class = "row">
                                        <div class="col-25">
                                            <input type="checkbox" name="option_'.$i.'d">
                                            <span class="checkmark" style = "text-align : center;"> d </span>
                                        </div>
                                        <div class="col-75">
                                            <textarea id="optionvalue" name="optionvalue_'.$i.'d"  placeholder="Enter Option" style="height:200px"></textarea>
                                        </div>
                                    </div>
                                </label>



                        <div class = "row">
                            <button class = "block" id="submit" name="submit_'.$i.'">SAVE</button>
                        </div>
                    </div>

                </form>
                </div>';

                echo $str;
            }
         ?>
</body>
</html>