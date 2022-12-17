<?php
include "Database.php";
session_start();
$title = $_POST['title'];
$user = $_SESSION['user'];
$user_id = mysqli_fetch_array(Database::getConnection()->query("SELECT * FROM user WHERE login='$user'"))[0];
Database::getConnection()->query("INSERT INTO topic (title, user_id) VALUES ('$title', '$user_id')");
$topic_id = mysqli_fetch_array(Database::getConnection()->query("SELECT * FROM topic ORDER BY id DESC LIMIT 1"))[0];
Database::getConnection()->close();
header('Location: topic_view.php?id=' . $topic_id);