<?php declare(strict_types=1);
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

$threads = mysqli_fetch_all(Database::getConnection()->query("SELECT * FROM post WHERE thread_id='$thread_id' ORDER BY datetime asc"));
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
    echo '<td>Autor postu: <a href="user_view.php?id=' . $thread[2] . '">' . mysqli_fetch_array(Database::getConnection()->query("SELECT * FROM user WHERE id='$thread[2]'"))[1] . '</a><br><br><br>';
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
</HTML>