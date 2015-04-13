<?php
    require_once 'functions.php';
    
    if (isset($_POST['username_r']) && isset($_POST['password_r']) && isset($_POST['signature']) && isset($_POST['email']) && isset($_POST['title']) && isset($_POST['gender']) && isset($_POST['age']))
    {
        $username = $_POST['username_r'];
        $password = $_POST['password_r'];
        $signature = $_POST['signature'];
        $email = $_POST['email'];
        $title = $_POST['title'];
        $gender = $_POST['gender'];
        $age = $_POST['age'];
        $date = date("Y-m-d");
        $rank = 1;

        if (!empty($username)) {
            $query = "INSERT INTO `user` (username,signature,email,gender,title,password,datejoined,rank) "
                    . "VALUES ('$username', '$signature', '$email', '$gender', '$title', '$password', '$date', $rank)";
            $result = mysqli_query($db, $query);
            $query2 = "INSERT INTO `profile_page` (user,status,num_posts,biography) "
                . "VALUES ('$username', 0, 0, 'My Bio')";
            $result2 = mysqli_query($db, $query2);
            if($result) {
                $_SESSION["reg_success"] = true;
                $_SESSION["username"] = $username;
                header("Location: index.php");
            } else {
                $_SESSION["reg_success"] = false;
                header("Location: reg_screen.php");
            }
        }
    }
?>