<?php
/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 4/7/17
 * Time: 9:00 PM
 */

namespace Hudutech\Entity;


/**
 * Class Role
 * @package Hudutech\Entity
 */
class Role
{
    /**
     * @var int
     */
    private $id;
    /**
     * @var string
     */
    private $roleName;

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
    public function getRoleName()
    {
        return $this->roleName;
    }

    /**
     * @param string $roleName
     */
    public function setRoleName($roleName)
    {
        $this->roleName = $roleName;
    }

}