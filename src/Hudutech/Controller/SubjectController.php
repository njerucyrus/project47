<?php
/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 4/4/17
 * Time: 10:27 PM
 */

namespace Hudutech\Controller;

use Hudutech\DBManager\DB;
use Hudutech\AppInterface\SubjectInterface;
use Hudutech\Entity\Subject;

class SubjectController implements SubjectInterface
{
    public function createSingle(Subject $subject)
    {
        $db = new DB();
        $conn = $db->connect();

        $subjectName = $subject->getSubjectName();
        $subjectGroup = $subject->getSubjectGroup();
        $subjectCode = $subject->getSubjectCode();
        $isActive = $subject->isActive();
        $isCompulsory = $subject->isCompulsory();

        try {

            $stmt = $conn->prepare("INSERT INTO subjects(
                                                            subject_name,
                                                            subject_group,
                                                            subject_code,
                                                            is_active,
                                                            is_compulsory
                                                        )
                                                        VALUES
                                                         (
                                                            :subject_name,
                                                            :subject_group,
                                                            :subject_code,
                                                            :is_active,
                                                            :is_compulsory
                                                            
                                                          )
                                                        ");
            $stmt->bindParam(":subject_name", $subjectName);
            $stmt->bindParam(":subject_group", $subjectGroup);
            $stmt->bindParam(":subject_code", $subjectCode);
            $stmt->bindParam(":is_active", $isActive);
            $stmt->bindParam(":is_compulsory", $isCompulsory);
            $stmt->execute();
            $db->closeConnection();
            return true;
        } catch (\PDOException $exception) {
            echo $exception->getMessage();
            return false;
        }

    }

    public function createMultiple(array $subjects)
    {
        $db = new DB();
        $conn = $db->connect();

        try {

            $stmt = $conn->prepare("INSERT INTO subjects(
                                                            subject_name,
                                                            subject_group,
                                                            subject_code,
                                                            is_active,
                                                            is_compulsory
                                                        )
                                                        VALUES
                                                         (
                                                            :subject_name,
                                                            :subject_group,
                                                            :subject_code,
                                                            :is_active,
                                                            :is_compulsory
                                                          )
                                                        ");

            foreach ($subjects as $subject) {
                $stmt->bindParam(":subject_name", $subjectName);
                $stmt->bindParam(":subject_group", $subjectGroup);
                $stmt->bindParam(":subject_code", $subjectCode);
                $stmt->bindParam(":is_active", $is_active);
                $stmt->bindParam(":is_compulsory", $isCompulsory);

                $subjectName = $subject['subject_name'];
                $subjectGroup = $subject['subject_group'];
                $subjectCode = $subject['subject_code'];
                $is_active = $subject['is_active'];
                $isCompulsory = $subject['is_compulsory'];

                $stmt->execute();
            }
            $db->closeConnection();
            return true;

        } catch (\PDOException $exception) {
            echo $exception->getMessage();
            return false;
        }
    }

