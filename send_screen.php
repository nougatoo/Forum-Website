<html>
    <body>
        <a href="inbox.php">Go Back to Inbox</a>
        <br>
        <br>
        
        <?php 
            require_once 'functions.php';
           
            if(isset($_POST['reply_id']))
            {
                
                $reply_id = $_POST['reply_id'];
                
                /**We want to get the user name from the post id so that
                 * the user doesn't have to type it in 
                 */
                $query = "SELECT sentbyuser, id FROM privatemessage WHERE id='$reply_id'";
                $result = mysqli_query($db, $query);
    
                $row = $result->fetch_assoc();
                
                $reply_user = $row['sentbyuser'];
                
        ?>

        
        <form action="send.php" method="post">
            Subject: <input type="text" name="subject">
            <br>
            <input type="text" name="pm_content">
            <input type="hidden" value="<?php echo $reply_id ?>" name="reply_id">
            <input type="hidden" value="<?php echo $reply_user ?>" name="send_to">
            <br>
        <input type="submit" value="Send Message">
        
        <?php
        
            }
            
            else
            {
        ?>
        
            <form action="send.php" method="post">
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
