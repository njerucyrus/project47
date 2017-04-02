<?php
/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 4/1/17
 * Time: 11:24 PM
 */

namespace App\Entity;


/**
 * Class StudentClass
 * @package App\Entity
 */
class StudentClass
{
    /**
     * @var int
     */
    private $id;
    /**
     * @var string
     */
    private $className;
    /**
     * @var string
     */
    private $stream;
    /**
     * @var int
     */
    private $capacity;

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
    public function getClassName()
    {
        return $this->className;
    }

    /**
     * @param string $className
     */
    public function setClassName($className)
    {
        $this->className = $className;
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
     * @return int
     */
    public function getCapacity()
    {
        return $this->capacity;
    }

    /**
     * @param int $capacity
     */
    public function setCapacity($capacity)
    {
        $this->capacity = $capacity;
    }

}