<?php
include "Database.php";
session_start();
$title = $_POST['title'];
$user = $_SESSION['user'];
$user_id = mysqli_fetch_array(Database::getConnection()->query("SELECT * FROM user WHERE login='$user'"))[0];
Database::getConnection()->query("INSERT INTO topic (title, user_id) VALUES ('$title', '$user_id')");
Database::getConnection()->close();
header('Location: index4.php');