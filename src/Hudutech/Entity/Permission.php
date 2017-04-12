<?php
/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 4/7/17
 * Time: 9:44 AM
 */

namespace Hudutech\Entity;


/**
 * Class UserPermission
 * @package Hudutech\Entity
 */
class Permission
{

    /**
     * @var int
     */
    private $id;
    /**
     * @var string
     */
    private $permissionName;
    /**
     * @var string
     */
    private $permissionDescription;

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
    public function getPermissionName()
    {
        return $this->permissionName;
    }

    /**
     * @param string $permissionName
     */
    public function setPermissionName($permissionName)
    {
        $this->permissionName = $permissionName;
    }

    /**
     * @return string
     */
    public function getPermissionDescription()
    {
        return $this->permissionDescription;
    }

    /**
     * @param string $permissionDescription
     */
    public function setPermissionDescription($permissionDescription)
    {
        $this->permissionDescription = $permissionDescription;
    }


}