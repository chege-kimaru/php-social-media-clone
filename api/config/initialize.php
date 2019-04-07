<?php
/**
 * Created by PhpStorm.
 * User: Kevin Chege
 * Date: 10/02/2019
 * Time: 11:45
 */
require_once 'Database.php';
require_once '../model/User.php';
require_once '../model/Post.php';
require_once '../model/Comment.php';

$database = new Database();

$db = $database->connect();

$db->beginTransaction();
try {

    $user = new User($db);
    $user->createTable();
    $user->createFriends();

    $post = new Post($db);
    $post->createTable();
    $post->createLikes();

    $comment = new Comment($db);
    $comment->createTable();

    $db->commit();

    echo json_encode(array("data"=> "Successfully initialized database."));
} catch (Exception $e) {
    $db->rollBack();
    echo json_encode(array("error"=> $e->getMessage()));
}