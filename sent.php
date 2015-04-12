<?php
    require_once "functions.php";
?>

<html>
    <body>
        <?php            
            $username = $_SESSION['username'];
            
            //Go back to inbox (Doesn't require any posting)
            echo "<a href='inbox.php'>Go Back to Inbox</a>";
            echo "<br>"."<br>";
            
            
            //Query to get all messages sent by current user
            $query = "SELECT * FROM privatemessage WHERE sentbyuser='$username'";
            $result = mysqli_query($db, $query);
            
            while($row = $result->fetch_assoc())
            {
                echo "Subject: ".$row['subject']."<br>";
                echo "Sent to: ".$row['receivedbyuser']." on ".$row['datecreated']."<br>";
                echo "Your Message: ".$row['content']."<br>";
                
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
                echo "<br>";
                echo "<hr>";
                
                
                
            }
        ?>
    </body>
</html>


