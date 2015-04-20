<?php
    require_once 'navbar.php';

    $username = $_SESSION['username'];
    echo "Logged in as: ".$username;

?>
<head>
    <title>Create Forum</title>
</head>
    <br>    
    <form action = "create_forum.php" method = "get">
        Title: <input type="text" name="title"><br>
        Description: <input type="text" name="description"><br>
        <input type="submit" value="Create" />
    </form>