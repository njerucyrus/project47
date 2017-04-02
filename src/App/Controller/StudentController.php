<?php
/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 4/1/17
 * Time: 11:33 PM
 */

namespace App\Controller;

require_once __DIR__.'/../DBManager/DB.php';
use App\AppInterface\StudentInterface;
use App\Entity\Student;


class StudentController implements StudentInterface
{
    /**
     * @param Student $student
     * @return mixed
     */
    public function createSingle(Student $student)
    {
        global $db, $conn;
        //get params
        $firstName = $student->getFirstName();
        $lastName = $student->getLastName();
        $otherName = $student->getOtherName();
        $regNo = $student->getRegNo();
        $currentClass = $student->getCurrentClass();
        $stream = $student->getStream();
        $dob = $student->getDob();
        $profileImage = $student->getProfileImage();
        $parentName = $student->getParentName();
        $occupation = $student->getOccupation();
        $dateEnrolled = $student->getDateEnrolled();

        try{
            $stmt = $conn->prepare("INSERT INTO students (
                                                            first_name,
                                                            last_name,
                                                            other_name,
                                                            reg_no,
                                                            current_class,
                                                            stream,
                                                            dob,
                                                            profile_image,
                                                            parent_name,
                                                            occupation,
                                                            date_enrolled
                                                          )
                                                          VALUES
                                                           (
                                                            :first_name,
                                                            :last_name,
                                                            :other_name,
                                                            :reg_no,
                                                            :current_class,
                                                            :stream,
                                                            :dob,
                                                            :profile_image,
                                                            :parent_name,
                                                            :occupation,
                                                            :date_enrolled
                                                           )");

            $stmt->bindParam(":first_name",$firstName);
            $stmt->bindParam(":last_name",$lastName);
            $stmt->bindParam(":other_name",$otherName);
            $stmt->bindParam(":reg_no",$regNo);
            $stmt->bindParam(":current_class",$currentClass);
            $stmt->bindParam(":stream", $stream);
            $stmt->bindParam(":dob",$dob);
            $stmt->bindParam(":profile_image", $profileImage);
            $stmt->bindParam(":parent_name",$parentName);
            $stmt->bindParam(":occupation",$occupation);
            $stmt->bindParam(":date_enrolled",$dateEnrolled);

            $stmt->execute();
            $db->closeConnection();
            return true;

        } catch (\PDOException  $exception){
            echo $exception->getMessage();
            return false;
        }

    }

    /**
     * @param array $students
     * @return mixed
     */
    public function createMultiple($students)
    {
        global $db, $conn;
        try{
            $stmt = $conn->prepare("INSERT INTO students (
                                                            first_name,
                                                            last_name,
                                                            other_name,
                                                            reg_no,
                                                            current_class,
                                                            stream,
                                                            dob,
                                                            profile_image,
                                                            parent_name,
                                                            occupation,
                                                            date_enrolled
                                                          )
                                                          VALUES
                                                           (
                                                            :first_name,
                                                            :last_name,
                                                            :other_name,
                                                            :reg_no,
                                                            :current_class,
                                                            :stream,
                                                            :dob,
                                                            :profile_image,
                                                            :parent_name,
                                                            :occupation,
                                                            :date_enrolled
                                                           )");


            // loop through the array and bind get param value
            foreach ($students as $student){

                $stmt->bindParam(":first_name",$firstName);
                $stmt->bindParam(":last_name",$lastName);
                $stmt->bindParam(":other_name",$otherName);
                $stmt->bindParam(":reg_no",$regNo);
                $stmt->bindParam(":current_class",$currentClass);
                $stmt->bindParam(":stream", $stream);
                $stmt->bindParam(":dob",$dob);
                $stmt->bindParam(":profile_image", $profileImage);
                $stmt->bindParam(":parent_name",$parentName);
                $stmt->bindParam(":occupation",$occupation);
                $stmt->bindParam(":date_enrolled",$dateEnrolled);

                $firstName = $student['first_name'];
                $lastName = $student['last_name'];
                $otherName = $student['other_name'];
                $regNo = $student['reg_no'];
                $currentClass = $student['current_class'];
                $stream = $student['stream'];
                $dob = $student['dob'];
                $profileImage = $student['profile_image'];
                $parentName = $student['parent_name'];
                $occupation = $student['occupation'];
                $dateEnrolled = $student['date_enrolled'];
                $stmt->execute();


            }



            $db->closeConnection();
            return true;

        } catch (\PDOException  $exception){
            echo $exception->getMessage();
            return false;
        }



    }

    /**
     * @param Student $student
     * @param $id
     * @return mixed
     */
    public function update(Student $student, $id)
    {
        global $db, $conn;
        $firstName = $student->getFirstName();
        $lastName = $student->getLastName();
        $otherName = $student->getOtherName();
        $regNo = $student->getRegNo();
        $currentClass = $student->getCurrentClass();
        $stream = $student->getStream();
        $dob = $student->getDob();
        $profileImage = $student->getProfileImage();
        $parentName = $student->getParentName();
        $occupation = $student->getOccupation();
        $dateEnrolled = $student->getDateEnrolled();

        $stmt = $conn->prepare("UPDATE students SET 
                                                    first_name=:first_name,
                                                    last_name=:last_name,
                                                    other_name=:other_name,
                                                    reg_no=:reg_no,
                                                    current_class=:current_class,
                                                    stream=:stream,
                                                    dob=:dob,
                                                    profile_image=:profile_image,
                                                    parent_name=:parent_name,
                                                    occupation=:occupation,
                                                    date_enrolled=:date_enrolled
                                                WHERE
                                                    id=:id
                                                ");


        $stmt->bindParam(":id",$id);
        $stmt->bindParam(":first_name",$firstName);
        $stmt->bindParam(":last_name",$lastName);
        $stmt->bindParam(":other_name",$otherName);
        $stmt->bindParam(":reg_no",$regNo);
        $stmt->bindParam(":current_class",$currentClass);
        $stmt->bindParam(":stream", $stream);
        $stmt->bindParam(":dob",$dob);
        $stmt->bindParam(":profile_image", $profileImage);
        $stmt->bindParam(":parent_name",$parentName);
        $stmt->bindParam(":occupation",$occupation);
        $stmt->bindParam(":date_enrolled",$dateEnrolled);

        $stmt->execute();
        $db->closeConnection();
        return true;
    }

    /**
     * @param $id
     * @return bool
     */
    public static function delete($id)
    {
        // TODO: Implement delete() method.
    }

    /**
     * @return bool
     */
    public static function destroy()
    {
        // TODO: Implement destroy() method.
    }

    /**
     * @return mixed
     */
    public static function getId()
    {
        // TODO: Implement getId() method.
    }

    /**
     * @return mixed
     */
    public static function all()
    {
        // TODO: Implement all() method.
    }

}