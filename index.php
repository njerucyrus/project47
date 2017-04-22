<?php
/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 4/8/17
 * Time: 11:31 PM
 */

require_once __DIR__.'/vendor/autoload.php';
//
//$grade = array(
//    array("low_mark"=>67, "high_mark"=>70, "grade"=>"B", "comment"=>"excellent"),
//    array("low_mark"=>71, "high_mark"=>74, "grade"=>"B+", "comment"=>"excellent"),
//    array("low_mark"=>75, "high_mark"=>80, "grade"=>"A-", "comment"=>"excellent"),
//    array("low_mark"=>81, "high_mark"=>100, "grade"=>"A", "comment"=>"excellent")
//);
//
//$ctrl = \Hudutech\Controller\GradingSystemController::getGrade(101);
//
//print_r($ctrl);

//$ctrl = \Hudutech\Controller\ExamTableController::createStandardExamTables();
//$ctrl = \Hudutech\Controller\ExamTableController::clearStandardExamTables();

$ctrl = \Hudutech\Controller\ExamTableController::createScoreSheetTables();
//$config = array("student_class"=>"FORM 4", "term"=>"TERM 1", "year"=>2017, "subject"=>"english");
//$ctrl = \Hudutech\Controller\ExamController::enrollStudentForExam($config);
$config = array(
    "year"=>2017,
    "term"=>"TERM 1",
    "student_class"=>"FORM 4",
    "subject"=>"Kiswahili",
    "reg_no"=> \Hudutech\Controller\MarksGradingController::getScoreSheetRegNo(2017, 'TERM 1', 'FORM 4')
);
//$ctrl = \Hudutech\Controller\SubjectGradingController::updateScoreSheet($config);
//print_r($ctrl);

//$ctrl = \Hudutech\Controller\MarksGradingController::getScoreSheetTotal($config);
 echo $ctrl = \Hudutech\Controller\MarksGradingController::updateScoreSheetTotals($config);



//$ctrl = \Hudutech\Controller\SubjectGradingController::updateStandardExamTotals($config);
//
//$a = array(130, 1805, 1337);
//arsort($a);
//print_r(($a));


