<!DOCTYPE html>
<html>
<body>
<form action="insert_thread_to_db.php" method="post" enctype="multipart/form-data">
    <label for="title">Nazwa wątku: </label>
    <input id="title" name="title"/>
    <?php
    $topic_id = $_GET['id'];
    echo "<input type='hidden' name='topic_id' value='$topic_id' />"
    ?>
    <br><br>
    <input type="submit" value="Dodaj wątek" name="submit">
</form>
<br>
<br>
<br>
<br>
</body>
</html>