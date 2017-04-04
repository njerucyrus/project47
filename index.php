<?
/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 4/2/17
 * Time: 12:34 AM
 */

require_once "vendor/autoload.php";

$student = \Hudutech\Controller\StudentController::all();
print_r($student);
$studentObject = \Hudutech\Controller\StudentController::getStudent(1);

print_r($studentObject);