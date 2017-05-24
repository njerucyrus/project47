<?php
/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 5/24/17
 * Time: 1:41 PM
 */
require_once __DIR__ . '/../vendor/autoload.php';
$subjects = \Hudutech\Controller\SubjectController::all();

?>
<!DOCTYPE html>
<html>
<head>

    <link rel="stylesheet" media="screen" href="../bower_components/handsontable/dist/handsontable.full.css">
    <script src="../bower_components/handsontable/dist/handsontable.full.js"></script>
    <?php include "head.php" ?>
    <title>Marks Entry</title>
</head>

<body class="page-body skin-facebook">
<div class="page-container">
    <?php include 'sidebar.php' ?>
    <div class="main-content">
        <?php include 'navbar.php' ?>
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
                                    <input type="submit" value="Submit" class="btn btn-primary btn-blue "
                                           style="margin-left: 5px;">
                                </form>
                            </fieldset>
                        </div>
                        <hr/>
                    </div>

                    <div class="row">
                        <div class="col col-md-12" style="margin: 10px;">
                            <div id="scoreSheet">
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


    <script>
        var data = [
            ["AdmNo", "FullName", "Paper1 Marks", "Paper2 Marks", "Paper3 Marks"],
            ["2016", "jdhjdjfjdfjf", 11, 12, 13],
            ["2016", "jdhjdjfjdfjf", 11, 12, 13],
            ["2016", "jdhjdjfjdfjf", 11, 12, 13],
            ["2016", "jdhjdjfjdfjf", 11, 12, 13]

        ];

        var container = document.getElementById('scoreSheet');
        var hot = new Handsontable(container, {
            data: data,
            width: 1200,
            rowHeaders: true,
            colHeaders: true,
            cells: function(row, col, prop){
                var cellProperties = {};
                if(col !== 3 && col !== 4){
                    cellProperties.readOnly = 'true'
                }
                return cellProperties
            }

        });

    </script>

</body>
</html>

