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
<a href="index4.php">Powrót do forum</a>
<br>
<?php
$user_id = $_GET['id'];
echo '<a href="alert_form.php?id=' . $user_id . '">Wyślij komunikat do użytkownika</a>';
?>
<br>
<br>
<br>
Tematy użytkownika:
<?php
include "Database.php";
$topics = mysqli_fetch_all(Database::getConnection()->query("SELECT * FROM topic WHERE user_id='$user_id'"));
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
    echo '<td><a href="user_view.php?id=' . $topic[2] . '">' . mysqli_fetch_array(Database::getConnection()->query("SELECT * FROM user WHERE id='$topic[2]'"))[1] . '</a></td>';
    echo '</tr>';
}

echo '</tbody>';
echo '</table>';

?>
<br>
<br>
Posty użytkownika:
<?php
$threads = mysqli_fetch_all(Database::getConnection()->query("SELECT * FROM post WHERE user_id='$user_id' ORDER BY datetime asc"));
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
    echo '<td>Autor postu: ' . mysqli_fetch_array(Database::getConnection()->query("SELECT * FROM user WHERE id='$thread[2]'"))[1] . '<br><br><br>';
    echo '</td>';
    if (strlen($thread[5]) > 0) {
        echo '<td>';
        echo $thread[1];
        echo '<br>';
        echo '<br>';
        $message = 'images/' . $thread[5];

        if (strpos($message, '.png')) {
            $message = "<img src='$message'>";
        } else if (strpos($message, '.gif')) {
            $message = "<img src='$message'>";
        } else if (strpos($message, '.jpg')) {
            $message = "<img src='$message'>";
        } else if (strpos($message, '.mp3')) {
            $message = "<audio controls src='$message'> </audio>";
        } else if (strpos($message, '.mp4')) {
            $message = "<video controls width='250' autoplay='true' muted='true'><source src='$message' type='video/mp4'></video>";
        }
        echo $message;

        echo '</td>';
    } else {
        echo '<td>' . $thread[1] . '</td>';
    }

    echo '</tr>';
}

echo '</tbody>';
echo '</table>';
?>
</BODY>
</html>