<?php
    require_once 'navbar.php';
?>

<html>
    <body>
        <?php
            
            
            $username = $_SESSION['username'];
            $pm_content = $_POST['pm_content'];
            $send_to = $_POST['send_to'];
            $subject = $_POST['subject'];
            $date = date('Y-m-d H:i:s'); //pretty sure the time zone is messed up....can fix later

            //If the user wants to reply to someone's message
            if( isset($_POST['reply_id']))
            {
                $reply_id = $_POST['reply_id'];
                               
                //Query to insert message into database
                $query = "INSERT INTO `privatemessage` (subject, content, sentbyuser, receivedbyuser, inreplytopmid, datecreated)"
                        . " VALUES ('$subject', '$pm_content', '$username', '$send_to', '$reply_id', '$date')";
                $result = mysqli_query($db, $query);

                $_POST['reply_id'] = NULL;
                if($result)
                {
                    echo "We have successfully sent your reply"."<br>";
                    echo "Redirecting you back to inbox now";
                    header("refresh:2; url=inbox.php");  
                }
                else
                {
                    
                    echo "We could not successfully send your reply, please try again"."<br>";
                    echo "Redirecting you back to inbox";
                    header("refresh:2; url=inbox.php");
                }
            }
            
            //If the user does not want to reply to someone's message
            else
            {
                
                /* Once there is not longer a not null constraint on inreplytopmid
                 * we can take out the inreplytopmid in this query
                 */
                $reply_id = 2;
                
                $query = "INSERT INTO `privatemessage` (subject, content, sentbyuser, receivedbyuser, inreplytopmid, datecreated)"
                        . " VALUES ('$subject', '$pm_content', '$username', '$send_to', '$reply_id', '$date')";
                $result = mysqli_query($db, $query);
                
                if($result)
                {
                    echo "We have successfully sent your message"."<br>";
                    echo "Redirecting you back to inbox now";
                    header("refresh:2; url=inbox.php");  
                }
                else
                {
                    echo "We could not successfully send your message, please try again"."<br>";
                    echo "Redirecting you back to inbox";
                    header("refresh:2; url=inbox.php");  
                }
                
            }
            
            

        ?>
    </body>
</html>

