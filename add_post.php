<!DOCTYPE html>
<html>
<body>
<form action="insert_post_to_db.php" method="post" enctype="multipart/form-data">
    <label for="message">Treść postu: </label>
    <input type="text" id="title" size="100" name="message"/>
    <?php
    $thread_id = $_GET['id'];
    echo "<input type='hidden' name='thread_id' value='$thread_id' />"
    ?>
    <br><br>
    <input type="submit" value="Dodaj post" name="submit">
</form>
<br>
<br>
<br>
<br>
</body>
</html>