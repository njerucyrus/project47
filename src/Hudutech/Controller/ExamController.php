<?php
/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 4/11/17
 * Time: 9:46 AM
 */

namespace Hudutech\Controller;


use Hudutech\AppInterface\ExamInterface;
use Hudutech\Entity\Exam;

class ExamController implements ExamInterface
{
    public function create(Exam $exam)
    {
        $examName = $exam->getExamName();
        $outOf = $exam->getOutOf();
        $term = $exam->getTerm();

        try{
        } catch (\PDOException $exception){
            echo $exception->getMessage();
        }
    }

    public function update(Exam $exam, $id)
    {
        // TODO: Implement update() method.
    }

    public static function delete($id)
    {
        // TODO: Implement delete() method.
    }

    public static function getId($id)
    {
        // TODO: Implement getId() method.
    }

    public static function getExams($term)
    {
        // TODO: Implement getExams() method.
    }

}