    public function update(Subject $subject, $id)
    {
        $db = new DB();
        $conn = $db->connect();

        $subjectName = $subject->getSubjectName();
        $subjectGroup = $subject->getSubjectGroup();
        $subjectCode = $subject->getSubjectCode();
        $is_active = $subject->isActive();
        $isCompulsory = $subject->isCompulsory();
        try {

            $stmt = $conn->prepare("UPDATE subjects SET 
                                                      subject_name=:subject_name,
                                                      subject_group=:subject_group,
                                                      subject_code=:subject_code,
                                                      is_active=:is_active,
                                                      is_compulsory=:is_compulsory
                                                  WHERE
                                                      id=:id
                                                  ");

            $stmt->bindParam(":id", $id);
            $stmt->bindParam(":subject_name", $subjectName);
            $stmt->bindParam(":subject_group", $subjectGroup);
            $stmt->bindParam(":subject_code", $subjectCode);
            $stmt->bindParam(":is_active", $is_active);
            $stmt->bindParam(":is_compulsory", $isCompulsory);
            $stmt->execute();
            $db->closeConnection();
            return true;

        } catch (\PDOException $exception) {
            echo $exception->getMessage();
            return false;
        }
    }

    public static function delete($id)
    {
        $db = new DB();
        $conn = $db->connect();

        try {
            $stmt = $conn->prepare("DELETE FROM subjects WHERE id=:id");
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            return true;
        } catch (\PDOException $exception) {
            echo $exception->getMessage();
            return false;
        }
    }

    public static function destroy()
    {
        $db = new DB();
        $conn = $db->connect();

        try {
            $stmt = $conn->prepare("DELETE FROM subjects");
            $stmt->execute();
            return true;
        } catch (\PDOException $exception) {
            echo $exception->getMessage();
            return false;
        }
    }

    public static function getId($id)
    {
        $db = new DB();
        $conn = $db->connect();

        try {

            $stmt = $conn->prepare("SELECT * FROM subjects WHERE id=:id");
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            if ($stmt->rowCount() == 1) {
                $row = $stmt->fetch(\PDO::FETCH_ASSOC);
                $subject = array(
                    "id" => $row['id'],
                    "subject_name" => $row['subject_name'],
                    "subject_group" => $row['subject_group'],
                    "subject_code" => $row['subject_code'],
                    "is_active"=>$row['is_active'],
                    "is_compulsory"=>$row['is_compulsory']
                );
                return $subject;
            } else {
                return [];
            }

        } catch (\PDOException $exception) {
            echo $exception->getMessage();
            return [];
        }

    }

    public static function all()
    {
        $db = new DB();
        $conn = $db->connect();

        try {

            $stmt = $conn->prepare("SELECT * FROM subjects WHERE id=:id");
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            if ($stmt->rowCount() == 1) {
                $subjects = array();
                while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
                    $subject = array(
                        "id" => $row['id'],
                        "subject_name" => $row['subject_name'],
                        "subject_group" => $row['subject_group'],
                        "subject_code" => $row['subject_code'],
                        "is_active" => $row['is_active'],
                        "is_compulsory"=>$row['is_compulsory']
                    );
                    $subjects[] = $subject;
                }
                return $subjects;
            } else {
                return [];
            }

        } catch (\PDOException $exception) {
            echo $exception->getMessage();
            return [];
        }
    }

    public static function getSubject($id)
    {
        $db = new DB();
        $conn = $db->connect();

        try {

            $stmt = $conn->prepare("SELECT * FROM subjects WHERE id=:id");
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            if ($stmt->rowCount() == 1) {
                $row = $stmt->fetch(\PDO::FETCH_ASSOC);

                $subject = new Subject();

                $subject->setId($row['id']);
                $subject->setSubjectName($row['subject_name']);
                $subject->setSubjectGroup($row['subject_group']);
                $subject->setSubjectCode($row['subject_code']);
                $subject->setCompulsory($row['is_compulsory']);
                $subject->setActive($row['is_active']);

                return $subject;
            } else {
                return null;
            }

        } catch (\PDOException $exception) {
            echo $exception->getMessage();
            return null;
        }
    }

    public static function getCompulsorySubjects()
    {
        $db = new DB();
        $conn = $db->connect();

        try{
            $stmt = $conn->prepare("SELECT `subject_name` FROM subjects WHERE `is_active`=1 AND `is_compulsory`=1");
            $stmt->execute();
            $compulsorySubjects = array();
            if($stmt->rowCount()>0) {
                while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
                    $subject = strtolower($row['subject_name']);
                    // remove sciences from compulsory array to avoid adding its marks twice in
                    // total computations(MarksGradingController)
                    if ($subject !='biology' AND $subject !='chemistry' AND $subject !='physics') {
                        $compulsorySubjects[] = $subject;
                    }
                }
            }
            return $compulsorySubjects;
        } catch (\PDOException $exception) {
            echo $exception->getMessage();
            return [];
        }
    }

    public static function fetchAllSubjectNames()
    {
        $db = new DB();
        $conn = $db->connect();
        try {
            $stmt = $conn->prepare("SELECT subject_name FROM subjects WHERE is_active=1");
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                $subjectNames = array();
                while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {

                    $subjectNames[] = strtolower($row['subject_name']);;

                }
                return $subjectNames;
            } else {
                return [];
            }

        } catch (\PDOException $exception) {
            echo $exception->getMessage();
            return [];
        }
    }


}