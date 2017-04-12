<?php
/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 4/7/17
 * Time: 10:10 AM
 */

namespace Hudutech\AppInterface;


use Hudutech\Entity\Permission;

interface PermissionInterface
{
    /**
     * @param Permission $permission
     * @return bool
     */
    public function create(Permission $permission);

    /**
     * @param Permission $permission
     * @param $id
     * @return mixed
     */
    public function update(Permission $permission, $id);

    /**
     * @param $id
     * @return bool
     */
    public static function getId($id);

    /**
     * @param $id
     * @return bool
     */
    public static function delete($id);

    /**
     * @return bool
     */
    public static function destroy();

    /**
     * @return array
     */
    public static function all();


}