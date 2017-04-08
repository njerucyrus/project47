<?php
/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 4/7/17
 * Time: 9:03 PM
 */

namespace Hudutech\Controller;


use Hudutech\AppInterface\RoleInterface;
use Hudutech\DBManager\DB;
use Hudutech\Entity\Role;

/**
 * Class RoleController
 * @package Hudutech\Controller
 */
class RoleController implements RoleInterface
{
    /**
     * @param Role $role
     * @return bool
     */
    public function create(Role $role)
    {
        $db = new DB();
        $conn = $db->connect();

        $roleName = $role->getRoleName();

        try {
            $stmt = $conn->prepare("INSERT INTO user_roles(role_name) VALUES (:role_name)");
            $stmt->bindParam(":role_name", $roleName);
            $stmt->execute();
            $db->closeConnection();
            return true;
        } catch (\PDOException $exception) {
            echo $exception->getMessage();
            return false;
        }

    }

    /**
     * @param Role $role
     * @param $id
     * @return bool
     */
    public function update(Role $role, $id)
    {
        $db = new DB();
        $conn = $db->connect();
        $roleName = $role->getRoleName();
        try {
            $stmt = $conn->prepare("UPDATE user_roles SET role_name=:role_name WHERE id=:id");
            $stmt->bindParam(":id", $id);
            $stmt->bindParam(":role_name", $roleName);
            $stmt->execute();
            $db->closeConnection();
            return true;
        } catch (\PDOException $exception) {
            echo $exception->getMessage();
            return false;
        }
    }

    /**
     * @param $id
     * @return bool
     */
    public static function delete($id)
    {
        $db = new DB();
        $conn = $db->connect();

        try {
            $stmt = $conn->prepare("DELETE FROM user_roles WHERE id=:id");
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            $db->closeConnection();
            return true;
        } catch (\PDOException $exception) {
            echo $exception->getMessage();
            return false;
        }
    }

    /**
     * @return bool
     */
    public static function destroy()
    {
        $db = new DB();
        $conn = $db->connect();

        try {
            $stmt = $conn->prepare("DELETE FROM user_roles");
            $stmt->execute();
            $db->closeConnection();
            return true;
        } catch (\PDOException $exception) {
            echo $exception->getMessage();
            return false;
        }
    }

    /**
     * @param $id
     * @return array
     */
    public static function getId($id)
    {
        $db = new DB();
        $conn = $db->connect();

        try {
            $stmt = $conn->prepare("SELECT * FROM user_roles WHERE id=:id");
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            if ($stmt->rowCount() == 1) {
                $row = $stmt->fetch(\PDO::FETCH_ASSOC);
                return array(
                    "id" => $row['id'],
                    "role_name" => $row['role_name']
                );
            }
            $db->closeConnection();
            return [];
        } catch (\PDOException $exception) {
            echo $exception->getMessage();
            return [];
        }
    }

    /**
     * @return array
     */
    public static function all()
    {
        $db = new DB();
        $conn = $db->connect();

        try {
            $stmt = $conn->prepare("SELECT * FROM user_roles WHERE id=:id");
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            if ($stmt->rowCount() == 1) {
                $roles = array();
                while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
                    $role = array(
                        "id" => $row['id'],
                        "role_name" => $row['role_name']
                    );

                    $roles[]=$role;
                }
                return $roles;
            }
            $db->closeConnection();
            return [];
        } catch (\PDOException $exception) {
            echo $exception->getMessage();
            return [];
        }
    }

    /**
     * @param $roleId
     * @param array $permissionId
     * @return bool
     */
    public static function addPermission($roleId, array $permissionId)
    {
        $db = new DB();
        $conn = $db->connect();
        try{

            $stmt = $conn->prepare("INSERT INTO user_permissions(role_id, permission_id)
                                    VALUES (:role_id, :permission_id)");

            foreach ($permissionId as $perm_id){
                $stmt->bindParam(":role_id", $roleId);
                $stmt->bindParam(":permission_id", $perm_id);
                $stmt->execute();
            }

            $db->closeConnection();
            return true;

        } catch (\PDOException $exception) {
            echo $exception->getMessage();
            return false;
        }
    }

    /**
     * @param $roleId
     * @param array $permissionId
     * @return bool
     */
    public static function removePermission($roleId, array $permissionId)
    {
        $db = new DB();
        $conn = $db->connect();
        try{

            $stmt = $conn->prepare("DELETE FROM  user_permissions WHERE  role_id=:role_id AND permission_id=:permission_id");

            foreach ($permissionId as $perm_id){
                $stmt->bindParam(":role_id", $roleId);
                $stmt->bindParam(":permission_id", $perm_id);
                $stmt->execute();
            }

            $db->closeConnection();
            return true;

        } catch (\PDOException $exception) {
            echo $exception->getMessage();
            return false;
        }
    }


}