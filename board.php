<?php
    require_once 'navbar.php';
?>
    <head>
        <title>Board</title>
    </head>
    <body>
<?php
    if(isset($_GET["boardid"])){
        $_SESSION['bid'] = $_GET['boardid'];
        $username = $_SESSION['username'];
        $bid = $_SESSION['bid'];

        //If an admins stickied something
        if(isset($_GET['sticky'])){
            if($_GET['sticky'] == 1){
                $tid_s = $_GET['tid'];
                $query = "UPDATE `topic` SET sticky=1 WHERE id='$tid_s'";
                $result = mysqli_query($db, $query);
                unset($_GET['sticky']);
            }else if($_GET['sticky'] == 0){
                $tid_s = $_GET['tid'];
                $query = "UPDATE `topic` SET sticky=0 WHERE id='$tid_s'";
                $result = mysqli_query($db, $query);
                unset($_GET['sticky']);
            }
        }
    }else{
        header("Location: index.php");
    }

    print("This Board's ID# is: " . $bid . "<br>");

    //Now we need to retrieve the board title and description from the DB as a test
    $query = "SELECT title, description FROM board WHERE id=$bid";
    $result = mysqli_query($db, $query);
    while ($row = $result->fetch_assoc()){
        print("This Board is Called: " . $row["title"] . "<br>");
        print("This Board Contains: " . $row["description"] . "<br>");
    }

    if ($_SESSION['username'] != "Guest"){
?>
    <br>
    <br>
    <form action = "create_topic_screen.php" method = "get">
        <input type="hidden" value="<?php echo $bid ?>" name ="bid">
        <input type="submit" value="Create Topic" />
    </form>

<?php
    }

    $query2 = "SELECT rank FROM user WHERE username='$username'";
    $result2 = mysqli_query($db, $query2);
    $row2 = $result2->fetch_assoc();

    //Going to get all the topics that belong to this board
    $query = "SELECT id, title, noreply, datecreated, views, sticky, hidden, boardid, username FROM topic WHERE boardid=$bid";
    $result = mysqli_query($db, $query);
    $stickied = array();
    $regular = array();

    while($row = $result->fetch_assoc()){
        if($row["sticky"] == 1 && $row["hidden"] == 0){
            array_push($stickied, $row);
        }else if($row["sticky"] == 0){
            array_push($regular, $row);
        }
    }
?>
        <table cellpadding="2" cellspacing="2" align="center">
            <tr>
                <th>Title</th>
                <th>Author</th>
                <th>Date Created</th>
                <th>Replies</th>
            </tr>
            <tr>
                <th class="topicTypeHeader" colspan="20">Stickied Topics</th>
            </tr>

<?php
        while(count($stickied) > 0){
            $row = array_pop($stickied);
            $title = $row["title"];
            $id = $row["id"];
            $replies = $row["noreply"];
            $author = $row["username"];
            $date = $row["datecreated"];
            $views = $row["views"];
            $boardid = $row["boardid"];
?>

            <tr>
                <td><a href="topic.php?tid=<?php echo $id?>"><?php echo $title?></a></td>
                <td><?php echo $author?></td>
                <td><?php echo $date?></td>
                <td><?php echo $replies?></td>
<?php
                if($row2["rank"] == 0){
?>
                <td>
                    <form action="board.php" method="get">
                        <input type="hidden" value="<?php echo $row['id']?>" name="tid">
                        <input type="hidden" value="<?php echo $bid ?>" name="boardid">
                        <input type="hidden" value="<?php echo "0" ?>" name="sticky">
                        <input type="submit" value="UnSticky"/>
                    </form>
                </td>
<?php
                }
?>
            </tr>

<?php
        }
?>
            <tr>
                <th class="topicTypeHeader" colspan="20">Regular Topics</th>
            </tr>

<?php
        while(count($regular) > 0){
            $row = array_pop($regular);
            $title = $row["title"];
            $id = $row["id"];
            $replies = $row["noreply"];
            $author = $row["username"];
            $date = $row["datecreated"];
            $views = $row["views"];
            $boardid = $row["boardid"];
?>

            <tr>
                <td><a href="topic.php?tid=<?php echo $id?>"><?php echo $title?></a></td>
                <td><?php echo $author?></td>
                <td><?php echo $date?></td>
                <td><?php echo $replies?></td>
<?php
                if($row2["rank"] == 0){
?>
                    <td>
                        <form action="board.php" method="get">
                            <input type="hidden" value="<?php echo $row['id']?>" name="tid">
                            <input type="hidden" value="<?php echo $bid ?>" name="boardid">
                            <input type="hidden" value="<?php echo "1" ?>" name="sticky">
                            <input type="submit" value="Sticky"/>
                        </form>
                    </td>
<?php
                }
?>
            </tr>

<?php
        }
?>
        </table>
    </body>
</html>