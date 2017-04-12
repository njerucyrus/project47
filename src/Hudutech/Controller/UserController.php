<?php
/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 4/5/17
 * Time: 9:22 PM
 */

namespace Hudutech\Controller;

use Hudutech\AppInterface\UserInterface;
use Hudutech\Auth\Auth;
use Hudutech\DBManager\DB;
use Hudutech\Entity\User;


/**
 * Class UserController
 * @package Hudutech\Controller
 */
class UserController extends Auth implements UserInterface
{

    /**
     * @param User $user
     * @return bool
     */
    public function createSingle(User $user)
    {
        $db = new DB();
        $conn = $db->connect();

        $username = $user->getUsername();
        $password = $user->getPassword();
        $roleId = $user->getRoleId();
        $ipAddress = $user->getIpAddress();
        $status = $user->getStatus();
        $profileImage = $user->getProfileImage();

        try {
            $stmt = $conn->prepare("INSERT INTO users (
                                                        username,
                                                        password,
                                                        role_id,
                                                        ip_address,
                                                        profile_image,
                                                        status
                                                      )
                                                 VALUES
                                                  (
                                                        :username,
                                                        :password,
                                                        :role_id,
                                                        :ip_address,
                                                        :profile_image,                     
                                                        :status
                                                  )");

            $stmt->bindParam(":username", $username);
            $stmt->bindParam(":password", $password);
            $stmt->bindParam(":role_id", $roleId);
            $stmt->bindParam(":ip_address", $ipAddress);
            $stmt->bindParam(":status", $status);
            $stmt->bindParam(":profile_image", $profileImage);
            $stmt->execute();
            $db->closeConnection();
            return true;
        } catch (\PDOException $exception) {
            echo $exception->getMessage();
            return false;
        }

    }

    /**
     * @param User $user
     * @param $id
     * @return bool
     */
    public function update(User $user, $id)
    {

        $db = new DB();
        $conn = $db->connect();

        $username = $user->getUsername();
        $password = $user->getPassword();
        $roleId = $user->getRoleId();
        $ipAddress = $user->getIpAddress();
        $status = $user->getStatus();
        $profileImage = $user->getProfileImage();

        try {

            $stmt = $conn->prepare("UPDATE users SET 
                                                    username=:username,
                                                    password=:password,
                                                    role_id=:role_id,
                                                    ip_address=:ip_address,
                                                    status=:status,
                                                    profile_image=:profile_image
                                                    ");

            $stmt->bindParam(":username", $username);
            $stmt->bindParam(":password", $password);
            $stmt->bindParam(":role_id", $roleId);
            $stmt->bindParam(":ip_address", $ipAddress);
            $stmt->bindParam(":status", $status);
            $stmt->bindParam(":profile_image", $profileImage);
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
            $stmt = $conn->prepare("DELETE FROM users WHERE id=:id");
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
            $stmt = $conn->prepare("DELETE FROM users");
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
            $stmt = $conn->prepare("SELECT * FROM users WHERE id=:id");
            $stmt->bindParam(":id", $id);
            $stmt->execute();

            if ($stmt->rowCount() == 1) {
                $row = $stmt->fetch(\PDO::FETCH_ASSOC);
                $user = array(
                    "id" => $row['id'],
                    "username" => $row['username'],
                    "role_id" => $row['role_id'],
                    "status" => $row['status'],
                    "profile_image" => $row['profile_image']
                );
                $db->closeConnection();
                return $user;
            } else {
                return [];
            }
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
            $stmt = $conn->prepare("SELECT * FROM users WHERE 1");

            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $users = array();
                while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
                    $user = array(
                        "id" => $row['id'],
                        "username" => $row['username'],
                        "role_id" => $row['role_id'],
                        "status" => $row['status'],
                        "profile_image" => $row['profile_image']
                    );
                    $users[] = $user;

                }
                $db->closeConnection();
                return $users;
            } else {
                return [];
            }
        } catch (\PDOException $exception) {
            echo $exception->getMessage();
            return [];
        }
    }

    /**
     * @param $id
     * @return array|User
     */
    public static function getUser($id)
    {
        $db = new DB();
        $conn = $db->connect();

        try {
            $stmt = $conn->prepare("SELECT * FROM users WHERE id=:id");
            $stmt->bindParam(":id", $id);
            $stmt->execute();

            if ($stmt->rowCount() == 1) {
                $row = $stmt->fetch(\PDO::FETCH_ASSOC);
                $user = new User();
                $user->setId($row['id']);
                $user->setUsername($row['username']);
                $user->setRoleId($row['role_id']);
                $user->setStatus($row['status']);
                $user->setProfileImage($row['profile_image']);
                $user->setLastLogin($row['last_login']);
                $user->setCreatedAt($row['created_at']);

                $db->closeConnection();
                return $user;
            } else {
                return [];
            }
        } catch (\PDOException $exception) {
            echo $exception->getMessage();
            return [];
        }
    }

    /**
     * @param $id
     * @return bool
     */
    public static function approve($id)
    {
        $db = new DB();
        $conn = $db->connect();

        try {

            $stmt = $conn->prepare("UPDATE users SET `status`='approved' WHERE id=:id");
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
     * @param $id
     * @param $status
     * @return bool
     */
    public static function blockUnblock($id, $status)
    {
        $db = new DB();
        $conn = $db->connect();

        try {

            $stmt = $conn->prepare("UPDATE users SET `status`='{$status}' WHERE id=:id");
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
     * @param $userId
     * @return null
     */
    public static function getRole($userId)
    {
        $db = new DB();
        $conn = $db->connect();

        try {

            $stmt = $conn->prepare("SELECT  users.role_id FROM hudutech_next.users WHERE id=:id");
            $stmt->bindParam(":id", $userId);
            $stmt->execute();
            if ($stmt->rowCount() == 1) {
                $row = $stmt->fetch(\PDO::FETCH_ASSOC);
                return $row['role_id'];
            } else {
                return null;
            }

        } catch (\PDOException $exception) {
            echo $exception->getMessage();
            return null;
        }
    }


    /**
     * @param $userId
     * @return array
     */
    public static function getUserPermission($userId)
    {
        $db = new DB();
        $conn = $db->connect();
        $roleId = self::getRole($userId);


        if (!empty($userId) and !empty($roleId)) {
            try {

                $stmt = $conn->prepare("SELECT permission_id FROM user_permissions WHERE role_id=:role_id");

                $stmt->bindParam(":role_id",$roleId);
                $stmt->execute();
                if ($stmt->rowCount() > 0) {
                    $permissions = array();
                    while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
                        $permissions[] = $row['permission_id'];
                    }
                    return $permissions;
                } else {
                    return [];
                }

            } catch (\PDOException $exception) {
                echo $exception->getMessage();
                return [];
            }
        } else {
            return [];
        }
    }

}