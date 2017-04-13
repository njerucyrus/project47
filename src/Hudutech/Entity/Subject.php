<?php
/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 4/1/17
 * Time: 11:28 PM
 */

namespace Hudutech\Entity;


/**
 * Class Subject
 * @package Hudutech\Entity
 */
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
     * @var boolean
     */
    private $active;

    /**
     * @var boolean
     */
    private $compulsory;

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

    /**
     * @return bool
     */
    public function isActive()
    {
        return $this->active;
    }

    /**
     * @param bool $active
     */
    public function setActive($active)
    {
        $this->active = $active;
    }

    /**
     * @return bool
     */
    public function isCompulsory()
    {
        return $this->compulsory;
    }

    /**
     * @param bool $compulsory
     */
    public function setCompulsory($compulsory)
    {
        $this->compulsory = $compulsory;
    }






}