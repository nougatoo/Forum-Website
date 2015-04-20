<?php
    require_once 'navbar.php';
?>

<html>
    <head>
        <title>Send Message</title>
    </head>
    <body>
        <a href="inbox.php">Go Back to Inbox</a>
        <br>
        <br>
        
        <?php            
            if(isset($_GET['reply_id']))
            {
                
                $reply_id = $_GET['reply_id'];
                
                //Showing the message that the user is replying to
                $query = "SELECT content, id FROM privatemessage WHERE id='$reply_id'";
                $result = mysqli_query($db, $query);
                
                $row = $result->fetch_assoc();
                
                echo "You are replying to the message: ".'"'.$row['content'].'"';
                echo "<br>"."<br>";
                
                /**We want to get the user name from the post id so that
                 * the user doesn't have to type it in 
                 */
                $query = "SELECT sentbyuser, id FROM privatemessage WHERE id='$reply_id'";
                $result = mysqli_query($db, $query);
    
                $row = $result->fetch_assoc();
                
                $reply_user = $row['sentbyuser'];
                
        ?>

        
        <form action="send.php" method="get">
            Subject: <input type="text" name="subject">
            <br>
            <textarea name="pm_content" rows="10" cols="50" maxlength="500"></textarea>
            <input type="hidden" value="<?php echo $reply_id ?>" name="reply_id">
            <input type="hidden" value="<?php echo $reply_user ?>" name="send_to">
            <br>
        <input type="submit" value="Send Message">
        
        <?php
        
            }
            
            else
            {
        ?>
        
            <form action="send.php" method="get">
                To:<input type="text" name="send_to">
                <br>
                Subject: <input type="text" name="subject">
                <br>
                <textarea name="pm_content" rows="10" cols="50" maxlength="500"></textarea>
                <br>
            <input type="submit" value="Send Message">
            
            <?php
                }
            ?>
    </body>
</html>
