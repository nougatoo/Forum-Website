<?php 
    require_once 'navbar.php';
?>

<html>
    <head>
        <title>Create Topic</title>
    </head>
    <body>
        
        
        <?php
        
        $username = $_POST['user'];        
        $bid = $_POST['bid'];
        $date = date("Y-m-d");
        
        ?>
        
        <form action="create_topic.php" method="post">
            Title: <input type="text" name="topic_title">
            <input type="hidden" value ="<?php echo $bid ?>" name="bid">
            <input type="hidden" value ="<?php echo $date ?>" name="date">     
            <input type="hidden" value ="<?php echo $username ?>" name="user">
                          
        <input type="submit" value="Create Topic">
        
    </body>
</html>



