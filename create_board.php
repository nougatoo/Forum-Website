<?php
    require_once 'navbar.php';
?>
<html>
<body>
<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (isset($_SESSION['username']) && isset($_SESSION['fid']) && isset($_POST['board_title']) && isset($_POST['board_desc'])){
    $username = $_SESSION['username'];
    $fid = $_SESSION['fid'];
    $_SESSION['fid'] = null;
    $b_title = $_POST['board_title'];
    $b_desc = $_POST['board_desc'];

    $query =  "INSERT INTO `board` (username,forumid,title,description,notopic)"
        . "VALUES ('$username', $fid, '$b_title', '$b_desc', 0)";

    $result = mysqli_query($db, $query);
    if($result){
        header("refresh:5; url=index.php");
        echo 'Board successfully created!<br>';
    } else {
        print("<br> Board was not successfully created!");
    }
}
header("refresh:1; url=index.php");
?>
</body>
Redirecting you to the home page...
</html>