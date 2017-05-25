<?php
/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 5/23/17
 * Time: 3:45 PM
 */

$errorMsg = '';
$successMsg = '';
if (isset($_POST['subject_code'])
    and isset($_POST['subject_name'])
    and isset($_POST['subject_group'])
    and isset($_POST['is_compulsory'])
    and isset($_POST['has_pp3'])

) {
    $subject = new \Hudutech\Entity\Subject();
    $subject->setSubjectCode($_POST['subject_code']);
    $subject->setSubjectName($_POST['subject_name']);
    $subject->setSubjectGroup($_POST['subject_group']);
    $subject->setCompulsory((bool)$_POST['is_compulsory']);
    $subject->setActive(true);
    $subject->setHasPP3((bool)$_POST['has_pp3']);

    $subjectCtrl = new \Hudutech\Controller\SubjectController();
    $created = $subjectCtrl->createSingle($subject);
    if ($created) {
        $successMsg .='Subject Registered Successfully';
    } else{
        $errorMsg .='Internal Server Error occurred Subject Not Registered';
    }
} else{
    $errorMsg .="All fields Required";
}

