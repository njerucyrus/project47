<?php
/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 4/4/17
 * Time: 10:28 PM
 */

namespace Hudutech\AppInterface;


use Hudutech\Entity\Subject;

interface SubjectInterface
{
    public function createSingle(Subject $subject);
    public function createMultiple(array $subjects);
    public function update(Subject $subject, $id);
    public static function delete($id);
    public static function destroy();
    public static function getId($id);
    public static function all();
    public static function getSubject($id);
}