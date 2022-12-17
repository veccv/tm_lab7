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
<br>
<form action="admin_action.php" method="post" enctype="multipart/form-data">
    <label for="id">Wybierz użytkownika: </label>
    <select id="id" name="id">
        <?php
        include "Database.php";
        $users = mysqli_fetch_all(Database::getConnection()->query("SELECT * FROM user WHERE login NOT LIKE 'admin'"));
        foreach ($users as $user) {
            echo '<option value="' . $user[0] . '">' . $user[1] . '</option>';
        }
        ?>
    </select>
    <label for="action">Wybierz akcje: </label>
    <select id="action" name="action">
        <option value="block_user">Zablokuj użytkownika</option>
        <option value="remove_user">Usuń użytkownika</option>
        <option value="remove_all_users_posts">Usuń wszystkie posty użytkownika</option>
    </select>
    <br><br>
    <input type="submit" value="Wykonaj akcję" name="submit">
</form>



</BODY>
</html>