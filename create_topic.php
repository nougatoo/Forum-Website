<?php
    require_once 'navbar.php';
?>

<html>
    <body>
        <?php
        $username = $_GET['user'];
        $bid = $_GET['bid'];
        $date = $_GET['date'];
        $title = $_GET['topic_title'];


        $query = "INSERT INTO `topic` (title, noreply, datecreated, views, sticky, hidden, boardid, username) VALUES ('$title', '0', '$date', '0', '0', '0', '$bid', '$username')";
        $result = mysqli_query($db, $query);

        if($result)
        {
            echo "Your Topic was successfully created";
        }
        else
        {
            echo "Something went wrong and your topic was not created";
        }


        ?>

        <br>
        <br>
        <form action="board.php" method="get">
            <input type="hidden" value="<?php echo $bid ?>" name="goto_board">
            <input type="hidden" value="<?php echo $username ?>" name="user">
        <input type="submit" value="Go Back To Board">
    </body>
</html>