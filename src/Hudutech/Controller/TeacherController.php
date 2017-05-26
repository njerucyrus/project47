<?php
/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 4/2/17
 * Time: 6:08 PM
 */

namespace Hudutech\Controller;

use Hudutech\DBManager\DB;
use Hudutech\AppInterface\TeacherInterface;
use Hudutech\Entity\Teacher;

class TeacherController implements TeacherInterface
{
    /**
     * @param Teacher $teacher
     * @return mixed
     */
    public function createSingle(Teacher $teacher)
    {
        $db = new DB();
        $conn = $db->connect();

        $sirName = $teacher->getSirName();
        $middleName = $teacher->getMiddleName();
        $lastName = $teacher->getLastName();
        $tscNo = $teacher->getTscNo();
        $nationalId = $teacher->getNationalId();
        $speciality = $teacher->getSpeciality();
        $gender = $teacher->getGender();
        $dateRegistered = $teacher->getDateRegistered();

        try {

            $stmt = $conn->prepare("INSERT INTO teachers(
                                                            sir_name,
                                                            middle_name,
                                                            last_name,
                                                            tsc_no,
                                                            national_id,
                                                            speciality,
                                                            gender, 
                                                            date_registered
                                                        )
                                                        VALUES
                                                         (
                                                            :sir_name,
                                                            :middle_name,
                                                            :last_name,
                                                            :tsc_no,
                                                            :national_id,
                                                            :speciality,
                                                            :gender, 
                                                            :date_registered
                                                          )");

            $stmt->bindParam(":sir_name", $sirName);
            $stmt->bindParam(":middle_name", $middleName);
            $stmt->bindParam(":last_name", $lastName);
            $stmt->bindParam(":tsc_no", $tscNo);
            $stmt->bindParam(":national_id", $nationalId);
            $stmt->bindParam(":speciality", $speciality);
            $stmt->bindParam(":gender", $gender);
            $stmt->bindParam(":date_registered", $dateRegistered);
            $stmt->execute();
            $db->closeConnection();
            return true;
        } catch (\PDOException $exception) {
            echo $exception->getMessage();
            return false;
        }
    }

    /**
     * @param array $teachers
     * @return mixed
     */
    public function createMultiple(array $teachers)
    {
        $db = new DB();
        $conn = $db->connect();
        try {
            $stmt = $conn->prepare("INSERT INTO teachers(
                                                            sir_name,
                                                            middle_name,
                                                            last_name,
                                                            tsc_no,
                                                            national_id,
                                                            speciality,
                                                            gender, 
                                                            date_registered
                                                     )
                                                    VALUES(
                                                            :sir_name,
                                                            :middle_name,
                                                            :last_name,
                                                            :tsc_no,
                                                            :national_id,
                                                            :speciality,
                                                            :gender, 
                                                            :date_registered
                                                          )");

            foreach ($teachers as $teacher) {
                $stmt->bindParam(":sir_name", $sirName);
                $stmt->bindParam(":middle_name", $middleName);
                $stmt->bindParam(":last_name", $lastName);
                $stmt->bindParam(":tsc_no", $tscNo);
                $stmt->bindParam(":national_id", $nationalId);
                $stmt->bindParam(":speciality", $speciality);
                $stmt->bindParam(":gender", $gender);
                $stmt->bindParam(":date_registered", $dateRegistered);

                $sirName = $teacher['sir_name'];
                $middleName = $teacher['middle_name'];
                $lastName = $teacher['last_name'];
                $tscNo = $teacher['tsc_no'];
                $nationalId = $teacher['national_id'];
                $speciality = $teacher['speciality'];
                $gender = $teacher['gender'];
                $dateRegistered = $teacher['date_registered'];
                $stmt->execute();
            }
            $db->closeConnection();
            return true;
        } catch (\PDOException $exception) {
            echo $exception->getMessage();
            return false;
        }
    }

