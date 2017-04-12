<?php
/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 4/2/17
 * Time: 5:16 PM
 */

namespace Hudutech\AppInterface;


use Hudutech\Entity\Teacher;

interface TeacherInterface
{
    public function createSingle(Teacher $teacher);
    public function createMultiple(array $teachers);
    public function update(Teacher $teacher, $id);
    public static function delete($id);
    public static function destroy();
    public static function getId($id);
    public static function all();
    public static function getTeacher($id);
    public static function assignTeachingSubject($teacherId, array $subjectId);
    public static function removeTeachingSubject($teacherId, array $subjectId);
    public static function getTeacherSubject($teacherId);
}