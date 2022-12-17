<?php
include "Database.php";
session_start();
$title = $_POST['title'];
$user = $_SESSION['user'];
$user_id = mysqli_fetch_array(Database::getConnection()->query("SELECT * FROM user WHERE login='$user'"))[0];
$topic_id = $_POST['topic_id'];

Database::getConnection()->query("INSERT INTO thread (title, user_id, topic_id) VALUES ('$title', '$user_id', '$topic_id')");
Database::getConnection()->close();
header('Location: topic_view.php?id=' . $topic_id);