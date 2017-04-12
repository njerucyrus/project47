<?php
/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 4/10/17
 * Time: 10:36 PM
 */

namespace Hudutech\Entity;

class Exam
{
    /**
     * @var string
     */
    private $term;
    /**
     * @var string
     */
    private $examName;
    /**
     * @var int
     */
    private $outOf;

    /**
     * @return string
     */
    public function getTerm()
    {
        return $this->term;
    }

    /**
     * @param string $term
     */
    public function setTerm($term)
    {
        $this->term = $term;
    }

    /**
     * @return string
     */
    public function getExamName()
    {
        return $this->examName;
    }

    /**
     * @param string $examName
     */
    public function setExamName($examName)
    {
        $this->examName = $examName;
    }

    /**
     * @return int
     */
    public function getOutOf()
    {
        return $this->outOf;
    }

    /**
     * @param int $outOf
     */
    public function setOutOf($outOf)
    {
        $this->outOf = $outOf;
    }

}