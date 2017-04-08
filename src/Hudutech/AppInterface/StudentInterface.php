<?php
/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 4/1/17
 * Time: 11:36 PM
 */

namespace Hudutech\AppInterface;
use Hudutech\Entity\Student;

interface StudentInterface
{
    //crud functions
    public function createSingle(Student $student);
    public function createMultiple(array $students);
    public function update(Student $student, $id);
    public static function delete($id);
    public static function destroy();
    public static function getId($id);
    public static function all();
    public static function getStudent($id);
    //end of crud functions
    public function promoteToNextClass(array $students, $class);
    public static function assignSubject(array $studentId , $subjectId);
    public static function removeSubject($studentId, array $subjectId);
    public static function getStudentSubjects($studentId);
}