<?php

if (isset($_POST['register'])) {
    require_once '../api/model/User.php';
    require_once '../api/config/Database.php';

    try {
        $database = new Database();
        $db = $database->connect();

        $user = new User($db);

        $user->name = $_POST['name'];
        $user->email = $_POST['email'];
        $user->phone = $_POST['phone'];
        $user->dob = $_POST['dob'];
        $user->location = $_POST['location'];
        $user->education = $_POST['education'];
        $user->password = $_POST['password'];

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
                $user->register();
                echo "
                    <script>alert('Registration Successful');</script>
                ";
                header('Location: login.php');
            } else {
                throw new Exception('Could not upload image');
            }

        } else {
            $user->register();
            echo "
                <script>alert('Registration Successful');</script>
            ";
            header('Location: login.php');
        }
    } catch (Exception $e) {
        $err = $e->getMessage();
        echo $err;
        echo "
            <script>alert('Registration failed. $err');</script>
        ";
    }
}
