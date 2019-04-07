<?php

if (isset($_POST['post'])) {
    require_once '../api/model/Post.php';
    require_once '../api/config/Database.php';

    try {
        $database = new Database();
        $db = $database->connect();

        $post = new Post($db);

        $post->post = $_POST['status'];
        $post->user_id = $_POST['user_id'];

        if (is_uploaded_file($_FILES['file']['tmp_name'])) {
            $img = $_FILES['file']['name'];
            $new_img = time() . $img;
            $tmp = $_FILES['file']['tmp_name'];
            $type = $_FILES['file']['type'];

            $dir = 'images/';
            $new_img_path = $dir . $new_img;

            mkdir($dir, 0777, true);

            if (move_uploaded_file($tmp, $new_img_path)) {
                $post->image = 'images/' . $new_img;
                $post->post();

                header('Location: index.php');
            } else {
                throw new Exception('Could not upload image');
            }

        } else {
            $post->post();
            header('Location: index.php');
        }
    } catch (Exception $e) {
        $err = $e->getMessage();
        echo $err;
    }
}
