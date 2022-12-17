<?php
include "Database.php";
$thread_id = $_GET['id'];
$topic_id = $_GET['topic'];

// Usuń posty
Database::getConnection()->query("DELETE FROM post WHERE thread_id='$thread_id'");

// Usuń wątek
Database::getConnection()->query("DELETE FROM thread WHERE id='$thread_id'");

Database::getConnection()->close();
header('Location: index4.php');