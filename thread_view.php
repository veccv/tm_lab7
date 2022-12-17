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
$thread_id = $_GET['id'];
$thread_name = mysqli_fetch_array(Database::getConnection()->query("SELECT * FROM thread WHERE id='$thread_id'"))[1];

echo '<a href="index4.php">Powrót do strony głównej forum</a><br><br>';
echo "Widok wątku --> " . $thread_name . " <br><br>";

$threads = mysqli_fetch_all(Database::getConnection()->query("SELECT * FROM post WHERE thread_id='$thread_id'"));
echo '<table class="table table-bordered table-striped">';
echo '<thead>';
echo '<tr>';
echo '<th>Informacje</th>';
echo '<th>Post</th>';
echo '</tr>';
echo '</thead>';
echo '<tbody>';
foreach ($threads as $thread) {
    echo '<tr>';
    echo '<td>Autor postu: ' . mysqli_fetch_array(Database::getConnection()->query("SELECT * FROM user WHERE id='$thread[2]'"))[1] . '</td>';
    echo '<td>' . $thread[1] . '</td>';
    echo '</tr>';
}
echo '<tr>';
echo '<td colspan="2"><a href="add_post.php?id=' . $thread_id . '">Dodaj post</a></td>';
echo '</tr>';

echo '</tbody>';
echo '</table>';

?>
</BODY>
</HTML>