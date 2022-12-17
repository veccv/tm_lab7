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
echo "Stwórz nowy temat " . '<a href="add_topic.php"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a><br><br>';
echo "Tematy forum: <br><br>";

$topics = mysqli_fetch_all(Database::getConnection()->query("SELECT * FROM topic"));
echo '<table class="table table-bordered table-striped">';
echo '<thead>';
echo '<tr>';
echo '<th>Opcje</th>';
echo '<th>Temat</th>';
echo '<th>Autor</th>';
echo '</tr>';
echo '</thead>';
echo '<tbody>';
foreach ($topics as $topic) {
    echo '<tr>';
    echo '<td>';
    echo '<a href="remove_topic.php?id=' . $topic[0] . '"><i class="glyphicon glyphicon-trash fa-6x"></i></a>';
    echo '</td>';
    echo '<td><a href="topic_view.php?id= ' . $topic[0] . '"> ' . $topic[1] . '</a></td>';
    echo '<td>' . mysqli_fetch_array(Database::getConnection()->query("SELECT * FROM user WHERE id='$topic[2]'"))[1] . '</td>';
    echo '</tr>';
}

echo '</tbody>';
echo '</table>';

?>
</BODY>
</HTML>