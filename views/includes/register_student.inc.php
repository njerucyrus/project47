<?php
/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 5/23/17
 * Time: 3:42 PM
 */


$errorMsg = '';
$successMsg = '';

if (isset($_POST['first_name']) && isset($_POST['last_name'])
    && isset($_POST['gender']) && isset($_POST['reg_no'])
    && isset($_POST['kcpe']) && isset($_POST['stream']) && isset($_POST['class_joined'])
) {
    $student = new \Hudutech\Entity\Student();
    $student->setFirstName($_POST['first_name']);
    $student->setLastName($_POST['last_name']);
    $student->setOtherName($_POST['other_name']);
    $student->setGender($_POST['gender']);
    $student->setRegNo($_POST['reg_no']);
    $student->setClassJoined($_POST['class_joined']);
    $student->setStream($_POST['stream']);
    $student->setKcpe($_POST['kcpe']);
    // set other attributes to nulll
    $student->setDob(null);
    $student->setDateEnrolled(date('Y-m-d'));
    $student->setStatus('active');
    $student->setPhoneNumber(null);
    $student->setParentName(null);
    $student->setAddress(null);
    $student->setEmail(null);
    $student->setOccupation(null);

    $studentCtrl = new \Hudutech\Controller\StudentController();
    $created = $studentCtrl->createSingle($student);
    if ($created){
        $successMsg .= 'Student Registered Successfully';
    } else{
        $errorMsg .= 'Internal Server Error occurred Student Not Registered';
    }
}
else{
    $errorMsg .= 'Fill In the required fields';
}