<?php
    require_once 'navbar.php';
?>

<html>
    <head>
        <title>Create Post</title>
    </head>
    <body>
        <?php            
            //Buncha stuff we need
            $reply_id = $_GET['reply_to'];
            $post_content = $_GET['post_content'];
            $tid = $_GET['tid'];
            $user = $_SESSION['username'];
            $date = date("Y-m-d");
            
            //Testing code, can be taken out after
            echo $user;
            echo "<br>".$tid;
            echo "<br>".$post_content;
            echo "<br>".$reply_id;
            
            //Two seperate SQL statements, on if the post was replying to 
            //something, and another if they weren't
            if($reply_id == NULL)
            {
                $query = "INSERT INTO `post` (content, username, topicid, datecreated) VALUES ('$post_content', '$user', '$tid', '$date')";
                $result = mysqli_query($db, $query);                
            }
            else{
                
                $query = "INSERT INTO `post` (content, postid, username, topicid, datecreated) VALUES ('$post_content', '$reply_id', '$user', '$tid', '$date')";
                $result = mysqli_query($db, $query);                
            }
            
            //Gets the current number of replies and adds 1, updates DB
            $query = "SELECT noreply FROM topic WHERE id='$tid'";
            $result = mysqli_query($db, $query);
            $row = $result->fetch_assoc();
            $num_reply = $row['noreply'];
            
            $num_reply = $num_reply+1;
            
            $query = "UPDATE `topic` SET noreply='$num_reply' WHERE id='$tid'";
            $result = mysqli_query($db, $query); 
        
        
        ?>
        
        
        <form action="topic.php" method="get">
            <input type="hidden" value="<?php echo $tid ?>" name="tid">
        <input type="submit" value="Click Here To See Your Post">
    </body>
</html>
