<?php
/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 4/10/17
 * Time: 1:22 AM
 */

namespace Hudutech\Controller;


use Hudutech\AppInterface\GradingSystemInterface;
use Hudutech\DBManager\DB;

class GradingSystemController implements GradingSystemInterface
{
    public static function batchCreate(array $grade)
    {
        $db = new DB();
        $conn = $db->connect();

        try {
            $stmt = $conn->prepare("INSERT INTO grading_system
                                                            (
                                                                low_mark,
                                                                high_mark,
                                                                grade,
                                                                comment
                                                            )
                                                            VALUES
                                                            (
                                                                :low_mark,
                                                                :high_mark,
                                                                :grade,
                                                                :comment
                                                           )");

            foreach ($grade as $gradeItem) {
                $stmt->bindParam(":low_mark", $gradeItem['low_mark']);
                $stmt->bindParam(":high_mark", $gradeItem['high_mark']);
                $stmt->bindParam(":grade", $gradeItem['grade']);
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

        try{
            $stmt = $conn->prepare("UPDATE grading_system SET 
                                                                low_mark=:low_mark,
                                                                high_mark=:high_mark,
                                                                comment=:comment
                                                          WHERE 
                                                                id=:id
                                                            ");

            foreach ($grade as $gradeItem) {
                $stmt->bindParam(":id", $gradeItem['id']);
                $stmt->bindParam(":low_mark", $gradeItem['low_mark']);
                $stmt->bindParam(":high_mark", $gradeItem['high_mark']);
                $stmt->bindParam(":grade", $gradeItem['grade']);
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

        try{
            $stmt = $conn->prepare("UPDATE grading_system SET 
                                                                low_mark=:low_mark,
                                                                high_mark=:high_mark,
                                                                comment=:comment
                                                          WHERE 
                                                                id=:id
                                                            ");

            $stmt->bindParam(":id", $grade['id']);
            $stmt->bindParam(":low_mark", $grade['low_mark']);
            $stmt->bindParam(":high_mark", $grade['high_mark']);
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

        try{
            $stmt = $conn->prepare("DELETE FROM grading_system WHERE id=:id");
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

        try{
            $stmt = $conn->prepare("DELETE FROM grading_system");
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
            $stmt = $conn->prepare("SELECT grade as grade_letter, comment FROM grading_system WHERE low_mark<=:score AND high_mark>=:score");
            $stmt->bindParam(":score", $score);
            $stmt->execute();
            if($stmt->rowCount() == 1){
                $row = $stmt->fetch(\PDO::FETCH_ASSOC);
                $grade = array(
                    "grade_letter"=> $row['grade_letter'],
                    "comment" => $row['comment']
                );
                return $grade;
            }
            else{
                return ["error"=> "Grade info not found within the range of 0-100 marks"];
            }
        } catch (\PDOException $exception) {
            echo $exception->getMessage();
            return ["error"=> "Internal Server Error occurred"];
        }

    }


}