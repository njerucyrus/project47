<?php
/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 4/10/17
 * Time: 10:58 PM
 */

namespace Hudutech\AppInterface;


use Hudutech\Entity\Exam;

interface ExamInterface
{
  public function create(Exam $exam);
  public function update(Exam $exam, $id);
  public static function delete($id);
  public static function destroy();
  public static function getId($id);
  public static function getExams($term);

}