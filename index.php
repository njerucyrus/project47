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

$ctrl = \Hudutech\Controller\ExamTableController::fetchStandardExamTableNames();
print_r($ctrl);

