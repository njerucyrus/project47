<?php
/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 4/1/17
 * Time: 11:17 PM
 */

namespace Hudutech\Entity;


class Student
{
    /**
     * @var int;
     */
    private $id;

    /**
     * @var string
     */
    private $firstName;
    /**
     * @var string
     */
    private $lastName;
    /**
     * @var string
     */
    private $otherName;

    /**
     * @var string
     */
    private $gender;

    /**
     * @var string
     */
    private $regNo;
    /**
     * @var string
     */
    private $currentClass;

    /**
     * @var string
     */
    private $classJoined;

    /**
     * @var string
     */
    private $stream;

    /**
     * @var \DateTime
     */
    private $dob;


    /**
     * @var string
     */
    private $profileImage;

    /**
     * @var string
     */
    private $parentName;

    /**
     * @var string
     */
    private $phoneNumber;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $address;

    /**
     * @var string
     */
    private $occupation;
    /**
     * @var \DateTime
     */
    private $dateEnrolled;

    /**
     * @var string
     */
    private $status;

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
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
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
    public function getOtherName()
    {
        return $this->otherName;
    }

    /**
     * @param string $otherName
     */
    public function setOtherName($otherName)
    {
        $this->otherName = $otherName;
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
     * @return string
     */
    public function getRegNo()
    {
        return $this->regNo;
    }

    /**
     * @param string $regNo
     */
    public function setRegNo($regNo)
    {
        $this->regNo = $regNo;
    }

    /**
     * @return string
     */
    public function getCurrentClass()
    {
        return $this->currentClass;
    }

    /**
     * @param string $currentClass
     */
    public function setCurrentClass($currentClass)
    {
        $this->currentClass = $currentClass;
    }

    /**
     * @return string
     */
    public function getStream()
    {
        return $this->stream;
    }

    /**
     * @param string $stream
     */
    public function setStream($stream)
    {
        $this->stream = $stream;
    }



    /**
     * @return \DateTime
     */
    public function getDob()
    {
        return $this->dob;
    }

    /**
     * @param \DateTime $dob
     */
    public function setDob($dob)
    {
        $this->dob = $dob;
    }

    /**
     * @return string
     */
    public function getProfileImage()
    {
        return $this->profileImage;
    }

    /**
     * @param string $profileImage
     */
    public function setProfileImage($profileImage)
    {
        $this->profileImage = $profileImage;
    }



    /**
     * @return string
     */
    public function getParentName()
    {
        return $this->parentName;
    }

    /**
     * @param string $parentName
     */
    public function setParentName($parentName)
    {
        $this->parentName = $parentName;
    }

    /**
     * @return string
     */
    public function getOccupation()
    {
        return $this->occupation;
    }

    /**
     * @param string $occupation
     */
    public function setOccupation($occupation)
    {
        $this->occupation = $occupation;
    }

    /**
     * @return \DateTime
     */
    public function getDateEnrolled()
    {
        return $this->dateEnrolled;
    }

    /**
     * @param \DateTime $dateEnrolled
     */
    public function setDateEnrolled($dateEnrolled)
    {
        $this->dateEnrolled = $dateEnrolled;
    }

    /**
     * @return string
     */
    public function getClassJoined()
    {
        return $this->classJoined;
    }

    /**
     * @param string $classJoined
     */
    public function setClassJoined($classJoined)
    {
        $this->classJoined = $classJoined;
    }

    /**
     * @return string
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    /**
     * @param string $phoneNumber
     */
    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param string $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }


}