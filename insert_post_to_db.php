<?php
include "Database.php";
session_start();
$message = $_POST['message'];
$user = $_SESSION['user'];
$user_id = mysqli_fetch_array(Database::getConnection()->query("SELECT * FROM user WHERE login='$user'"))[0];
$thread_id = $_POST['thread_id'];

Database::getConnection()->query("INSERT INTO post (message, user_id, thread_id) VALUES ('$message', '$user_id', '$thread_id')");
Database::getConnection()->close();
header('Location: thread_view.php?id=' . $thread_id);