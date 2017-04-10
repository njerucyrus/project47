<?php
/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 4/10/17
 * Time: 10:29 AM
 */

namespace Hudutech\AppInterface;


interface ExamTableInterface
{
    public static function fetchStandardExamTableNames();
    public static function createStandardExamTables();
    public static function clearStandardExamTables();
}