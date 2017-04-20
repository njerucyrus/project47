<?php
/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 4/10/17
 * Time: 10:34 AM
 */

namespace Hudutech\Controller;


use Hudutech\AppInterface\ExamTableInterface;
use Hudutech\DBManager\DB;

class ExamTableController implements ExamTableInterface
{


    public static function fetchStandardExamTableNames()
    {
        $db = new DB();
        $conn = $db->connect();

        try {
            $stmt = $conn->prepare("SELECT subject_code, subject_name, has_pp3 FROM subjects WHERE is_active=1");
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                $tableNames = array();
                while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
                    $tableName = array(
                        "table_name" => "std_" . $row['subject_code'] . "_" . strtolower($row['subject_name']) . "_marks",
                        "has_pp3" => $row['has_pp3']
                    );
                    $tableNames[] = $tableName;
                }
                $db->closeConnection();
                return $tableNames;
            } else {
                return [];
            }

        } catch (\PDOException $exception) {
            echo $exception->getMessage();
            return [];
        }
    }

    public static function createStandardExamTables()
    {
        $db = new DB();
        $conn = $db->connect();
        $tableNames = self::fetchStandardExamTableNames();

        try {

            foreach ($tableNames as $tableName) {
                $table_name = $tableName['table_name'];
                $has_pp3 = $tableName['has_pp3'];
                $exam_paper_fields = '';
                if ($has_pp3 == 0) {
                    $exam_paper_fields .= 'pp1 FLOAT,pp2 FLOAT ';
                } elseif ($has_pp3 == 1) {
                    $exam_paper_fields .= 'pp1 FLOAT , pp2 FLOAT , pp3 FLOAT ';
                }
                $sql = " CREATE TABLE IF NOT EXISTS $table_name(
                                                            `id` INT(11) PRIMARY KEY AUTO_INCREMENT,
                                                            `reg_no` VARCHAR(20),
                                                            `year` INT(4),
                                                            `term` VARCHAR(6),
                                                            `student_class` VARCHAR(6),
                                                             $exam_paper_fields,
                                                            `total` FLOAT,
                                                            `grade` VARCHAR(2),
                                                            `points` INT(2),
                                                            `comment` VARCHAR(128),
                                                            UNIQUE( `reg_no`, `year`, `term`, `student_class`),     
                                                            FOREIGN KEY (`reg_no`)
                                                            REFERENCES  `students`(`reg_no`)
                                                            ON DELETE CASCADE
                                                            ON UPDATE CASCADE 
                                                            )";

                $conn->exec($sql);


            }
            $db->closeConnection();
            return true;
        } catch (\PDOException $e) {
            echo $e->getMessage();
            return false;
        }

    }

    public static function clearStandardExamTables()
    {

        $db = new DB();
        $conn = $db->connect();
        $tableNames = self::fetchStandardExamTableNames();
        try {
            foreach ($tableNames as $tableName) {
                $table_name = $tableName['table_name'];
                $sql = "DROP TABLE $table_name";
                $conn->exec($sql);
            }

            return true;
        } catch (\PDOException $exception) {
            echo $exception->getMessage();
            return false;
        }
    }

    public static function getStandardExamTableName($subject)
    {
        $db = new DB();
        $conn = $db->connect();
        try {
            $stmt = $conn->prepare("SELECT * FROM subjects WHERE subject_name=:subject_name AND is_active=1");
            $subj = strtolower($subject);
            $stmt->bindParam(":subject_name", $subj);
            $stmt->execute();
            if ($stmt->rowCount() == 1) {
                $row = $stmt->fetch(\PDO::FETCH_ASSOC);
                $table_name = "std_" . $row['subject_code'] . "_" . strtolower($row['subject_name']) . "_marks";
                return $table_name;
            } else {
                return null;
            }
        } catch (\PDOException $exception) {
            echo $exception->getMessage();
            return null;
        }
    }

    public static function createScoreSheetTables()
    {
        $db = new DB();
        $conn = $db->connect();
        $subjectNames = SubjectController::fetchAllSubjectNames();
        if (!empty($subjectNames)) {

            $column_part = '';
            foreach ($subjectNames as $column) {
                $column_part .= $column. " VARCHAR(6), ".PHP_EOL;
            }

            $form_1 = "CREATE TABLE IF NOT EXISTS form_one_score_sheet
                                  (
                                  `id` INT(11) PRIMARY KEY AUTO_INCREMENT,
                                   `year` YEAR,
                                   `term` VARCHAR(6),
                                   `stream` VARCHAR(32),
                                   `reg_no` VARCHAR(32) NOT NULL,
                                    $column_part
                                    `total_mark` INT(11),
                                    `total_point` INT(11),
                                    `grade` VARCHAR(2),
                                    `stream_position` INT(11),
                                    `class_position` INT(11),
                                    `comment` VARCHAR(140),
                                    UNIQUE (`year`, `term`, `stream`, `reg_no`),
                                    FOREIGN KEY (`reg_no`)
                                    REFERENCES  `students`(`reg_no`)
                                    ON DELETE CASCADE
                                    ON UPDATE CASCADE 
                                  )";

            $form_2 = "CREATE TABLE IF NOT EXISTS form_two_score_sheet
                                  (
                                  `id` INT(11) PRIMARY KEY AUTO_INCREMENT,
                                   `year` YEAR,
                                   `term` VARCHAR(6),
                                   `stream` VARCHAR(32),
                                   `reg_no` VARCHAR(32) NOT NULL,
                                    $column_part
                                    `total_mark` INT(11),
                                    `total_point` INT(11),
                                    `grade` VARCHAR(2),
                                    `stream_position` INT(11),
                                    `class_position` INT(11),
                                    `comment` VARCHAR(140),
                                    UNIQUE (`year`, `term`, `stream`, `reg_no`),
                                    FOREIGN KEY (`reg_no`)
                                    REFERENCES  `students`(`reg_no`)
                                    ON DELETE CASCADE
                                    ON UPDATE CASCADE 
                                  )";

            $form_3 = "CREATE TABLE IF NOT EXISTS form_three_score_sheet
                                  (
                                  `id` INT(11) PRIMARY KEY AUTO_INCREMENT,
                                   `year` YEAR,
                                   `term` VARCHAR(6),
                                   `stream` VARCHAR(32),
                                   `reg_no` VARCHAR(32) NOT NULL,
                                    $column_part
                                    `total_mark` INT(11),
                                    `total_point` INT(11),
                                    `grade` VARCHAR(2),
                                    `stream_position` INT(11),
                                    `class_position` INT(11),
                                    `comment` VARCHAR(140),
                                    UNIQUE (`year`, `term`, `stream`, `reg_no`),
                                    FOREIGN KEY (`reg_no`)
                                    REFERENCES  `students`(`reg_no`)
                                    ON DELETE CASCADE
                                    ON UPDATE CASCADE 
                                  )";

            $form_4 = "CREATE TABLE IF NOT EXISTS form_four_score_sheet
                                  (
                                  `id` INT(11) PRIMARY KEY AUTO_INCREMENT,
                                   `year` YEAR,
                                   `term` VARCHAR(6),
                                   `stream` VARCHAR(32),
                                   `reg_no` VARCHAR(32) NOT NULL,
                                    $column_part
                                    `total_mark` INT(11),
                                    `total_point` INT(11),
                                    `grade` VARCHAR(2),
                                    `stream_position` INT(11),
                                    `class_position` INT(11),
                                    `comment` VARCHAR(140),
                                    UNIQUE (`year`, `term`, `stream`, `reg_no`),
                                    FOREIGN KEY (`reg_no`)
                                    REFERENCES  `students`(`reg_no`)
                                    ON DELETE CASCADE
                                    ON UPDATE CASCADE 
                                  )";

            try {
                $conn->exec($form_1);
                $conn->exec($form_2);
                $conn->exec($form_3);
                $conn->exec($form_4);

                $db->closeConnection();
                return true;
            } catch (\PDOException $exception) {
                echo $exception->getMessage();
                return false;
            }
        } else{
            return false;
        }
    }

}