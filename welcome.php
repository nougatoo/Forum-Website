<?php
    require_once 'functions.php';
    //Storing what the user input
    $username = $_GET['username'];
    $password = $_GET['password'];

    $query = "SELECT * FROM user WHERE username='$username' and password='$password'";
    $result = mysqli_query($db, $query) or die(mysqli_error);
    $count = mysqli_num_rows($result);

    $query2 = "INSERT INTO profile_page(user, status, num_posts, biography) VALUES('$username', TRUE, 0, '') ON DUPLICATE KEY UPDATE status=TRUE";
    $result2 = mysqli_query($db, $query2);

    if ($count == 1){
        $_SESSION['username'] = $username;
        header("Location: index.php");
    }else {
        $_SESSION["notification"] = "Unable to login using those credentials";
        header("Location: index.php");
    }
?>