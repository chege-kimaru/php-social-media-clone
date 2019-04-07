<?php

if (isset($_POST['follow'])) {
    require_once '../api/model/User.php';
    require_once '../api/config/Database.php';

    try {
        $database = new Database();
        $db = $database->connect();

        $user = new User($db);

        $user->id = $_POST['id'];
        $user->friend_id = $_POST['friend_id'];

        $user->follow();

        header("Location: people.php?name=".$_GET['name']);
    } catch (Exception $e) {
        $err = $e->getMessage();
        echo "<h4>$err</h4>";
    }
}
