<?php
/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 4/1/17
 * Time: 11:33 PM
 */
namespace Hudutech\Controller;

use Hudutech\DBManager\DB;
use Hudutech\AppInterface\StudentInterface;
use Hudutech\Entity\Student;


class StudentController implements StudentInterface
{
    /**
     * @param Student $student
     * @return mixed
     */
    public function createSingle(Student $student)
    {
        $db = new DB();
        $conn = $db->connect();

        //get params
        $firstName = $student->getFirstName();
        $lastName = $student->getLastName();
        $otherName = $student->getOtherName();
        $gender = $student->getGender();
        $regNo = $student->getRegNo();
        $currentClass = $student->getCurrentClass();
        $stream = $student->getStream();
        $dob = $student->getDob();
        $profileImage = $student->getProfileImage();
        $parentName = $student->getParentName();
        $occupation = $student->getOccupation();
        $dateEnrolled = $student->getDateEnrolled();

        try {
            $stmt = $conn->prepare("INSERT INTO students (
                                                            first_name,
                                                            last_name,
                                                            other_name,
                                                            gender,
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
                                                            :gender,
                                                            :reg_no,
                                                            :current_class,
                                                            :stream,
                                                            :dob,
                                                            :profile_image,
                                                            :parent_name,
                                                            :occupation,
                                                            :date_enrolled
                                                           )");

            $stmt->bindParam(":first_name", $firstName);
            $stmt->bindParam(":last_name", $lastName);
            $stmt->bindParam(":other_name", $otherName);
            $stmt->bindParam(":gender", $gender);
            $stmt->bindParam(":reg_no", $regNo);
            $stmt->bindParam(":current_class", $currentClass);
            $stmt->bindParam(":stream", $stream);
            $stmt->bindParam(":dob", $dob);
            $stmt->bindParam(":profile_image", $profileImage);
            $stmt->bindParam(":parent_name", $parentName);
            $stmt->bindParam(":occupation", $occupation);
            $stmt->bindParam(":date_enrolled", $dateEnrolled);

            $stmt->execute();
            $db->closeConnection();
            return true;

        } catch (\PDOException  $exception) {
            echo $exception->getMessage();
            return false;
        }

    }

