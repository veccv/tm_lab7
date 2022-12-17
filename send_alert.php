<?php
include "Database.php";
session_start();
$alert = $_POST['alert'];
$receiver_id = $_POST['user_id'];
$user = $_SESSION['user'];
$sender_id = mysqli_fetch_array(Database::getConnection()->query("SELECT * FROM user WHERE login='$user'"))[0];

Database::getConnection()->query("INSERT INTO alert (sender, receiver, message) VALUES ('$sender_id', '$receiver_id', '$alert')");
Database::getConnection()->close();
header('Location: index4.php');