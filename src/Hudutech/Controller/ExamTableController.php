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
            $stmt = $conn->prepare("SELECT subject_code, subject_name, has_pp3 FROM subjects WHERE 1");
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
                                                            `id` INT(11),
                                                            `student_id` INT(11),
                                                            `year` INT(4),
                                                            `term` VARCHAR(6),
                                                            `student_class` VARCHAR(6),
                                                             $exam_paper_fields,
                                                            `grade` VARCHAR(2),
                                                            `points` INT(2),
                                                            `comment` VARCHAR(128),
                                                            UNIQUE( `student_id`, `year`, `term`, `student_class`),
                                                            PRIMARY KEY AUTO_INCREMENT(`id`),
                                                            FOREIGN KEY (`student_id`)
                                                            REFERENCES  `students`(`id`)
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
        try{
            foreach ($tableNames as $tableName){
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

}