    /**
     * @param Teacher $teacher
     * @param $id
     * @return bool
     */
    public function update(Teacher $teacher, $id)
    {
        $db = new DB();
        $conn = $db->connect();

        $sirName = $teacher->getSirName();
        $middleName = $teacher->getMiddleName();
        $lastName = $teacher->getLastName();
        $tscNo = $teacher->getTscNo();
        $nationalId = $teacher->getNationalId();
        $speciality = $teacher->getSpeciality();
        $gender = $teacher->getGender();
        $dateRegistered = $teacher->getDateRegistered();

        try {

            $stmt = $conn->prepare("UPDATE teachers SET
                                                        sir_name=:sir_name,
                                                        middle_name=:middle_name,
                                                        last_name=:last_name,
                                                        tsc_no=:tsc_no,
                                                        national_id=:national_id,
                                                        speciality=:speciality,
                                                        gender=:gender,
                                                        date_registered=:date_registered
                                                      WHERE 
                                                          id=:id ");
            $stmt->bindParam(":id", $id);
            $stmt->bindParam(":sir_name", $sirName);
            $stmt->bindParam(":middle_name", $middleName);
            $stmt->bindParam(":last_name", $lastName);
            $stmt->bindParam(":tsc_no", $tscNo);
            $stmt->bindParam(":national_id", $nationalId);
            $stmt->bindParam(":speciality", $speciality);
            $stmt->bindParam(":gender", $gender);
            $stmt->bindParam(":date_registered", $dateRegistered);
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
     * @return mixed
     */
    public static function delete($id)
    {
        $db = new DB();
        $conn = $db->connect();

        try {

            $stmt = $conn->prepare("DELETE FROM teachers WHERE  id=:id");
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
     * delete all data in teachers table
     */
    public static function destroy()
    {
       $db = new DB();
       $conn = $db->connect();

        try {

            $stmt = $conn->prepare("DELETE FROM teachers");
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
     * @return mixed
     */
    public static function getId($id)
    {
        $db = new DB();
        $conn = $db->connect();
        try {
            $stmt = $conn->prepare("SELECT * FROM teachers WHERE id=:id");
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            if ($stmt->rowCount() == 1) {
                $row = $stmt->fetch(\PDO::FETCH_ASSOC);
                $teacher = array(
                    "sir_name" => $row['sir_name'],
                    "middle_name" => $row['middle_name'],
                    "last_name" => $row['last_name'],
                    "tsc_no" => $row['tsc_no'],
                    "national_id" => $row['national_id'],
                    "speciality" => $row['speciality'],
                    "gender" => $row['gender'],
                    "date_registered" => $row['date_registered']
                );
                $db->closeConnection();
                return $teacher;
            } else {
                return [];
            }
        } catch (\PDOException $exception) {
            echo $exception->getMessage();
            return [];
        }
    }

    /**
     * @return mixed
     */
    public static function all()
    {
        $db = new DB();
        $conn = $db->connect();
        try{

            $stmt = $conn->prepare("SELECT * FROM teachers ");

            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                $teachers = array();
                while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
                    $teacher = array(
                        "sir_name" => $row['sir_name'],
                        "middle_name" => $row['middle_name'],
                        "last_name" => $row['last_name'],
                        "tsc_no" => $row['tsc_no'],
                        "national_id" => $row['national_id'],
                        "speciality" => $row['speciality'],
                        "gender" => $row['gender'],
                        "date_registered" => $row['date_registered']
                    );
                    $teachers[] = $teacher;
                }
                $db->closeConnection();
                return $teachers;
            } else {
                return [];
            }

        } catch (\PDOException $exception){
            echo $exception->getMessage();
            return [];
        }
    }

    /**
     * @param $id
     * @return Teacher|null
     */
    public static function getTeacher($id)
    {
        $db = new DB();
        $conn = $db->connect();

        try{
            $stmt = $conn->prepare("SELECT * FROM teachers WHERE id=:id");
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            if($stmt->rowCount() == 1){
                $row = $stmt->fetch(\PDO::FETCH_ASSOC);
                $teacher  = new Teacher();
                $teacher->setSirName($row['sir_name']);
                $teacher->setMiddleName($row['middle_name']);
                $teacher->setLastName($row['last_name']);
                $teacher->setTscNo($row['tsc_no']);
                $teacher->setNationalId($row['national_id']);
                $teacher->setSpeciality($row['speciality']);
                $teacher->setGender($row['gender']);
                $teacher->setDateRegistered($row['date_registered']);
                $db->closeConnection();
                return $teacher;
            } else{
                return null;
            }
        } catch (\PDOException $exception){
            echo $exception->getMessage();
            return null;
        }
    }

    public static function assignTeachingSubject($teacherId, array $subjectId)
    {
        $db = new DB();
        $conn = $db->connect();

        try{

            $stmt = $conn->prepare("INSERT INTO teacher_subjects(teacher_id, subject_id) VALUES (:teacher_id, :subject_id)");

            foreach ($subjectId as $subId){
                $stmt->bindParam(":teacher_id", $teacherId);
                $stmt->bindParam(":subject_id", $subId);
                $stmt->execute();
            }

            $db->closeConnection();
            return true;
        } catch (\PDOException $exception) {
            echo $exception->getMessage();
            return false;
        }
    }

    public static function removeTeachingSubject($teacherId, array $subjectId)
    {
        $db = new DB();
        $conn = $db->connect();

        try{

            $stmt = $conn->prepare("DELETE FROM teacher_subjects WHERE teacher_id=:teacher_id AND  subject_id=:subject_id");

            foreach ($subjectId as $subId){
                $stmt->bindParam(":teacher_id", $teacherId);
                $stmt->bindParam(":subject_id", $subId);
                $stmt->execute();
            }

            $db->closeConnection();
            return true;
        } catch (\PDOException $exception) {
            echo $exception->getMessage();
            return false;
        }
    }

    public static function getTeacherSubject($teacherId)
    {
        $db = new DB();
        $conn = $db->connect();

        try{
            $sql ="(SELECT subject.subject_code, subject.subject_name,teacher.sir_name, teacher.middle_name, teacher.last_name FROM subjects subject, teachers teacher
                   WHERE teacher.id = (SELECT teacher_id FROM teacher_subjects WHERE teacher_id =:teacher_id AND teacher_subjects.subject_id=subject.id LIMIT 1))";
            $stmt= $conn->prepare($sql);
            $stmt->bindParam(":teacher_id", $teacherId);
            $stmt->execute();
            if ($stmt->rowCount() > 0 ){
                $subjects = array();
                while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
                    $subject = [
                        "subject_code"=> $row['subject_code'],
                        "subject_name"=> $row['subject_name'],
                        "teacher_name"=> $row['sir_name']." ".$row['middle_name']." ".$row['last_name']
                    ];

                    $subjects[] = $subject;
                }
                $db->closeConnection();
                return $subjects;
            } else{
                return [];
            }

        } catch (\PDOException $exception) {
            echo $exception->getMessage();
            return [];

        }
    }



}