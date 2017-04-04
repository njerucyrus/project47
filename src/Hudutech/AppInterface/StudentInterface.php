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
    public function createSingle(Student $student);
    public function createMultiple(array $students);
    public function update(Student $student, $id);
    public static function delete($id);
    public static function destroy();
    public static function getId($id);
    public static function all();
    public static function getStudent($id);
}