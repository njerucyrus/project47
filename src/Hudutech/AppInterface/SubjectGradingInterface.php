<?php
/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 4/10/17
 * Time: 1:12 AM
 */

namespace Hudutech\AppInterface;


interface SubjectGradingInterface
{
    /**
     * @param array $grade
     * @return boolean
     * the grade is an array consisting N arrays where N=12
     * grade = [
     *          array( "low_mark"=>value,
     *                 "high_mark"=>value,
     *                 "points"=>value,
     *                 "comment"=>"comment text"
     *              )
     *        ]
     *
     */
    public static function batchCreate(array $grade);

    /**
     * @param array $grade
     * @return boolean
     * the grade array includes extra key id
     */
    public static function batchUpdate(array $grade);

    /**
     * @param array $grade
     * @return boolean
     * the grade array includes extra key id
     */
    public static function updateSingle(array $grade);

    /**
     * @param $id
     * @return boolean
     * deletes single grade row in the db table
     */
    public static function delete($id);

    /**
     * @return boolean
     * deletes all rows from grade system table
     *
     */
    public static function destroy();

    /**
     * @param $score
     * @return array
     * returns the array of grade_letter and comment
     * eg ['grade_letter'=>'B+', 'comment'=>'excellent']
     */
    public static function getGrade($score);

    /**
     * @param $config
     * config = array("year"=>value, "term"=>value, "student_class"=>value,"subject"=>value)
     * @return array
     */
    public static function getStandardExamTotal(array $config);

}