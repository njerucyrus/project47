<?php
/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 5/23/17
 * Time: 3:44 PM
 */


$errorMsg = '';
$successMsg = '';

if (isset($_POST['sir_name'])
    and isset($_POST['middle_name'])
    and isset($_POST['last_name'])
    and isset($_POST['tsc_no'])
    and isset($_POST['national_id'])
    and isset($_POST['speciality'])
    and isset($_POST['gender'])
) {
    $teacher = new \Hudutech\Entity\Teacher();
    $teacher->setSirName($_POST['sir_name']);
    $teacher->setMiddleName($_POST['middle_name']);
    $teacher->setLastName($_POST['last_name']);
    $teacher->setTscNo($_POST['tsc_no']);
    $teacher->setNationalId($_POST['national_id']);
    $teacher->setSpeciality($_POST['speciality']);
    $teacher->setGender($_POST['gender']);
    $teacher->setDateRegistered(date('Y-m-d'));

    $teacherCtrl = new \Hudutech\Controller\TeacherController();
    $created = $teacherCtrl->createSingle($teacher);
    if ($created) {
        $fullName = $_POST['sir_name'] . " ". $_POST['middle_name'] ." ".$_POST['last_name'];
        $successMsg .= "{$fullName} Registered as a teacher";
    } else{
        $errorMsg .="Internal Server error occurred Teacher was not registered";
    }
} else{
    $errorMsg .= "All fields required";
}