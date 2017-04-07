<?
/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 4/2/17
 * Time: 12:34 AM
 */

require_once "vendor/autoload.php";

$ctrl = \Hudutech\Controller\UserController::getUserPermission(1);
//$ctrl = \Hudutech\Controller\UserController::getRole(1);

print_r($ctrl);