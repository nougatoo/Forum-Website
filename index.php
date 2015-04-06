<?php
require 'functions.php';
initialize();
$create_board = false;
?>

<html>
<body>

<?php if (isset($_SESSION['username']) && !($_SESSION['username']=='Guest')) : ?>
    <br><a href='logout.php'>Log Out</a>
<?php else :
    $_SESSION['username'] = 'Guest';
    ?>
    Welcome to the Robert Collier Fan Forum.
    You are a Guest.
    <br><a href='login.php'>Login</a>
    <br><a href='reg_screen.php'>Register</a>
<?php endif;
?>


<p>==========ROBERT COLLIER FAN FORUM==========</p>

<?php
if (isset($_SESSION['username']))
{
    $user = $_SESSION['username'];
    $query = "SELECT create_forum, create_board FROM rank JOIN user ON user.rank=rank.id WHERE username='$user'";
    $perm_result = mysqli_query($db, $query);
    if ($perm_result->num_rows>0)
    {
        $value = $perm_result->fetch_assoc();
        if ($value['create_forum']==1){
            echo 'I am an Administrator! I have Rights to Create Forums!!<br>';



            /*
             * TODO: Display "Add Forum" Function.
             * Also display the Forum with the corresponding Boards underneath
             * We also need to implement the "Add Board" Function underneath every forum.
             * Possibly assign the Forum ID to be associated with the Add Board link?
             * Display a Forum Based of how many Board is Visible
             * If a Forum have at LEAST ONE VISIBLE BOARD for a user, then the Forum should be displayed
             * with the visible boards.
             * If a Forum does NOT have ANY VISIBLE BOARD for a user, then the Forum should NOT be displayed
             * Extra: Delete Forum
             */

            ?>

            <form action = "create_forum.php" method = "post">
                <input type="submit" value="Create Forum" />
            </form>

        <?php
        }

        if ($value['create_board']==1){
            echo 'I have permission to create boards!<br>';
            $create_board = true;
        }
    } else {
        echo "Fantastic, you aren't an Admin nub, no buttons for you";
    }
    echo "<br>$create_board";
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
        echo "<br>"."<br>";
        ?>
            
                    <span style="font-size: medium; "><b>
                        
                    <?php
        echo $row["title"]. ": ";
        $fid = $row["id"];
        ?>
                        
                    </span></b>
                    
                    <?php
        if ($create_board == true){
            echo '<form action = "create_board_screen.php" method = "post">
                                <button type="submit" name="add_board" value="'.$fid.'"> Add Board</button>
                            </form>';
        }
        ?>

        <?php

        $fid = $row["id"];

        $query2 = "SELECT title, description,id FROM board WHERE forumid=$fid";
        $result2 = mysqli_query($db, $query2);

        while($row2 = $result2->fetch_assoc()){

            echo "<br>".$row2["title"].": ";
            echo $row2["description"]. " ";
            $bid = $row2["id"];
            echo '<form action = "board.php" method = "post">
                <button type="submit" name="goto_board" value="'.$bid.'"> Go Here</button>
            </form>';

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