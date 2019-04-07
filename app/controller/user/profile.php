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

    $user->id = $_GET['id'];
    $user_profile = $user->fetchSingleUser();
    
    $user->id = $user_id;
    $profile = $user->fetchSingleUser();

} catch (Exception $e) {
    echo json_encode(array("error" => $e->getMessage()));
}