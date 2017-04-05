<?php
/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 4/5/17
 * Time: 9:22 PM
 */

namespace Hudutech\Controller;

use Hudutech\AppInterface\UserInterface;
use Hudutech\Entity\User;
use Hudutech\DBManager\DB;


class UserController implements UserInterface
{
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

       try{
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
       } catch (\PDOException $exception){
           echo $exception->getMessage();
           return false;
       }

    }

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

        try{

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

        }catch (\PDOException $exception){
            echo $exception->getMessage();
            return false;
        }

    }

    public static function delete($id)
    {
        $db = new DB();
        $conn = $db->connect();

        try{
            $stmt = $conn->prepare("DELETE FROM users WHERE id=:id");
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            $db->closeConnection();
            return true;

        } catch (\PDOException $exception){
            echo $exception->getMessage();
            return false;
        }
    }

    public static function destroy()
    {
        $db = new DB();
        $conn = $db->connect();

        try{
            $stmt = $conn->prepare("DELETE FROM users");
            $stmt->execute();
            $db->closeConnection();
            return true;
        } catch (\PDOException $exception){
            echo $exception->getMessage();
            return false;
        }
    }

    public static function getId($id)
    {
        $db = new DB();
        $conn = $db->connect();

        try{
            $stmt = $conn->prepare("SELECT * FROM users WHERE id=:id");
            $stmt->bindParam(":id", $id);
            $stmt->execute();

            if($stmt->rowCount() == 1){
                $row = $stmt->fetch(\PDO::FETCH_ASSOC);
                $user =array(
                    "id"=>$row['id'],
                    "username" =>$row['username'],
                    "role_id" =>$row['role_id'],
                    "status" =>$row['status'],
                    "profile_image"=>$row['profile_image']
                );
                $db->closeConnection();
                return $user;
            }
            else{
                return [];
            }
        } catch (\PDOException $exception){
            echo $exception->getMessage();
            return [];
        }

    }

    public static function all()
    {
        $db = new DB();
        $conn = $db->connect();

        try{
            $stmt = $conn->prepare("SELECT * FROM users WHERE 1");

            $stmt->execute();

            if($stmt->rowCount() > 0){
                $users = array();
                while ( $row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
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
            }
            else{
                return [];
            }
        } catch (\PDOException $exception){
            echo $exception->getMessage();
            return [];
        }
    }

    public static function getUser($id)
    {
        // TODO: Implement getUser() method.
    }

    public static function approve($id)
    {
        // TODO: Implement approve() method.
    }

    public static function blockUnblock($id, $status)
    {
        // TODO: Implement blockUnblock() method.
    }

    public static function getRole($id)
    {
        // TODO: Implement getRole() method.
    }

}