<?php
    require_once 'navbar.php';

    $username = $_GET['user'];
    echo "Logged in as: ".$username;

?>
<head>
    <title>Create Forum</title>
</head>
    <br>    
    <form action = "create_forum.php" method = "get">
        Title: <input type="text" name="title"><br>
        Description: <input type="text" name="description"><br>
        <input type="hidden" value="<?php echo $username ?>" name="user">
        <input type="submit" value="Create" />
    </form>