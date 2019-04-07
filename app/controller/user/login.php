<?php
session_start();

if (isset($_POST['login'])) {
    require_once '../api/model/User.php';
    require_once '../api/config/Database.php';

    try {
        $database = new Database();
        $db = $database->connect();

        $user = new User($db);

        $user->email = $_POST['email'];

        $user->setUser(true);
        if (password_verify($_POST['password'], $user->password)) {
            $_SESSION['id'] = $user->id;
            header('Location: index.php');
        } else {
            echo "<h4>Wrong username or password</h4>";
        }

    } catch (Exception $e) {
        $err = $e->getMessage();
        echo "<h4>$err</h4>";
    }
}
