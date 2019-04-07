<?php
/**
 * Created by PhpStorm.
 * User: Kevin Chege
 * Date: 06/04/2019
 * Time: 00:04
 */

session_start();

if (!isset($_SESSION['id'])) {
    header('location: login.php');
}

$user_id = $_SESSION['id'];

if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['id']);
    header("location: login.php");
}