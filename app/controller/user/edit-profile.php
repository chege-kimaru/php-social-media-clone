<?php

if (isset($_POST['edit-profile'])) {
    require_once '../api/model/User.php';
    require_once '../api/config/Database.php';

    try {
        $database = new Database();
        $db = $database->connect();

        $user = new User($db);

        $user->id = $_POST['id'];
        $user->name = $_POST['name'];
        $user->email = $_POST['email'];
        $user->phone = $_POST['phone'];
        $user->dob = $_POST['dob'];
        $user->location = $_POST['location'];
        $user->education = $_POST['education'];
        $user->password = $_POST['password'];

        //TODO:// REMOVE CURRENT IMAGE BEFORE ADDING THE NEW ONE

        if (is_uploaded_file($_FILES['file']['tmp_name'])) {
            $img = $_FILES['file']['name'];
            $new_img = time() . $img;
            $tmp = $_FILES['file']['tmp_name'];
            $type = $_FILES['file']['type'];

            $dir = 'images/';
            $new_img_path = $dir . $new_img;

            mkdir($dir, 0777, true);

            if (move_uploaded_file($tmp, $new_img_path)) {
                $user->image = 'images/' . $new_img;
                $user->editUser();
                header('Location: edit-profile.php');
            } else {
                throw new Exception('Could not upload image');
            }

        } else {
            $user->editUser();
            header('Location: edit-profile.php');
        }
    } catch (Exception $e) {
        $err = $e->getMessage();
        echo $err;
    }
}
