<?php 
    require_once 'navbar.php';
?>

<html>
    <head>
        <title>Create Topic</title>
    </head>
    <body>
        
        
        <?php
        
        $username = $_SESSION["username"];
        $bid = $_GET['bid'];
        $date = date("Y-m-d");
        
        ?>
        
        <form action="create_topic.php" method="get">
            Title: <input type="text" name="topic_title">
            <input type="hidden" value ="<?php echo $bid ?>" name="bid">
            <input type="hidden" value ="<?php echo $date ?>" name="date">     

        <input type="submit" value="Create Topic">
        
    </body>
</html>



