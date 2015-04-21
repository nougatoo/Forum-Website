<?php
    require_once("functions.php");

    $username = $_SESSION['username'];
    $pm_content = $_GET['pm_content'];
    $send_to = $_GET['send_to'];
    $subject = $_GET['subject'];
    $date = date('Y-m-d H:i:s'); //pretty sure the time zone is messed up....can fix later

    //If the user wants to reply to someone's message
    if( isset($_GET['reply_id']))
    {
        $reply_id = $_GET['reply_id'];

        //Query to insert message into database
        $query = "INSERT INTO `privatemessage` (subject, content, sentbyuser, receivedbyuser, inreplytopmid, datecreated)"
                . " VALUES ('$subject', '$pm_content', '$username', '$send_to', '$reply_id', '$date')";
        $result = mysqli_query($db, $query);

        $_GET['reply_id'] = NULL;
        if($result)
        {
            $_SESSION["notification"] = "Message Successfully Sent!";
            header("Location: inbox.php");
        }
        else
        {
            $_SESSION["notification"] = "Message couldn't be sent...";
            header("Location: inbox.php");
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
            $_SESSION["notification"] = "Message Successfully Sent!";
            header("Location: inbox.php");
        }
        else
        {
            $_SESSION["notification"] = "Message couldn't be sent...";
            header("Location: inbox.php");
        }

    }
?>

