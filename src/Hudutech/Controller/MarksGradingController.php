<?php
/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 4/10/17
 * Time: 4:41 PM
 */

namespace Hudutech\Controller;


use Hudutech\AppInterface\MarksGradingInterface;
use Hudutech\DBManager\DB;

class MarksGradingController implements MarksGradingInterface
{


    public static function batchCreate(array $grade)
    {
        $db = new DB();
        $conn = $db->connect();

        try {
            $stmt = $conn->prepare("INSERT INTO marks_grading_system
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

        try {
            $stmt = $conn->prepare("UPDATE marks_grading_system SET 
                                                                low_mark=:low_mark,
                                                                high_mark=:high_mark,
                                                                grade=:grade,
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

        try {
            $stmt = $conn->prepare("UPDATE marks_grading_system SET 
                                                                low_mark=:low_mark,
                                                                high_mark=:high_mark,
                                                                grade=:grade,
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

        try {
            $stmt = $conn->prepare("DELETE FROM marks_grading_system WHERE id=:id");
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
            $stmt = $conn->prepare("DELETE FROM marks_grading_system");
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
            $stmt = $conn->prepare("SELECT grade AS grade_letter, `comment` FROM marks_grading_system WHERE low_mark<=:score AND high_mark>=:score");
            $stmt->bindParam(":score", $score);
            $stmt->execute();
            if ($stmt->rowCount() == 1) {
                $row = $stmt->fetch(\PDO::FETCH_ASSOC);
                $grade = array(
                    "grade_letter" => $row['grade_letter'],
                    "comment" => $row['comment']
                );
                return $grade;
            } else {
                return [];
            }
        } catch (\PDOException $exception) {
            echo $exception->getMessage();
            return [];
        }
    }

    /**
     * {@inheritdoc}
     */
    public static function getScoreSheetRegNo($year, $term, $student_class)
    {
        $db = new DB();
        $conn = $db->connect();

        $tableName = '';
        if ($student_class == 'form 1') {
            $tableName = "form_one_score_sheet";
        } elseif ($student_class == 'form 2') {
            $tableName = "form_two_score_sheet";
        } elseif ($student_class == 'form 3') {
            $tableName = "form_three_score_sheet";
        } elseif ($student_class == 'form 4') {
            $tableName = "form_four_score_sheet";
        }

        try {
            $stmt = $conn->prepare("SELECT `reg_no` FROM `{$tableName}` 
                                                  WHERE
                                                        `year`:year  AND
                                                        `term`=:term AND
                                                        `student_class`=:student_class
                                                        ");

            $stmt->bindParam(":year", $year);
            $stmt->bindParam(":term", $term);
            $stmt->bindParam(":student_class", $student_class);
            $stmt->execute();
            $regNos = array();
            if ($stmt->rowCount() > 0) {
                while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
                    $regNos[] = $row;
                }
            }
            return $regNos;

        } catch (\PDOException $exception) {
            echo $exception->getMessage();
            return [];
        }
    }

    /**
     * @param array $config
     * $config = array("year"=>value, "term"=>value, "student_class", reg_no=>array())
     * @return array
     */
    public static function getScoreSheetTotal($config)
    {

        $db = new DB();
        $conn = $db->connect();
        $student_class = strtolower($config['student_class']);
        $tableName = '';
        if ($student_class == 'form 1') {
            $tableName = "form_one_score_sheet";
        } elseif ($student_class == 'form 2') {
            $tableName = "form_two_score_sheet";
        } elseif ($student_class == 'form 3') {
            $tableName = "form_three_score_sheet";
        } elseif ($student_class == 'form 4') {
            $tableName = "form_four_score_sheet";
        }

        $all_subjects = SubjectController::fetchAllSubjectNames();
        $compulsorySubjects = SubjectController::getCompulsorySubjects();

        $subject_without_compulsory = array_diff($all_subjects, $compulsorySubjects);
        $other_cols = rtrim(implode(',', $subject_without_compulsory), ',');
        $compulsory_total = '';
        for ($i = 0; $i < sizeof($compulsorySubjects) - 1; $i++) {
            $compulsory_total .= "ifnull(" . $compulsorySubjects[$i] . ",0) + ";
        }
        $compulsory_total .= "ifnull(" . $compulsorySubjects[$i] . ",0)";

        try {

            $stmt = $conn->prepare("SELECT `year`,  `term`, `reg_no`, 
                                  {$compulsory_total} as compulsory_total, {$other_cols}
                                    FROM `{$tableName}`
                                    WHERE
                                    `reg_no`=:reg_no AND
                                    `term` =:term AND
                                    `year` =:year         
                                    ");

            $totalMark = array();

            foreach ($config['reg_no'] as $regNo) {

                $stmt->bindParam(":reg_no", $regNo);
                $stmt->bindParam(":year", $config['year']);
                $stmt->bindParam(":term", $config['term']);
                $stmt->execute();
                if ($stmt->rowCount() > 0) {
                    while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {

                        $science = array(
                            (float)$row['chemistry'],
                            (float)$row['biology'],
                            (float)$row['physics']
                        );

                        $humanity = array();
                        $technical = array();


                        if(array_key_exists("cre", $row)){
                            array_push($humanity, (float)$row['cre']);
                        }
                        if(array_key_exists('history', $row)){
                            array_push($humanity, (float)$row['history']);
                        }
                        if(array_key_exists('geography', $row)){
                            array_push($humanity, (float)$row['geography']);
                        }
                        if(array_key_exists("business", $row)){
                            array_push($technical, (float)$row['business']);
                        }
                        if(array_key_exists('agriculture', $row)){
                            array_push($technical, (float)$row['agriculture']);
                        }
                        if(array_key_exists('ict', $row)){
                            array_push($technical, (float)$row['ict']);
                        }
                        rsort($science);
                        rsort($humanity);
                        rsort($technical);

                        $best2_science = $science[0] + $science[1];
                        $best_humanity = $humanity[0];
                        $best_technical = $technical[0];
                        echo "ctotal ".(float)$row['compulsory_total'].PHP_EOL;
                        echo "2sci ".(float)$best2_science.PHP_EOL;
                        echo "tech ".(float)$best_technical.PHP_EOL;
                        echo "hum ".(float)$best_humanity.PHP_EOL;
                        echo "====================".PHP_EOL;

                        if(sizeof($compulsorySubjects) <4) {
                            $total = (float)($row['compulsory_total'] + $best2_science + $best_technical);
                        }
                        else{
                            $total = (float)($row['compulsory_total'] + $best2_science + $best_humanity + $best_technical);

                        }
                       $grade = self::getGrade($total);
                        print_r($grade);
                    }

                    }

            }


        } catch (\PDOException $exception) {
            echo $exception->getMessage();
            return [];

        }
    }


    /**
     * @param array $config
     * $config = array("year"=>value, "term"=>value, "student_class", reg_no=>array())
     * @return boolean
     */

    public static function updateScoreSheetTotals(array $config)
    {
        // TODO: Implement updateScoreSheetTotals() method.
    }


}