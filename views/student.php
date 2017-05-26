<?php
/**
 * Created by PhpStorm.
 * User: New LAptop
 * Date: 25/05/2017
 * Time: 10:05
 */
require_once '../vendor/autoload.php';
$students= Hudutech\Controller\StudentController::all();
$counter=1;
?>

<!DOCTYPE html>
<html>
<head>
    <?php include 'head_views.php' ?>
    <title>E-School | Student List</title>
</head>
<body class="page-body skin-facebook">
<div class="page-container">
    <?php include 'right_menu_views.php'; ?>
    <div class="main-content">
        <?php include 'header_menu_views.php' ?>
        <div class="panel panel-primary" data-collapsed="0">
            <div class="container-fluid">

                <div class="col col-md-12">
                    <div class="table-responsive" style="margin-top: 15px;">
                        <table class="table table-bordered" id="studentTable">
                            <h3>Showing Registered Students</h3>
                            <hr/>
                            <thead>
                            <tr class="bg-info">
                                <th>#</th>
                                <th style="color: black">Reg No</th>
                                <th style="color: black">Full Name</th>
                                <th style="color: black">Gender</th>
                                <th style="color: black">Current Class</th>
                                <th style="color: black">Stream</th>
                                <th style="color: black">KCPE</th>
                                <th style="color: black">Status</th>
                                <th style="color: black">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($students as $student): ?>
                                <tr>
                                    <td><?php echo $counter++ ?></td>
                                    <td><?php echo $student['reg_no'] ?></td>
                                    <td><?php echo $student['first_name'] . " " . $student['other_name'] . " " . $student['last_name']; ?></td>
                                    <td><?php echo $student['gender'] ?></td>
                                    <td><?php echo $student['current_class'] ?></td>
                                    <td><?php echo $student['stream'] ?></td>
                                    <td><?php echo $student['kcpe'] ?></td>
                                    <td><?php echo $student['status'] ?></td>

                                    <td>
                                        <button class="btn btn-primary btn-blue"
                                                onclick="updatePatient(
                                                    '<?php echo $patient['id'] ?>',
                                                    '<?php echo $patient['surName'] ?>',
                                                    '<?php echo $patient['phoneNumber'] ?>',
                                                    '<?php echo $patient['patientType'] ?>',
                                                    '<?php echo $patient['sex'] ?>',
                                                    '<?php echo $patient['age'] ?>',
                                                    '<?php echo $patient['patientId'] ?>'
                                                    )"><i class="entypo-pencil"></i>Edit
                                        </button>
                                        <button class="btn btn-danger  btn-red"
                                                onclick="deletePatient('<?php echo $patient['id'] ?>')"><i
                                                class="entypo-cancel"></i>Delete
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<?php include_once 'footer_views.php'?>
</body>
</html>