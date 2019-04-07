<?php

if (isset($_POST['like'])) {
    require_once '../api/model/Post.php';
    require_once '../api/config/Database.php';

    try {
        $database = new Database();
        $db = $database->connect();

        $post = new Post($db);

        $post->id = $_POST['id'];
        $post->friend_id = $_POST['friend_id'];

        $post->like();

        header("Location: index.php");
    } catch (Exception $e) {
        $err = $e->getMessage();
        echo "<h4>$err</h4>";
    }
}
