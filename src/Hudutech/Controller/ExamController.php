<?php
/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 4/11/17
 * Time: 9:46 AM
 */

namespace Hudutech\Controller;


use Hudutech\AppInterface\ExamInterface;
use Hudutech\DBManager\DB;
use Hudutech\Entity\Exam;

class ExamController implements ExamInterface
{
    public function create(Exam $exam)
    {
        $db = new DB();
        $conn = $db->connect();

        $examName = $exam->getExamName();
        $outOf = $exam->getOutOf();
        $term = $exam->getTerm();
        try{
            $stmt = $conn->prepare("INSERT INTO exams
                                                    (
                                                        term,
                                                        exam_name,
                                                        out_of
                                                     ) 
                                                VALUES
                                                (
                                                    :term,
                                                    :exam_name,
                                                    :out_of
                                                )");
            $stmt->bindParam(":term", $term);
            $stmt->bindParam(":exam_name", $examName);
            $stmt->bindParam(":out_of", $outOf);
            $stmt->execute();
            return true;
        } catch (\PDOException $exception){
            echo $exception->getMessage();
            return false;
        }
    }

    public function update(Exam $exam, $id)
    {
        $db = new DB();
        $conn = $db->connect();

        $examName = $exam->getExamName();
        $outOf = $exam->getOutOf();
        $term = $exam->getTerm();
        try{
            $stmt = $conn->prepare("UPDATE exams SET exam_name=:exam_name, term=:term, out_of=:out_of WHERE id=:id");

            $stmt->bindParam(":id", $id);
            $stmt->bindParam(":term", $term);
            $stmt->bindParam(":exam_name", $examName);
            $stmt->bindParam(":out_of", $outOf);
            $stmt->execute();
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
            $stmt = $conn->prepare("DELETE FROM exams WHERE id=:id");
            $stmt->bindParam(":id",$id);
            $stmt->execute();
            return true;
        }catch (\PDOException $exception){
            echo $exception->getMessage();
            return false;
        }
    }

    public static function destroy()
    {
        $db = new DB();
        $conn = $db->connect();
        try{
            $stmt = $conn->prepare("DELETE FROM exams");
            $stmt->execute();
            return true;
        }catch (\PDOException $exception){
            echo $exception->getMessage();
            return false;
        }
    }


    public static function getId($id)
    {
        $db = new DB();
        $conn = $db->connect();

        try{
            $stmt = $conn->prepare("SELECT * FROM exams WHERE id=:id");
            $stmt->bindParam(":id",$id);
            $stmt->execute();
            if($stmt->rowCount() == 1) {
                $row = $stmt->fetch(\PDO::FETCH_ASSOC);

                $exam = array(
                    "id" =>$row['id'],
                    "exam_name" =>$row['exam_name'],
                    "out_of"=>$row['out_of'],
                    "term"=>$row['term']
                    );

                return $exam;
            }
            else{
                return [];
            }
        }catch (\PDOException $exception){
            echo $exception->getMessage();
            return [];
        }
    }

    public static function getExams($term)
    {
        $db = new DB();
        $conn = $db->connect();

        try{
            $stmt = $conn->prepare("SELECT * FROM exams WHERE term=:term");
            $stmt->bindParam(":term",$term);
            $stmt->execute();
            if($stmt->rowCount() == 1) {
                $row = $stmt->fetch(\PDO::FETCH_ASSOC);

                $exam = array(
                    "id" =>$row['id'],
                    "exam_name" =>$row['exam_name'],
                    "out_of"=>$row['out_of'],
                    "term"=>$row['term']
                );

                return $exam;
            }
            else{
                return [];
            }
        }catch (\PDOException $exception){
            echo $exception->getMessage();
            return [];
        }
    }

}