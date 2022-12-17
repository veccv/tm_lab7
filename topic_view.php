<?php declare(strict_types=1);
session_start();

if (!isset($_SESSION['loggedin'])) {
    header('Location: index3.php');
    exit();
}

$user = $_SESSION['user'];

include 'Database.php';
if (!Database::getConnection()) {
    echo "Błąd: " . mysqli_connect_errno() . " " . mysqli_connect_error();
}
Database::getConnection()->query("SET NAMES 'utf8'");
?>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<BODY style="padding: 15px">
<a href="logout.php">Wyloguj się</a>
<br>
<a href="index.php">Powrót do menu głównego</a>
<br>
<br>
<br>
<br>
<?php
$topic_id = $_GET['id'];
$topic_name = mysqli_fetch_array(Database::getConnection()->query("SELECT * FROM topic WHERE id='$topic_id'"))[1];

echo "Stwórz nowy wątek " . '<a href="add_thread.php?id=' . $topic_id . '"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a><br>';
echo '<a href="index4.php">Powrót do strony głównej forum</a><br><br>';
echo "Wątki do tematu --> " . $topic_name . " <br><br>";

$threads = mysqli_fetch_all(Database::getConnection()->query("SELECT * FROM thread WHERE topic_id='$topic_id'"));
echo '<table class="table table-bordered table-striped">';
echo '<thead>';
echo '<tr>';
echo '<th>Opcje</th>';
echo '<th>Wątek</th>';
echo '<th>Autor</th>';
echo '</tr>';
echo '</thead>';
echo '<tbody>';
foreach ($threads as $thread) {
    echo '<tr>';
    echo '<td>';
    echo '<a href="remove_thread.php?id=' . $thread[0] . '&topic=' . $topic_id . '"><i class="glyphicon glyphicon-trash fa-6x"></i></a>';
    echo '</td>';

    echo '<td><a href="thread_view.php?id=' . $thread[0] . '">' . $thread[1] . '</a></td > ';
    echo '<td > ' . mysqli_fetch_array(Database::getConnection()->query("SELECT * FROM user WHERE id='$thread[2]'"))[1] . ' </td > ';
    echo '</tr > ';
}

echo '</tbody > ';
echo '</table > ';

?>
</BODY>
</HTML>