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

        try{
            $stmt = $conn->prepare("SELECT subject_code, subject_name, has_pp3 FROM subjects WHERE 1");
            $stmt->execute();
            if($stmt->rowCount() > 0){
                $tableNames = array();
                while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
                    $tableName = array(
                        "table_name" => "std_".strtolower($row['subject_code'])."_".$row['subject_name']."_marks",
                        "has_pp3" => $row['has_pp3']
                    );
                    $tableNames[] = $tableName;
                }
                $db->closeConnection();
                return $tableNames;
            } else{
                return [];
            }

        } catch (\PDOException $exception){
                echo $exception->getMessage();
                return [];
        }
    }

    public static function createStandardExamTables()
    {
        // TODO: Implement createStandardExamTables() method.
    }

    public static function clearStandardExamTables()
    {
        // TODO: Implement clearStandardExamTables() method.
    }

}