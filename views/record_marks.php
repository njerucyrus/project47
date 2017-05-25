<?php

/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 5/24/17
 * Time: 1:41 PM
 */
require_once __DIR__ . '/../vendor/autoload.php';
$subjects = \Hudutech\Controller\SubjectController::all();
$students = [];
if (!empty($_POST['subject_id']) and !empty($_POST['student_class'])
    and isset($_POST['stream']) and !empty($_POST['term'])
) {
//    $_SESSION['subject_id'] = $_POST['subject_id'];
//    $_SESSION['student_class'] = $_POST['student_class'];
//    $_SESSION['term'] = $_POST['term'];

    $config = array(
        "subject_id" => $_POST['subject_id'],
        "student_class" => $_POST['student_class'],
        "stream" => $_POST['stream']
    );

}

?>
<!DOCTYPE html>
<html>
<head>

    <link rel="stylesheet" media="screen" href="../bower_components/handsontable/dist/handsontable.full.css">
    <script src="../bower_components/handsontable/dist/handsontable.full.js"></script>
    <?php include "head_views.php" ?>
    <style>
        /* Selected cell */
        /*.ht_master tr > td.current {*/
        /*background-color: #F00;*/
        /*}*/

        /*!* Specific cell (B2) *!*/
        /*.ht_master tr:nth-child(2) > td:nth-child(3) {*/
        /*background-color: #F00;*/
        /*}*/

        /*!*!* Edit mode *!*!*/
        /*!*.handsontableInput {*!*/
        /*!*background-color: #F00!important;*!*/
        /*!*}*!*/

        .currentRow {
            /*background-color: #F9F9FB !important;*/
            background-color: #b6d6e4!important;
        }
        .currentCol {
            /*background-color: #E7E8EF !important;*/
            background-color: #b6d6e4!important;
        }
    </style>
    <title>Marks Entry</title>
</head>

<body class="page-body skin-facebook">
<div class="page-container">
    <?php include 'right_menu_views.php' ?>
    <div class="main-content">
        <?php include 'header_menu.php' ?>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-primary" data-collapsed="0">

                    <div class="panel-heading">
                        <div class="panel-title col-md-offset-3">
                            <h3>Student Marks Entry</h3>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="col col-md-8">
                            <fieldset>
                                <legend><i class="entypo-cog"></i>Exam Marks Settings</legend>
                                <form role="form" class="form-horizontal form-groups-bordered">
                                    <div class="col-md-2" style="margin-left: 5px;">
                                        <div class="form-group">
                                            <select class="form-control" name="student_class">
                                                <option>FORM 1</option>
                                                <option>FORM 2</option>
                                                <option>FORM 3</option>
                                                <option>FORM 4</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2" style="margin-left: 5px;">
                                        <div class="form-group">
                                            <select class="form-control" name="stream">
                                                <option>Stream A</option>
                                                <option>Stream B</option>
                                                <option>Stream C</option>
                                                <option>Stream D</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-3" style="margin-left: 5px;">
                                        <div class="form-group">
                                            <select class="form-control" name="subject">
                                                <option>Select Subject</option>
                                                <?php foreach ($subjects as $subject): ?>
                                                    <option value="<?php echo $subjects['subject_name'] ?>">
                                                        <?php echo "{$subject['subject_code']}  {$subject['subject_name']}" ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-2" style="margin-left: 5px;">
                                        <div class="form-group">
                                            <select class="form-control" name="term">
                                                <option>Term 1</option>
                                                <option>Term 2</option>
                                                <option>Term 3</option>
                                            </select>
                                        </div>
                                    </div>
                                </form>
                                <button class="btn btn-primary btn-blue" style="margin-left: 5px;" onclick="getData()">Submit</button>
                            </fieldset>
                            <hr/>
                        </div>
                        <hr/>


                        <div class="col col-md-12" style="margin:15px; font-size: 16px; color: black;">
                            <div id="scoreSheet" class="hot handsontable htColumnHeaders" style="color: #000;">
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
<?php include 'footer_views.php'?>

    <script>
        marksValidator = function (value, callback) {
           setTimeout(function () {
               if ( parseFloat(value)>=0 && parseFloat(value) <=100) {
                   callback(true);
               }else{
                   callback(false);
               }
           }, 100)
        };
        function getData() {
            var data;
            var url = "studentsforexam.php";
           $.ajax(
               {
                   type: 'GET',
                   url: url,
                   dataType: 'json',
                   contentType: 'application/json',
                   async:false,
                   traditional: true,
                   success : function (response) {
                       data = response;
                   }

               }
           );
           return data;
        }


        var container = document.getElementById('scoreSheet');
        var hot = new Handsontable(container, {
            colHeaders: ["Admission Number", "Student Name", "PP1", "PP2", "PP3"],
            data: getData(),
            //width: 1200,
            height: 800,
            rowHeaders: true,
            //colHeaders: true,
            colWidths: [150, 380, 100, 100, 100],
            currentRowClassName: 'currentRow',
            currentColClassName: 'currentCol',
            //columnSortingue : tr,
            columns: [
                {
                    data: 'reg_no',
                    readOnly: true
                },
                {
                    data: 'full_name',
                    readOnly: true
                },

                {
                    data: 'pp1',
                    type: 'numeric',
                    validator: marksValidator,allowInvalid: true

                },
                {
                    data: 'pp2',
                    type: 'numeric'

                },

                {
                    data: 'pp3',
                    type: 'numeric'

                }


            ]


        });


    </script>

</body>
</html>

