<?php
/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 5/23/17
 * Time: 3:42 PM
 */


$errorMsg = '';
$successMsg = '';
if(!empty($_POST['reg_no'])) {
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
        // set other attributes to null
        $student->setDob(isset($_POST['dob']) ? $_POST['dob'] : null);
        $student->setDateEnrolled(date("Y-m-d"));
        $student->setStatus('active');
        $student->setPhoneNumber(isset($_POST['phone_number']) ? $_POST['phone_number'] : null);
        $student->setParentName(isset($_POST['parent_name']) ? $_POST['parent_name'] : null);
        $student->setAddress(isset($_POST['address']) ? $_POST['address'] : null);
        $student->setEmail(isset($_POST['email']) ? $_POST['email'] : null);
        $student->setOccupation(isset($_POST['occupation']) ? $_POST['occupation'] : null);

        $student->setProfileImage(isset($_POST['profile_image'])?$_POST['profile_image']:null);
        $student->setCurrentClass(isset($_POST['current_class'])?$_POST['current_class']:null);


        $studentCtrl = new \Hudutech\Controller\StudentController();
        $created = $studentCtrl->createSingle($student);
        if ($created) {
            $successMsg .= 'Student Registered Successfully';
        } else {
            $errorMsg .= 'Internal Server Error occurred Student Not Registered';
        }
    } else {
        $errorMsg .= 'Fill In the required fields';
    }
}