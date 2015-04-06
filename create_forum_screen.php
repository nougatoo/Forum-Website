<?php

    $username = $_POST['user'];
    echo "Logged in as: ".$username;

?>

    <br>    
    <form action = "create_forum.php" method = "post">
        Title: <input type="text" name="title"><br>
        Description: <input type="text" name="description"><br>
        <input type="hidden" value="<?php echo $username ?>" name="user">
        <input type="submit" value="Create" />
    </form>