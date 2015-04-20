<?php
    require_once 'navbar.php';
    $create_board = false;

    if(!isset($_SESSION["username"])){
        $_SESSION["username"] = "Guest";
    }
?>

<html>
    <head>
        <title>Collier Forum</title>
    </head>
    <body>
<?php
    if (isset($_SESSION['username'])){
        $user = $_SESSION['username'];
        $query = "SELECT create_forum, create_board FROM rank JOIN user ON user.rank=rank.id WHERE username='$user'";
        $perm_result = mysqli_query($db, $query);
        if ($perm_result->num_rows>0){
            $value = $perm_result->fetch_assoc();
            if ($value['create_forum']==1){
?>

        <form action = "create_forum_screen.php" method = "get">
            <input type="submit" value="Create Forum" />
        </form>

<?php
            }

            $create_board = $value['create_board'] == 1;
        }

        $query = "SELECT title, id FROM forum"
            . " WHERE id IN (SELECT forumid FROM board AS b"
            . " JOIN board_permission"
            . " ON b.id=boardid"
            . " WHERE seeboard=1"
            . " AND rankid IN (SELECT rank FROM user WHERE username='$user'));";
        $result = mysqli_query($db, $query);

        while($row = $result->fetch_assoc()){
            $fid = $row["id"];
?>
            <br>
            <span>
                <h2><?php print($row["title"])?>:</h2>

<?php
            if ($create_board == true){
?>
                <form action = "create_board_screen.php" method = "get">
                    <button type="submit" name="add_board" value="<?php echo $fid?>"> Add Board</button>
                </form>
<?php
            }
?>
            </span>
<?php

            $fid = $row["id"];

            $query2 = "SELECT title, description,id FROM board WHERE forumid=$fid";
            $result2 = mysqli_query($db, $query2);

            while($row2 = $result2->fetch_assoc()){
                $bid = $row2["id"];
?>
                <form action = "board.php" method = "get">
                    <h3><?php echo $row2["title"] . ": "?></h3><?php echo $row2["description"]?>
                    <button type="submit" name="boardid" value="<?php echo $bid?>">Go Here</button>
                </form>
<?php
            }
        }
    }
?>
    </body>
</html>