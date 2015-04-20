<?php
    require_once 'navbar.php';
?>

<html>
    <head>
        <title>Received Messages</title>
    </head>
    <body>
        <?php
            $username = $_SESSION['username'];
            
            
            
            //Go back to inbox (Doesn't require any posting)
            echo "<a href='inbox.php'>Go Back to Inbox</a>";
            echo "<br>"."<br>";
            
            
            /**
             * I wanted to have a reply button by every message but i have 
             * having trouble getting to work because if i want the button to
             * post the message id as "in_reply_to" then "in_reply_to" gets changed
             * everytime a reply button is created, so no matter what reply butotn
             * they pressed it would always repsond to the lasted message that
             * was shown. I'm sure someone can figure it out :3
             * 
             * For now we have this clunky reply system 
             */
            
            ?>
            
                Please enter the ID of the message you would like to reply to
                <br>
                <form action="send_screen.php" method="post">
                    <input type="text" name="reply_id">
                <input type="submit" value="Reply">
                <br>
                <br>
            
        
            <?php
            
            
            
            //Query to get all messages received by current user
            $query = "SELECT * FROM privatemessage WHERE receivedbyuser='$username'";
            $result = mysqli_query($db, $query);
            
            while($row = $result->fetch_assoc())
            {
                echo "<br>";
                echo "Subject: ".$row['subject']."<br>";
                echo "Sent From: ".$row['sentbyuser']." on ".$row['datecreated']."<br>";
                echo "Their message: ".$row['content']."<br>";
                echo "Message ID: ".$row['id']."<br>";
                
                //If the message was replying to someone
                $reply_id = $row['inreplytopmid'];
                if($reply_id != NULL)
                {
                    //Query to get the message user was replying to
                    $query_2 = "SELECT content, id FROM privatemessage WHERE id='$reply_id'";
                    $in_reply_to = mysqli_query($db, $query_2);
                    
                    $row_2 = $in_reply_to->fetch_assoc();
                    echo 'In reply to: "'.$row_2['content'].'"<br>';
                }
                
                /**
                 * Code that was trying to use to try and get the reply button
                 * by every message
                 */
                /*
                ?>
        

                    <form action="send_screen.php" method="post">
                        <input type="hidden" value="<?php echo $row['id'] ?>" name="in_reply_to">
                    <input type="submit" value="Reply">
                
        
                <?php
                */
                echo "<br>";
                echo "<hr>";
                
                
                
            }
        ?>
    </body>
</html>


