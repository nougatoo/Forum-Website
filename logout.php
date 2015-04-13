<?php
    require_once 'functions.php';
    $query = "UPDATE `profile_page` SET status=0 WHERE user='$username'";
    $result = mysqli_query($db, $query);
    loguser();
    header("Location: index.php");
?>  
