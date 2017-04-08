<?php
/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 4/7/17
 * Time: 9:03 PM
 */

namespace Hudutech\AppInterface;


use Hudutech\Entity\Role;

interface RoleInterface
{
    public function create(Role $role);
    public function update(Role $role, $id);
    public static function delete($id);
    public static function destroy();
    public static function getId($id);
    public static function all();
    public static function addPermission($roleId, array $permissionId);
    public static function removePermission($roleId, array $permissionId);

}