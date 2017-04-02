<?php
/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 4/2/17
 * Time: 6:08 PM
 */

namespace App\Controller;


use App\AppInterface\TeacherInterface;
use App\Entity\Teacher;

class TeacherController implements TeacherInterface
{
    /**
     * @param Teacher $teacher
     * @return mixed
     */
    public function createSingle(Teacher $teacher)
    {
        global $db, $conn;
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
        global $db, $conn;
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
        global $db, $conn;
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
        global $db, $conn;

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
        global $db, $conn;

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
        global $db, $conn;
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
        global $db, $conn;
        try{

            $stmt = $conn->prepare("SELECT * FROM teachers WHERE id=:id");
            $stmt->bindParam(":id", $id);
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
        global $db, $conn;

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


}