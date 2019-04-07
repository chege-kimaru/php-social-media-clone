<?php
/**
 * Created by PhpStorm.
 * User: Kevin Chege
 * Date: 06/04/2019
 * Time: 00:11
 */

require_once '../api/model/User.php';
require_once '../api/config/Database.php';

try {
    $database = new Database();
    $db = $database->connect();

    $user = new User($db);
    $user->id = $user_id;

    $following = $user->fetchAllUsers(false, $user_id, true, false);
} catch (Exception $e) {
    echo json_encode(array("error" => $e->getMessage()));
}