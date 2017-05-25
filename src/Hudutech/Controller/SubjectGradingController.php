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
    /**
     * @param array $grade
     * @return bool
     */
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


    /**
     * @param array $grade
     * @return bool
     */
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

    /**
     * @param array $grade
     * @return bool
     */
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

    /**
     * @param $id
     * @return bool
     */
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

    /**
     * @return bool
     */
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

    /**
     * @param $config
     * config = array("year"=>value, "term"=>value, "student_class"=>value,"subject"=>value)
     * @return array
     *
     */
    public static function getStandardExamTotal(array $config)
    {
        $db = new DB();
        $conn = $db->connect();
        $year = $config['year'];
        $term = $config['term'];
        $student_class = $config['student_class'];
        $subject = $config['subject'];
        $table_name = ExamTableController::getStandardExamTableName($config['subject']);



        try {
            $stmt = $conn->prepare("SELECT * FROM $table_name WHERE `year`='{$year}' AND `term`='{$term}' AND `student_class`='{$student_class}'");

            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                $total_marks_info = array();
                while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
                    $total = 0;
                    if (strtolower($subject) == 'english') {
                        $total = (int)(($row['pp1'] + $row['pp2'] + $row['pp3']) / 2);
                    } elseif (strtolower($subject) == 'kiswahili') {
                        $total = (int)(($row['pp1'] + $row['pp2'] + $row['pp3']) / 2);
                    } elseif (strtolower($subject) == 'chemistry') {
                        $pp12 = (($row['pp1'] + $row['pp2']) / 160) * 60;
                        $total = (int)($pp12 + $row['pp3']);
                    } elseif (strtolower($subject) == 'physics') {
                        $pp12 = (($row['pp1'] + $row['pp2']) / 160) * 60;
                        $total = (int)($pp12 + $row['pp3']);
                    } elseif (strtolower($subject) == 'biology') {
                        $pp12 = (($row['pp1'] + $row['pp2']) / 160) * 60;
                        $total = (int)($pp12 + $row['pp3']);
                    } else {
                        $total = (int)(($row['pp1'] + $row['pp2']) / 2);
                    }

                    $grade = self::getGrade($total);

                    array_push($total_marks_info, array(
                        "reg_no" => $row['reg_no'],
                        "total_mark" => $total,
                        "grade_letter" => $grade['grade_letter'],
                        "points" => $grade['points'],
                        "comment"=>$grade['comment']
                    ));
                }
                $db->closeConnection();
                return $total_marks_info;

            } else {
                return [];
            }

        } catch (\PDOException $exception) {
            echo $exception->getMessage();
            return [];
        }
    }

    /**
     * @param $score
     * @return array
     */
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
                return [];
            }
        } catch (\PDOException $exception) {
            echo $exception->getMessage();
            return [];
        }

    }

    /**
     * @param $config
     * config = array("year"=>value, "term"=>value, "student_class"=>value,"subject"=>value)
     * @return boolean
     *
     */
    public static function updateStandardExamTotals(array $config){

        $db = new DB();
        $conn = $db->connect();

        $year = $config['year'];
        $term = $config['term'];
        $student_class = $config['student_class'];
        $subject = $config['subject'];
        $table_name = ExamTableController::getStandardExamTableName($subject);

        try {
            $totalMarkData = self::getStandardExamTotal($config);
            if (!empty($totalMarkData)) {

                $stmt = $conn->prepare("UPDATE $table_name SET total=:total, grade=:grade, points=:points, comment=:comment
                                        WHERE reg_no=:reg_no AND `year`='{$year}' AND `term`='{$term}' AND `student_class`='{$student_class}'");
                foreach ($totalMarkData as $total) {
                    $stmt->bindParam(":reg_no", $total['reg_no']);
                    $stmt->bindParam(":total", $total['total_mark']);
                    $stmt->bindParam(":grade", $total['grade_letter']);
                    $stmt->bindParam(":points", $total['points']);
                    $stmt->bindParam(":comment", $total['comment']);
                    $stmt->execute();

                }
                $db->closeConnection();
                return true;
            }
            else{
                return false;
            }
        } catch (\PDOException $exception ){
            echo $exception->getMessage();
            return false;
        }
    }

    /**
     * @param $config
     * $config = array("year"=>value, "term"=>value, "student_class"=>value,"subject"=>value)
     * @return boolean
     *
     */

    public static function updateScoreSheet(array $config)
    {
        $db = new DB();
        $conn = $db->connect();

        $totals = self::getStandardExamTotal($config);

        $student_class = strtolower($config['student_class']);
        $subject = strtolower($config['subject']);
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

        $stmt = $conn->prepare("UPDATE `{$tableName}` SET `{$subject}`=:total_mark WHERE `reg_no`=:reg_no AND `year`=:year AND `term` =:term");
        try {
            foreach ($totals as $total) {
                $totalMark = $total['total_mark'] . " " . $total['grade_letter'];
                $points = $total['points'];
                $regNo = $total['reg_no'];
                $year = $config['year'];
                $term = $config['term'];
                $stmt->bindParam(":total_mark", $totalMark);
                $stmt->bindParam(":reg_no", $regNo);
                $stmt->bindParam(":year", $year);
                $stmt->bindParam(":term", $term);
                $stmt->execute();
            }
            $db->closeConnection();
            return true;
        } catch (\PDOException $exception) {
            echo $exception->getMessage();
            return false;
        }
    }


}