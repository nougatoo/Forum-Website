<?php
    require_once 'functions.php';
    //Storing what the user input
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM user WHERE username='$username' and password='$password'";
    $result = mysqli_query($db, $query) or die(mysqli_error);
    $count = mysqli_num_rows($result);

    $query2 = "UPDATE `profile_page` SET status=1 WHERE user='$username'";
    $result2 = mysqli_query($db, $query2);

    if ($count == 1){
        $_SESSION['username'] = $username;
        header("Location: index.php");
    } else {
        print("The information you entered was incorrect.");
        //Maybe have two buttons here that give user option to go back and register or continue as guest
    }
?>