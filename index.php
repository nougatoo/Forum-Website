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

        <form action = "create_forum_screen.php" method = "post">
            <input type="hidden" value="<?php print($user)?>" name="user">
            <input type="submit" value="Create Forum" />
        </form>

<?php
            }

            $create_board = $value['create_board'] == 1;
        }
        /*
        * TODO: Display Forums for Regular Users
        * We may not even need this else statement, because Admins should be able to see the rest of the Forums too.
        */

        /*
         * SELECT title, id
         * FROM forum
         * WHERE id IN
         * (
         *  FROM board AS b
         *  JOIN board_permission
         *  ON b.id=boardid
         *  WHERE seeboard=1 AND rankid IN
         *  (
         *     SELECT rank
         *     FROM user
         *     WHERE username='hue'
         *  )
         * );
         * ^Get all the forumid associated with the rank you have
         * Needto query for rank too.
         */

        $query = "SELECT title, id FROM forum"
            . " WHERE id IN (SELECT forumid FROM board AS b"
            . " JOIN board_permission"
            . " ON b.id=boardid"
            . " WHERE seeboard=1"
            . " AND rankid IN (SELECT rank FROM user WHERE username='$user'));";
        $result = mysqli_query($db, $query);


        //Shows all the forums and the boards that go with
        while($row = $result->fetch_assoc()){
            $fid = $row["id"];
?>
            <br>
            <span>
                <h2 style="display: inline"><?php print($row["title"])?>:</h2>

<?php
            if ($create_board == true){
?>
                <form action = "create_board_screen.php" method = "post">
                    <button type="submit" name="add_board" value="'.$fid.'"> Add Board</button>
                </form>
            </span>
<?php
            }

            $fid = $row["id"];

            $query2 = "SELECT title, description,id FROM board WHERE forumid=$fid";
            $result2 = mysqli_query($db, $query2);

            while($row2 = $result2->fetch_assoc()){
                $bid = $row2["id"];

                //echo "<br>".$row2["title"].": ";
                //echo $row2["description"]. " ";
                
?>
                <form action = "board.php" method = "post">
                    <h3 style="display: inline"><?php echo $row2["title"] . ": "?></h3><?php echo $row2["description"]?>
                    <input type="hidden" value="<?php echo $user?>" name="user">
                    <button type="submit" name="goto_board" value="<?php echo $bid?>">Go Here</button>
                </form>
<?php
            }
        }
    }
?>
<!-- Need to join the user with rank, and then check for create_forum
select create_forum
 FROM rank
 INNER JOIN user
 ON user.rank=rank.id
 WHERE username='collier';

 UPDATE board
 SET notopic=(SELECT COUNT(*) FROM topic WHERE id=boardid)
 WHERE id=1;
 ^This will update the number of topics inside a board.

-->

    </body>
</html>