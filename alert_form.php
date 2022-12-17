<!DOCTYPE html>
<html>
<body>
<form action="send_alert.php" method="post" enctype="multipart/form-data">
    <label for="alert">Wprowadź komunikat: </label>
    <input id="alert" name="alert" type="text" size="100"/>
    <?php
    $user_id = $_GET['id'];
    echo "<input type='hidden' name='user_id' value='$user_id' />"
    ?>
    <br><br>
    <input type="submit" value="Wyślij komunikat" name="submit">
</form>
<br>
<br>
<br>
<br>
</body>
</html>