<?php

    //Connecting to DB
    $db = new mysqli('zeeveener.com', 'collier', 'rox', 'collier');
        
    if ($db->connect_errno > 0)
    {
        die('Unable to connect to database [' . $db->connect_error . ']');
    }
    else
    {
        print('Database Connected');
    }

    
    if (isset($_POST['username_r']) && isset($_POST['password_r']) && isset($_POST['signature']) 
            && isset($_POST['email']) && isset($_POST['title']) && isset($_POST['gender'])) {
        
        $username = $_POST['username_r'];
        $password = $_POST['password_r'];
        $signature = $_POST['signature'];
        $email = $_POST['email'];
        $title = $_POST['title'];
        $gender = $_POST['gender'];
        $rank = 1;
        
        print($username);
        //Only put in one check for the sake of time, will add more after
        if (!empty($username)) {
            $query = "INSERT INTO `user` (username,signature,email,gender,title,password,rank) VALUES ('$username', '$signature', '$email', '$gender', '$title', '$password', $rank)";
            $result = mysqli_query($db, $query);
            if($result)
            {
                header("Location: login.php");
            }
            else
            {
                print("<br> Registration was not successful, please go back and try again");
            }
        }
        
        

    }
    else
    {
        print("<br>im not working");
    }

?>
<br>
<br>
<a href="index.php">Go Back</a>