<?php
/**
 * Created by PhpStorm.
 * User: New LAptop
 * Date: 25/05/2017
 * Time: 15:29
 */

include_once '../vendor/autoload.php';
$teachers = Hudutech\Controller\TeacherController::all();


$counter=1;
?>
<!DOCTYPE html>
<html>
<head>
    <?php include 'head_views.php' ?>
    <title>E-School | Teachers List</title>
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
                        <table class="table table-bordered" id="teacherTable">
                            <h3>Showing Registered Teachers</h3>
                            <hr/>
                            <thead>
                            <tr class="bg-info">
                                <th>#</th>
                                <th style="color: black">TSC No</th>
                                <th style="color: black">Full Name</th>
                                <th style="color: black">National ID</th>
                                <th style="color: black">Speciality</th>
                                <th style="color: black">Gender</th>
                                <th style="color: black">Date Registered</th>
                                <th style="color: black">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($teachers as $teacher): ?>
                                <tr>
                                    <td><?php echo $counter++ ?></td>
                                    <td><?php echo $teacher['tsc_no'] ?></td>
                                    <td><?php echo $teacher['sir_name'] . " " . $teacher['middle_name'] . " " . $teacher['last_name']; ?></td>
                                    <td><?php echo $teacher['national_id'] ?></td>
                                    <td><?php echo $teacher['speciality'] ?></td>
                                    <td><?php echo $teacher['gender'] ?></td>
                                    <td><?php echo $teacher['date_registered'] ?></td>


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
