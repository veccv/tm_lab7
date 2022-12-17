<?php
include "Database.php";
$post_id = $_GET['id'];
$th_id = $_GET['th'];

// Usuń posty
Database::getConnection()->query("DELETE FROM post WHERE id='$post_id'");

Database::getConnection()->close();
header('Location: thread_view.php?id=' . $th_id);