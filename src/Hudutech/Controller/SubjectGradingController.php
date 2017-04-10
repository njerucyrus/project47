<?php
/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 4/10/17
 * Time: 1:22 AM
 */

namespace Hudutech\Controller;

use Hudutech\AppInterface\SubjectGradingInterface;
use Hudutech\DBManager\DB;

class SubjectGradingController implements SubjectGradingInterface
{
    public static function batchCreate(array $grade)
    {
        $db = new DB();
        $conn = $db->connect();

        try {
            $stmt = $conn->prepare("INSERT INTO subject_grading_system
                                                            (
                                                                low_mark,
                                                                high_mark,
                                                                grade,
                                                                comment,
                                                                points
                                                            )
                                                            VALUES
                                                            (
                                                                :low_mark,
                                                                :high_mark,
                                                                :grade,
                                                                :comment,
                                                                :points
                                                           )");

            foreach ($grade as $gradeItem) {
                $stmt->bindParam(":low_mark", $gradeItem['low_mark']);
                $stmt->bindParam(":high_mark", $gradeItem['high_mark']);
                $stmt->bindParam(":grade", $gradeItem['grade']);
                $stmt->bindParam(":points", $gradeItem['points']);
                $stmt->bindParam(":comment", $gradeItem['comment']);
                $stmt->execute();
            }

            $db->closeConnection();
            return true;
        } catch (\PDOException $exception) {
            echo $exception->getMessage();
            return false;
        }

    }


    public static function batchUpdate(array $grade)
    {
        $db = new DB();
        $conn = $db->connect();

        try {
            $stmt = $conn->prepare("UPDATE subject_grading_system SET 
                                                                low_mark=:low_mark,
                                                                high_mark=:high_mark,
                                                                comment=:comment,
                                                                points=:points
                                                          WHERE 
                                                                id=:id
                                                            ");

            foreach ($grade as $gradeItem) {
                $stmt->bindParam(":id", $gradeItem['id']);
                $stmt->bindParam(":low_mark", $gradeItem['low_mark']);
                $stmt->bindParam(":high_mark", $gradeItem['high_mark']);
                $stmt->bindParam(":grade", $gradeItem['grade']);
                $stmt->bindParam(":points", $gradeItem['points']);
                $stmt->bindParam(":comment", $gradeItem['comment']);
                $stmt->execute();
            }

            $db->closeConnection();
            return true;


        } catch (\PDOException $exception) {
            echo $exception->getMessage();
            return false;
        }
    }

    public static function updateSingle(array $grade)
    {
        $db = new DB();
        $conn = $db->connect();

        try {
            $stmt = $conn->prepare("UPDATE subject_grading_system SET 
                                                                low_mark=:low_mark,
                                                                high_mark=:high_mark,
                                                                points=:points,
                                                                comment=:comment
                                                          WHERE 
                                                                id=:id
                                                            ");

            $stmt->bindParam(":id", $grade['id']);
            $stmt->bindParam(":low_mark", $grade['low_mark']);
            $stmt->bindParam(":high_mark", $grade['high_mark']);
            $stmt->bindParam(":points", $grade['points']);
            $stmt->bindParam(":grade", $grade['grade']);
            $stmt->bindParam(":comment", $grade['comment']);
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
            $stmt = $conn->prepare("DELETE FROM subject_grading_system WHERE id=:id");
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            $db->closeConnection();

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
            $stmt = $conn->prepare("DELETE FROM subject_grading_system");
            $stmt->execute();
            $db->closeConnection();

            return true;
        } catch (\PDOException $exception) {
            echo $exception->getMessage();
            return false;
        }
    }

    public static function getGrade($score)
    {
        $db = new DB();
        $conn = $db->connect();

        try {
            $stmt = $conn->prepare("SELECT grade AS grade_letter, comment, points FROM subject_grading_system WHERE low_mark<=:score AND high_mark>=:score");
            $stmt->bindParam(":score", $score);
            $stmt->execute();
            if ($stmt->rowCount() == 1) {
                $row = $stmt->fetch(\PDO::FETCH_ASSOC);
                $grade = array(
                    "grade_letter" => $row['grade_letter'],
                    "points" => $row['points'],
                    "comment" => $row['comment']
                );
                return $grade;
            } else {
                return ["error" => "Grade info not found within the range of 0-100 marks"];
            }
        } catch (\PDOException $exception) {
            echo $exception->getMessage();
            return ["error" => "Internal Server Error occurred"];
        }

    }

}