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

if (strpos(strtolower($message), "cholera")) {
    $counter = mysqli_fetch_array(Database::getConnection()->query("SELECT * FROM user WHERE login='$user'"))[4];
    if ($counter == '0') {
        $date = date('m/d/Y h:i:s', time());
        $message = $date . ' Usunięto post użytkownika ' . $user . ', ze względu na użyty wulgaryzm. Jest to oficjalne ostrzeżenie dla użytkownika ' . $user . ', przy kolejnym użytym wulgaryzmie użytkownik ten zostanie zablokowany.';
        Database::getConnection()->query("UPDATE user SET counter='1' WHERE login='$user'");

    } else if ($counter == '1') {
        $date = date('m/d/Y h:i:s', time());
        $message = $date . ' Usunięto post użytkownika ' . $user . ', ze względu na użyty wulgaryzm. Użytkownik ' . $user . ' został zablokowany z powodu używania wulgaryzmów.';
        Database::getConnection()->query("UPDATE user SET counter='2' WHERE login='$user'");
        Database::getConnection()->query("UPDATE user SET role='blocked' WHERE login='$user'");
    }
    $file_name = '';
}

$file_name = basename($_FILES["fileToUpload"]["name"]);
Database::getConnection()->query("INSERT INTO post (message, user_id, thread_id, file) VALUES ('$message', '$user_id', '$thread_id', '$file_name')");

Database::getConnection()->close();
header('Location: thread_view.php?id=' . $thread_id);