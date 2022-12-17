<?php
include "Database.php";
$topic_id = $_GET['id'];
$threads = mysqli_fetch_all(Database::getConnection()->query("SELECT * FROM thread WHERE topic_id='$topic_id'"));

foreach ($threads as $thread) {
    // Usuń posty z wątków w tym temacie
    Database::getConnection()->query("DELETE FROM post WHERE thread_id='$thread[0]'");

    // Usuń wątki w tym temacie
    Database::getConnection()->query("DELETE FROM thread WHERE id='$thread[0]'");
}

// Usuń temat
Database::getConnection()->query("DELETE FROM topic WHERE id='$topic_id'");

Database::getConnection()->close();
header('Location: index4.php');