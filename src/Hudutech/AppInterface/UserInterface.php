<?php
/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 4/5/17
 * Time: 9:12 PM
 */

namespace Hudutech\AppInterface;


use Hudutech\Entity\User;

interface UserInterface
{
    //crud functions
    public function createSingle(User $user);
    public function update(User $user, $id);
    public static function delete($id);
    public static function destroy();
    public static function getId($id);
    public static function all();
    public static function getUser($id);
    public static function approve($id);
    public static function blockUnblock($id, $status);
    public static function getRole($userId);
    public static function getUserPermission($userId);
}