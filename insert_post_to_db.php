<?php
include "Database.php";
session_start();
$message = $_POST['message'];
$user = $_SESSION['user'];
$user_id = mysqli_fetch_array(Database::getConnection()->query("SELECT * FROM user WHERE login='$user'"))[0];
$thread_id = $_POST['thread_id'];

$target_dir = "images";
$target_file = $target_dir . "/" . basename($_FILES["fileToUpload"]["name"]);
if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    echo htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " uploaded.";
} else {
    echo "Error uploading file.";
}

$file_name = basename($_FILES["fileToUpload"]["name"]);
Database::getConnection()->query("INSERT INTO post (message, user_id, thread_id, file) VALUES ('$message', '$user_id', '$thread_id', '$file_name')");
Database::getConnection()->close();
header('Location: thread_view.php?id=' . $thread_id);