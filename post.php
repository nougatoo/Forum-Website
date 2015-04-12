<?php
    require_once 'functions.php';
?>

<html>
    <body>
        <?php            
            //Buncha stuff we need
            $reply_id = $_POST['reply_to'];
            $post_content = $_POST['post_content'];
            $tid = $_POST['tid'];
            $user = $_POST['user'];
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
        
        
        <form action="topic.php" method="post">
            <input type="hidden" value="<?php echo $tid ?>" name="tid">
            <input type="hidden" value="<?php echo $user ?>" name="user">
        <input type="submit" value="Click Here To See Your Post">
    </body>
</html>
