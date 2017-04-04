<?php
/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 4/2/17
 * Time: 5:12 PM
 */

namespace Hudutech\Entity;


class Teacher
{
    /**
     * @var int
     */
    private $id;
    /**
     * @var string
     */
    private $sirName;
    /**
     * @var string
     */
    private $middleName;
    /**
     * @var string
     */
    private $lastName;
    /**
     * @var string
     */
    private $tscNo;
    /**
     * @var string
     */
    private $nationalId;
    /**
     * @var string
     */
    private $speciality;

    /**
     * @var string
     */
    private $gender;

    /**
     * @var \DateTime
     */
    private $dateRegistered;

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
    public function getSirName()
    {
        return $this->sirName;
    }

    /**
     * @param string $sirName
     */
    public function setSirName($sirName)
    {
        $this->sirName = $sirName;
    }

    /**
     * @return string
     */
    public function getMiddleName()
    {
        return $this->middleName;
    }

    /**
     * @param string $middleName
     */
    public function setMiddleName($middleName)
    {
        $this->middleName = $middleName;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * @return string
     */
    public function getTscNo()
    {
        return $this->tscNo;
    }

    /**
     * @param string $tscNo
     */
    public function setTscNo($tscNo)
    {
        $this->tscNo = $tscNo;
    }

    /**
     * @return string
     */
    public function getNationalId()
    {
        return $this->nationalId;
    }

    /**
     * @param string $nationalId
     */
    public function setNationalId($nationalId)
    {
        $this->nationalId = $nationalId;
    }

    /**
     * @return string
     */
    public function getSpeciality()
    {
        return $this->speciality;
    }

    /**
     * @param string $speciality
     */
    public function setSpeciality($speciality)
    {
        $this->speciality = $speciality;
    }

    /**
     * @return string
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * @param string $gender
     */
    public function setGender($gender)
    {
        $this->gender = $gender;
    }

    /**
     * @return \DateTime
     */
    public function getDateRegistered()
    {
        return $this->dateRegistered;
    }

    /**
     * @param \DateTime $dateRegistered
     */
    public function setDateRegistered($dateRegistered)
    {
        $this->dateRegistered = $dateRegistered;
    }


}