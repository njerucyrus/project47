<?php
/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 4/11/17
 * Time: 9:46 AM
 */

namespace Hudutech\Controller;


use Hudutech\AppInterface\ExamInterface;
use Hudutech\DBManager\ComplexQuery;
use Hudutech\DBManager\DB;
use Hudutech\Entity\Exam;

class ExamController extends ComplexQuery implements ExamInterface
{
    public function create(Exam $exam)
    {
        $db = new DB();
        $conn = $db->connect();

        $examName = $exam->getExamName();
        $outOf = $exam->getOutOf();
        $term = $exam->getTerm();
        try {
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
        } catch (\PDOException $exception) {
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
        try {
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
        try {
            $stmt = $conn->prepare("DELETE FROM exams WHERE id=:id");
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
            $stmt = $conn->prepare("DELETE FROM exams");
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
            $stmt = $conn->prepare("SELECT * FROM exams WHERE id=:id");
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            if ($stmt->rowCount() == 1) {
                $row = $stmt->fetch(\PDO::FETCH_ASSOC);

                $exam = array(
                    "id" => $row['id'],
                    "exam_name" => $row['exam_name'],
                    "out_of" => $row['out_of'],
                    "term" => $row['term']
                );

                return $exam;
            } else {
                return [];
            }
        } catch (\PDOException $exception) {
            echo $exception->getMessage();
            return [];
        }
    }

    public static function getExams($term)
    {
        $db = new DB();
        $conn = $db->connect();

        try {
            $stmt = $conn->prepare("SELECT * FROM exams WHERE term=:term");
            $stmt->bindParam(":term", $term);
            $stmt->execute();
            if ($stmt->rowCount() == 1) {
                $row = $stmt->fetch(\PDO::FETCH_ASSOC);

                $exam = array(
                    "id" => $row['id'],
                    "exam_name" => $row['exam_name'],
                    "out_of" => $row['out_of'],
                    "term" => $row['term']
                );

                return $exam;
            } else {
                return [];
            }
        } catch (\PDOException $exception) {
            echo $exception->getMessage();
            return [];
        }
    }

    /**
     * @param $config
     * config = array("student_class"=>value, "term"=>value, "year"=>value)
     * @return boolean
     */
    public static function enrollStudentForExam(array $config)
    {

        $db = new DB();
        $conn = $db->connect();
        $columns = array(
            'reg_no',
            'stream',
            'current_class'
        );
        $options = array("current_class"=>$config['student_class']);
        $students = ComplexQuery::customFilter('students', $columns, $options);
        //print_r($students);
        $student_class = $config['student_class'];
        $tableName = '';
        if (strtolower($student_class) == 'form 1') {
            $tableName = "form_one_score_sheet";
        } elseif (strtolower($student_class) == 'form 2') {
            $tableName = "form_two_score_sheet";
        } elseif (strtolower($student_class) == 'form 3') {
            $tableName = "form_three_score_sheet";
        } elseif (strtolower($student_class) == 'form 4') {
            $tableName = "form_four_score_sheet";
        }


        echo $tableName.PHP_EOL;

        try {



            foreach ($students as $student) {
                $stmt = $conn->prepare("INSERT INTO `{$tableName}`(year, term, stream, reg_no, student_class ) VALUES (
                                                    :year, :term, :stream, :reg_no, :student_class
                                                    )");
                $stmt->bindParam(":year", $config['year']);
                $stmt->bindParam(":term", $config['term']);
                $stmt->bindParam(":stream", $student['stream']);
                $stmt->bindParam(":reg_no", $student['reg_no']);
                $stmt->bindParam(":student_class", $student['current_class']);
                $stmt->execute();
            }
            //$db->closeConnection();
            //return true;
        } catch (\PDOException $exception) {
            echo $exception->getMessage();
            return false;
        }
    }


}