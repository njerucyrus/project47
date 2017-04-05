<?
/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 4/2/17
 * Time: 12:34 AM
 */

require_once "vendor/autoload.php";

//$student1 = array(
//    "first_name" => "JOHN",
//    "last_name" => "NJIIRI",
//    "other_name" => "KIMEMIA",
//    "gender" => "F",
//    "reg_no"=> "C026-38373",
//    "current_class"=> "FORM 1",
//    "class_joined"=>"FORM 1",
//    "stream"=>"EAST",
//    "dob"=>date('Y-m-d'),
//    "profile_image"=> "path/to/profile-photo/",
//    "parent_name"=>"MR NJIIRI",
//    "phone_number"=>"+254716254515",
//    "address"=>"POBOX 47484 MURANG'A",
//    "email"=>"mail@example.com",
//    "occupation"=> "farmer",
//    "date_enrolled"=>date('Y-m-d'),
//    "status"=>"active"
//);
//
//$student2 = array(
//    "first_name" => "JOHN",
//    "last_name" => "NJIIRI",
//    "other_name" => "KIMEMIA",
//    "gender" => "F",
//    "reg_no"=> "C026-38373",
//    "current_class"=> "FORM 1",
//    "class_joined"=>"FORM 1",
//    "stream"=>"EAST",
//    "dob"=>date('Y-m-d'),
//    "profile_image"=> "path/to/profile-photo/",
//    "parent_name"=>"MR NJIIRI",
//    "phone_number"=>"+254716254515",
//    "address"=>"POBOX 47484 MURANG'A",
//    "email"=>"mail@example.com",
//    "occupation"=> "farmer",
//    "date_enrolled"=>date('Y-m-d'),
//    "status"=>"active"
//);
//
//$student3 = array(
//    "first_name" => "JOHN",
//    "last_name" => "NJIIRI",
//    "other_name" => "KIMEMIA",
//    "gender" => "F",
//    "reg_no"=> "C026-38373",
//    "current_class"=> "FORM 1",
//    "class_joined"=>"FORM 1",
//    "stream"=>"EAST",
//    "dob"=>date('Y-m-d'),
//    "profile_image"=> "path/to/profile-photo/",
//    "parent_name"=>"MR NJIIRI",
//    "phone_number"=>"+254716254515",
//    "address"=>"POBOX 47484 MURANG'A",
//    "email"=>"mail@example.com",
//    "occupation"=> "farmer",
//    "date_enrolled"=>date('Y-m-d'),
//    "status"=>"active"
//);
//$student4 = array(
//    "first_name" => "JOHN",
//    "last_name" => "NJIIRI",
//    "other_name" => "KIMEMIA",
//    "gender" => "F",
//    "reg_no"=> "C026-38373",
//    "current_class"=> "FORM 1",
//    "class_joined"=>"FORM 1",
//    "stream"=>"EAST",
//    "dob"=>date('Y-m-d'),
//    "profile_image"=> "path/to/profile-photo/",
//    "parent_name"=>"MR NJIIRI",
//    "phone_number"=>"+254716254515",
//    "address"=>"POBOX 47484 MURANG'A",
//    "email"=>"mail@example.com",
//    "occupation"=> "farmer",
//    "date_enrolled"=>date('Y-m-d'),
//    "status"=>"active"
//);
//
//$students = array();
//array_push($students, $student1, $student2, $student3, $student4);
//
//$student_controller = new \Hudutech\Controller\StudentController();
//$created = $student_controller->createMultiple($students);
//
//if ($created){
//    echo "created multiple students";
//
//}
//else{
//    echo "en countered an error";
//}
$students = array("C026-01", "C026-02", "C026-03", "C026-04", "C026-05");
$class = "FORM 4";

//$student_controller = new \Hudutech\Controller\StudentController();
//$promoted = $student_controller->promoteToNextClass($students, $class);
//
//if($promoted){
//    echo "code doing fine";
//}
//else{
//    echo "ko";
//}

$students = \Hudutech\Controller\StudentController::all();
print_r($students);