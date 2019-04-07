<?php
/**
 * Created by PhpStorm.
 * User: Kevin Chege
 * Date: 06/04/2019
 * Time: 00:11
 */

require_once '../api/model/Post.php';
require_once '../api/config/Database.php';

try {
    $database = new Database();
    $db = $database->connect();

    $post = new Post($db);
    $post->user_id = $user_id;

    $posts = $post->fetchPosts($user_id);
} catch (Exception $e) {
    echo json_encode(array("error" => $e->getMessage()));
}