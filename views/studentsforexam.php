<?php
/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 5/24/17
 * Time: 10:51 PM
 */
require_once __DIR__.'/../vendor/autoload.php';

$config = array(
    "subject_id" => 1,
    "student_class" => "FORM 4",
    "stream" => "EAST"
);

$students = \Hudutech\Controller\ExamController::getStudentsForExam($config);
print_r(json_encode($students));