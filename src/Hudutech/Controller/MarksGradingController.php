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
            $stmt = $conn->prepare("INSERT INTO point_grading
                                                            (
                                                                low_point,
                                                                high_point,
                                                                grade,
                                                                comment
                                                                
                                                            )
                                                            VALUES
                                                            (
                                                                :low_point,
                                                                :high_point,
                                                                :grade,
                                                                :comment
                                                                
                                                           )");

            foreach ($grade as $gradeItem) {
                $stmt->bindParam(":low_point", $gradeItem['low_point']);
                $stmt->bindParam(":high_point", $gradeItem['high_point']);
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
        print_r($compulsorySubjects);

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

            $stmt2 = $conn->prepare("SELECT * FROM {$tableName}
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

                $stmt2->bindParam(":reg_no", $regNo);
                $stmt2->bindParam(":year", $config['year']);
                $stmt2->bindParam(":term", $config['term']);
                $stmt2->execute();

                if ($stmt->rowCount() > 0) {
                    while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {

                        $science = array(
                            (float)$row['chemistry'],
                            (float)$row['biology'],
                            (float)$row['physics']
                        );

                        $humanity = array();
                        $technical = array();


                        if (array_key_exists("cre", $row)) {
                            array_push($humanity, (float)$row['cre']);
                        }
                        if (array_key_exists('history', $row)) {
                            array_push($humanity, (float)$row['history']);
                        }
                        if (array_key_exists('geography', $row)) {
                            array_push($humanity, (float)$row['geography']);
                        }
                        if (array_key_exists("business", $row)) {
                            array_push($technical, (float)$row['business']);
                        }
                        if (array_key_exists('agriculture', $row)) {
                            array_push($technical, (float)$row['agriculture']);
                        }
                        if (array_key_exists('ict', $row)) {
                            array_push($technical, (float)$row['ict']);
                        }
                        rsort($science);
                        rsort($humanity);
                        rsort($technical);

                        $best2_science = $science[0] + $science[1];
                        $best_humanity = $humanity[0];
                        $best_technical = $technical[0];


                        if (sizeof($compulsorySubjects) < 4) {
                            $total = (float)($row['compulsory_total'] + $best2_science + $best_technical);
                        } else {
                            $total = (float)($row['compulsory_total'] + $best2_science + $best_humanity + $best_technical);

                        }
                        $grade = self::getGrade($total);
                        print_r($grade);
                    }
                }

                if ($stmt2->rowCount() > 0) {
                    $totalPoints = 0;


                    while ($row2 = $stmt2->fetch(\PDO::FETCH_ASSOC)) {

                        $compulsoryPoints = array();
                        $sciencePoints = array();
                        $humanityPoints = array();
                        $technicalPoints = array();

                        if (array_key_exists("mathematics", $row2)) {
                            if (!is_null($row2['mathematics'])) {
                                $math = SubjectGradingController::getGrade((float)$row2['mathematics']);

                                if (in_array("mathematics", $compulsorySubjects)) {
                                    array_push($compulsoryPoints, $math['points']);
                                }
                            }
                        }
                        if (array_key_exists("english", $row2)) {
                            if (!is_null($row2['english'])) {
                                $eng = SubjectGradingController::getGrade((float)$row2['english']);

                                if (in_array("english", $compulsorySubjects)) {
                                    array_push($compulsoryPoints, $eng['points']);
                                }
                            }
                        }

                        if (array_key_exists("kiswahili", $row2)) {
                            if (!is_null($row2['kiswahili'])) {
                                $kisw = SubjectGradingController::getGrade((float)$row2['kiswahili']);
                                if (in_array("kiswahili", $compulsorySubjects)) {
                                    array_push($compulsoryPoints, $kisw['points']);
                                }
                            }

                        }

                        if (array_key_exists("biology", $row2)) {
                            if (!is_null($row2['biology'])) {
                                $bio = SubjectGradingController::getGrade((float)$row2['biology']);

                                array_push($sciencePoints, $bio['points']);
                            }
                        }

                        if (array_key_exists("chemistry", $row2)) {
                            if (!is_null($row2['chemistry'])) {
                                $chem = SubjectGradingController::getGrade((float)$row2['chemistry']);
                                array_push($sciencePoints, $chem['points']);
                            }
                        }

                        if (array_key_exists("physics", $row2)) {
                            if (!is_null($row2['physics'])) {
                                $phy = SubjectGradingController::getGrade((float)$row2['physics']);
                                array_push($sciencePoints, $phy['points']);
                            }
                        }

                        if (array_key_exists("history", $row2)) {
                            if (!is_null($row2['history'])) {
                                $hist = SubjectGradingController::getGrade((float)$row2['history']);

                                if (in_array("history", $compulsorySubjects)) {
                                    array_push($compulsoryPoints, $hist['points']);
                                } else {
                                    array_push($humanityPoints, $hist['points']);
                                }
                            }
                        }

                        if (array_key_exists("geography", $row2)) {
                            if (!is_null($row2['geography'])) {
                                $geo = SubjectGradingController::getGrade((float)$row2['geography']);

                                if (in_array("geography", $compulsorySubjects)) {
                                    array_push($compulsoryPoints, $geo['points']);
                                } else {
                                    array_push($humanityPoints, $geo['points']);
                                }
                            }
                        }

                        if (array_key_exists("cre", $row2)) {
                            if (!is_null($row2['cre'])) {
                                $cre = SubjectGradingController::getGrade((float)$row2['cre']);
                                $totalPoints += $cre['points'];
                                if (in_array("cre", $compulsorySubjects)) {
                                    array_push($compulsoryPoints, $cre['points']);
                                } else {
                                    array_push($humanityPoints, $cre['points']);
                                }
                            }
                        }

                        if (array_key_exists("business", $row2)) {
                            if (!is_null($row2['business'])) {
                                $buss = SubjectGradingController::getGrade((float)$row2['business']);
                                if (in_array("business", $compulsorySubjects)) {
                                    array_push($compulsoryPoints, $buss['points']);
                                } else {
                                    array_push($technicalPoints, $buss['points']);
                                }
                            }
                        }

                        if (array_key_exists("agriculture", $row2)) {
                            if (!is_null($row2['agriculture'])) {
                                $agri = SubjectGradingController::getGrade((float)$row2['agriculture']);
                                $totalPoints += $agri['points'];
                                if (in_array("agriculture", $compulsorySubjects)) {
                                    array_push($compulsoryPoints, $agri['points']);
                                } else {
                                    array_push($technicalPoints, $agri['points']);
                                }
                            }
                        }
                        if (array_key_exists("ict", $row2)) {
                            if (!is_null($row2['ict'])) {
                                $ict = SubjectGradingController::getGrade((float)$row2['ict']);

                                if (in_array("ict", $compulsorySubjects)) {
                                    array_push($compulsoryPoints, $ict['points']);
                                } else {
                                    array_push($technicalPoints, $ict['points']);
                                }
                            }
                        }
                        rsort($sciencePoints);
                        rsort($humanityPoints);
                        rsort($technicalPoints);

//
                        $compulsoryPointSum = array_sum($compulsoryPoints);
                        $best_2_science_point = 0;
                        $best_humanity_point = 0;
                        $best_technical_point = 0;
                        if (!empty($humanityPoints)) {
                            $best_humanity_point = $humanityPoints[0];
                        }

                        if (!empty($technicalPoints)) {
                            $best_technical_point = $technicalPoints[0];
                        }

                        if (!empty($sciencePoints) and sizeof($sciencePoints) >= 2) {
                            $best_2_science_point = $sciencePoints[0] + $sciencePoints[1];
                        }
                        if (!empty($sciencePoints) and sizeof($sciencePoints) == 1) {
                            $best_2_science_point = $sciencePoints[0];
                        }

                        if (sizeof($compulsoryPoints) <= 3 and !empty($compulsoryPoints)) {
                            $totalPoints = $compulsoryPointSum + $best_2_science_point + $best_humanity_point + $best_technical_point;

                        }
                        if (sizeof($compulsoryPoints) > 3 and !empty($compulsoryPoints)) {
                            $totalPoints = $compulsoryPointSum + $best_2_science_point + $best_technical_point;

                        }

                       echo $totalPoints.PHP_EOL;




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