    /**
     * @param array $students
     * @return mixed
     */
    public function createMultiple(array $students)
    {
        $db = new DB();
        $conn = $db->connect();
        try {
            $stmt = $conn->prepare("INSERT INTO students (
                                                            first_name,
                                                            last_name,
                                                            other_name,
                                                            gender,
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
                                                            :gender,
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
            foreach ($students as $student) {

                $stmt->bindParam(":first_name", $firstName);
                $stmt->bindParam(":last_name", $lastName);
                $stmt->bindParam(":other_name", $otherName);
                $stmt->bindParam(":gender", $gender);
                $stmt->bindParam(":reg_no", $regNo);
                $stmt->bindParam(":current_class", $currentClass);
                $stmt->bindParam(":stream", $stream);
                $stmt->bindParam(":dob", $dob);
                $stmt->bindParam(":profile_image", $profileImage);
                $stmt->bindParam(":parent_name", $parentName);
                $stmt->bindParam(":occupation", $occupation);
                $stmt->bindParam(":date_enrolled", $dateEnrolled);

                $firstName = $student['first_name'];
                $lastName = $student['last_name'];
                $otherName = $student['other_name'];
                $gender = $student['gender'];
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

        } catch (\PDOException  $exception) {
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
        $db = new DB();
        $conn = $db->connect();

        $firstName = $student->getFirstName();
        $lastName = $student->getLastName();
        $otherName = $student->getOtherName();
        $gender = $student->getGender();
        $regNo = $student->getRegNo();
        $currentClass = $student->getCurrentClass();
        $stream = $student->getStream();
        $dob = $student->getDob();
        $profileImage = $student->getProfileImage();
        $parentName = $student->getParentName();
        $occupation = $student->getOccupation();
        $dateEnrolled = $student->getDateEnrolled();

        try {
            $stmt = $conn->prepare("UPDATE students SET 
                                                    first_name=:first_name,
                                                    last_name=:last_name,
                                                    other_name=:other_name,
                                                    gender=:gender,
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


            $stmt->bindParam(":id", $id);
            $stmt->bindParam(":first_name", $firstName);
            $stmt->bindParam(":last_name", $lastName);
            $stmt->bindParam(":other_name", $otherName);
            $stmt->bindParam(":gender", $gender);
            $stmt->bindParam(":reg_no", $regNo);
            $stmt->bindParam(":current_class", $currentClass);
            $stmt->bindParam(":stream", $stream);
            $stmt->bindParam(":dob", $dob);
            $stmt->bindParam(":profile_image", $profileImage);
            $stmt->bindParam(":parent_name", $parentName);
            $stmt->bindParam(":occupation", $occupation);
            $stmt->bindParam(":date_enrolled", $dateEnrolled);

            $stmt->execute();
            $db->closeConnection();
            return true;
        } catch (\PDOException $exception) {
            echo $exception->getMessage();
            return false;
        }
    }

    /**
     * @param $id
     * @return bool
     */
    public static function delete($id)
    {
        $db = new DB();
        $conn = $db->connect();
        try {
            $stmt = $conn->prepare("DELETE FROM students WHERE id=:id");
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            $db->closeConnection();
            return true;
        } catch (\PDOException $exception) {
            echo $exception->getMessage();
            return false;
        }

    }

    /**
     * @return bool
     */
    public static function destroy()
    {
        $db = new DB();
        $conn = $db->connect();
        try {
            $stmt = $conn->prepare("DELETE FROM students");
            $stmt->execute();
            $db->closeConnection();
            return true;
        } catch (\PDOException $exception) {
            echo $exception->getMessage();
            return false;
        }
    }

    /**
     * @param int $id
     * @return array
     */
    public static function getId($id)
    {
        $db = new DB();
        $conn = $db->connect();

        try {
            $stmt = $conn->prepare("SELECT * FROM students WHERE id=:id");
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            if ($stmt->rowCount() == 1) {

                $row = $stmt->fetch(\PDO::FETCH_ASSOC);

                $student = array(
                    "id" => $row['id'],
                    "first_name" => $row['first_name'],
                    "last_name" => $row['last_name'],
                    "other_name" => $row['other_name'],
                    "gender" =>$row['gender'],
                    "reg_no" => $row['reg_no'],
                    "current_class" => $row['current_class'],
                    "stream" => $row['stream'],
                    "dob" => $row['dob'],
                    "profile_image" => $row['profile_image'],
                    "parent_name" => $row['parent_name'],
                    "occupation" => $row['occupation'],
                    "date_enrolled" => $row['date_enrolled']

                );
                $db->closeConnection();

                return $student;
            } else {
                return [];
            }

        } catch (\PDOException $exception) {
            echo $exception->getMessage();
            return [];
        }
    }


    /**
     * @return array
     */
    public static function all()
    {
        $db = new DB();
        $conn = $db->connect();

        try {
            $stmt = $conn->prepare("SELECT * FROM  students WHERE 1");
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                $students = array();
                while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
                    $student = array(
                        "id" => $row['id'],
                        "first_name" => $row['first_name'],
                        "last_name" => $row['last_name'],
                        "other_name" => $row['other_name'],
                        "gender" => $row['gender'],
                        "reg_no" => $row['reg_no'],
                        "current_class" => $row['current_class'],
                        "stream" => $row['stream'],
                        "dob" => $row['dob'],
                        "profile_image" => $row['profile_image'],
                        "parent_name" => $row['parent_name'],
                        "occupation" => $row['occupation'],
                        "date_enrolled" => $row['date_enrolled']
                    );
                    $students[] = $student;
                }
                $db->closeConnection();
                return $students;
            }
            else{
                return [];
            }
        } catch (\PDOException $exception) {
            echo $exception->getMessage();
            return [];
        }
    }

    /**
     * @param $id
     * @return Student|null
     */
    public static function getStudent($id)
    {
        global $db, $conn;

        try {
            $stmt = $conn->prepare("SELECT * FROM students WHERE id=:id");
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            if ($stmt->rowCount() == 1) {
                $student = new Student();
                $row = $stmt->fetch(\PDO::FETCH_ASSOC);
                $student->setId($row['id']);
                $student->setFirstName($row['first_name']);
                $student->setLastName($row['last_name']);
                $student->setOtherName($row['other_name']);
                $student->setGender($row['gender']);
                $student->setRegNo($row['reg_no']);
                $student->setCurrentClass($row['current_class']);
                $student->setStream($row['stream']);
                $student->setDob($row['dob']);
                $student->setProfileImage($row['profile_image']);
                $student->setParentName($row['parent_name']);
                $student->setOccupation($row['occupation']);
                $student->setDateEnrolled($row['date_enrolled']);
                $db->closeConnection();
                return $student;
            } else {
                return null;
            }

        } catch (\PDOException $exception) {
            echo $exception->getMessage();
            return null;
        }
    }

}