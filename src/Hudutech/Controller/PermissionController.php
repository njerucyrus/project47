<?php
/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 4/7/17
 * Time: 10:09 AM
 */

namespace Hudutech\Controller;


use Hudutech\AppInterface\PermissionInterface;
use Hudutech\DBManager\DB;
use Hudutech\Entity\Permission;

class PermissionController implements PermissionInterface
{
    public function create(Permission $permission)
    {
        $db = new DB();
        $conn = $db->connect();
        $permissionName = $permission->getPermissionName();
        $permissionDescription = $permission->getPermissionDescription();
        try {
            $stmt = $conn->prepare("INSERT INTO permissions(perm_name, perm_description)
                                    VALUES (:perm_name, :perm_description)");
            $stmt->bindParam(":perm_name", $permissionName);
            $stmt->bindParam(":perm_description", $permissionDescription);
            $stmt->execute();
            $db->closeConnection();
            return true;
        } catch (\PDOException $exception) {
            echo $exception->getMessage();
            return false;
        }

    }

    public function update(Permission $permission, $id)
    {
        $db = new DB();
        $conn = $db->connect();
        $permissionName = $permission->getPermissionName();
        $permissionDescription = $permission->getPermissionDescription();
        try {
            $stmt = $conn->prepare("UPDATE permissions SET perm_name=:perm_name,
                                                           perm_description=:perm_description
                                                        WHERE
                                                             id=:id
                                                            ");

            $stmt->bindParam(":id", $id);
            $stmt->bindParam(":perm_name", $permissionName);
            $stmt->bindParam(":perm_description", $permissionDescription);
            $stmt->execute();
            $db->closeConnection();
            return true;
        } catch (\PDOException $exception) {
            echo $exception->getMessage();
            return false;
        }
    }

    public static function getId($id)
    {
        $db = new DB();
        $conn = $db->connect();
        try {
            $stmt = $conn->prepare("SELECT * FROM permissions WHERE id=:id");
            $stmt->bindParam(":id", $id);
            $stmt->execute();

            if ($stmt->rowCount() == 1) {
                $row = $stmt->fetch(\PDO::FETCH_ASSOC);
                $permission = array(
                    "id" => $row['id'],
                    "perm_name" => $row['perm_name'],
                    "perm_description" => $row['perm_description']
                );
                $db->closeConnection();
                return $permission;
            } else {
                return [];
            }
        } catch (\PDOException $exception) {

            echo $exception->getMessage();
            return [];
        }
    }

    public static function delete($id)
    {
        $db = new DB();
        $conn = $db->connect();

        try{
            $stmt = $conn->prepare("DELETE FROM permissions WHERE id=:id");
            $stmt->bindParam(":id",$id);
            $stmt->execute();
            $db->closeConnection();
            return true;

        } catch (\PDOException $exception) {
            echo $exception->getMessage();
            return false;

        }
    }

    public static function destroy()
    {
        $db = new DB();
        $conn = $db->connect();

        try{
            $stmt = $conn->prepare("DELETE FROM permissions");
            $stmt->execute();
            $db->closeConnection();
            return true;

        } catch (\PDOException $exception) {
            echo $exception->getMessage();
            return false;

        }
    }

    public static function all()
    {
        $db = new DB();
        $conn = $db->connect();
        try {
            $stmt = $conn->prepare("SELECT * FROM permissions WHERE 1");
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $perms = array();
               while ( $row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
                   $permission = array(
                       "id" => $row['id'],
                       "perm_name" => $row['perm_name'],
                       "perm_description" => $row['perm_description']
                   );
                   $perms[] = $permission;
               }
                $db->closeConnection();
                return $perms;
            } else {
                return [];
            }
        } catch (\PDOException $exception) {

            echo $exception->getMessage();
            return [];
        }
    }

}