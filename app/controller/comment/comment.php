<?php

if (isset($_POST['comment_r'])) {
    require_once '../api/model/Comment.php';
    require_once '../api/config/Database.php';

    try {
        $database = new Database();
        $db = $database->connect();

        $comment = new Comment($db);

        $comment->post_id = $_POST['post_id'];
        $comment->user_id = $_POST['user_id'];
        $comment->comment = $_POST['comment'];

        $comment->comment();

        header('Location: index.php');
    } catch (Exception $e) {
        $err = $e->getMessage();
        echo '<h4>'.$err.'</h4>';
    }
}
