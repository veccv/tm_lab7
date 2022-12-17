<?php
include "Database.php";
session_start();
$user_id = $_POST['id'];
$action = $_POST['action'];

if ($action == 'block_user') {
    Database::getConnection()->query("UPDATE user SET role='blocked' WHERE id='$user_id'");

} else if ($action == 'remove_user') {
    // Usuń posty użytkownika
    Database::getConnection()->query("DELETE FROM post WHERE user_id='$user_id'");

    // Usuń wątki użytkownika
    Database::getConnection()->query("DELETE FROM thread WHERE user_id='$user_id'");

    // Usuń tematy użytkownika
    Database::getConnection()->query("DELETE FROM topic WHERE user_id='$user_id'");

    // Usuń użytkownika
    Database::getConnection()->query("DELETE FROM user WHERE id='$user_id'");

} else if ($action == 'remove_all_users_posts') {
    Database::getConnection()->query("DELETE FROM post WHERE user_id='$user_id'");
}
Database::getConnection()->close();
header("Location: admin_panel.php");
