<?php
/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 4/1/17
 * Time: 11:28 PM
 */

namespace Hudutech\Entity;


class Subject
{
    /**
     * @var int
     */
    private $id;
    /**
     * @var string
     */
    private $subjectName;
    /**
     * @var string
     * subject group can be Languages, Sciences, Humanities etc
     */
    private $subjectGroup;

    /**
     * @var int
     */
    private $subjectCode;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getSubjectName()
    {
        return $this->subjectName;
    }

    /**
     * @param string $subjectName
     */
    public function setSubjectName($subjectName)
    {
        $this->subjectName = $subjectName;
    }

    /**
     * @return string
     */
    public function getSubjectGroup()
    {
        return $this->subjectGroup;
    }

    /**
     * @param string $subjectGroup
     */
    public function setSubjectGroup($subjectGroup)
    {
        $this->subjectGroup = $subjectGroup;
    }

    /**
     * @return int
     */
    public function getSubjectCode()
    {
        return $this->subjectCode;
    }

    /**
     * @param int $subjectCode
     */
    public function setSubjectCode($subjectCode)
    {
        $this->subjectCode = $subjectCode;
    }


}