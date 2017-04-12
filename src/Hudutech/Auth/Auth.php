<?php
/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 4/6/17
 * Time: 12:25 AM
 */

namespace Hudutech\Auth;


use Hudutech\DBManager\DB;

/**
 * Class Auth
 * @package Hudutech\Auth
 */
class Auth
{
    /**
     * @var string
     */
    private $csrf_token;

    /**
     * @param $username
     * @param $password
     * @return bool
     */
    public static function authenticate($username, $password)
    {
        $db = new DB();
        $conn = $db->connect();
        try {
            $stmt = $conn->prepare("SELECT * FROM users WHERE username=:username");
            $stmt->bindParam(":username", $username);

            $stmt->execute();

            if ($stmt->rowCount() == 1) {

                $row = $stmt->fetch(\PDO::FETCH_ASSOC);

                return password_verify($password, $row['password']) ? true : false;

            } else {
                return false;
            }
        } catch (\PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    /**
     * @return string
     * generates crsf token to be using when performing form submission via
     * the web this reduces the cross forgery request  attacks
     */
    public function generateToken(){
        return $this->csrf_token = sha1(md5(uniqid("auth_token", true)));
    }
}