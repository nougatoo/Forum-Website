<?php
    require_once 'navbar.php';
?>

    <body>
<?php
$_SESSION['bid'] = $_POST['goto_board'];
?>
<br>
<?php
print("This Board's ID# is: ");
print($_SESSION['bid']);
$bid = $_SESSION['bid'];
$username = $_POST['user'];

//If an admins stickied something
if( isset($_POST['sticky']))
{
    if($_POST['sticky'] == 1)
    {
        $tid_s = $_POST['tid'];
        $query = "UPDATE `topic` SET sticky=1 WHERE id='$tid_s'";
        $result = mysqli_query($db, $query); 
        $_POST['sticky'] = 0;
    }
    if($_POST['sticky'] == 2)
    {
        $tid_s = $_POST['tid'];
        $query = "UPDATE `topic` SET sticky=0 WHERE id='$tid_s'";
        $result = mysqli_query($db, $query); 
        $_POST['sticky'] = 0;
    }
}

if ($_SESSION['username'] != "Guest"){

?>
<br>
<br>
<form action = "create_topic_screen.php" method = "post">
    <input type="hidden" value="<?php echo $bid ?>" name ="bid">
    <input type="hidden" value="<?php echo $username ?>" name="user">
    <input type="submit" value="Create Topic" />
</form>

<?php


}
//Going to get all the topics that belong to this board
$query = "SELECT id, title, noreply, datecreated, views, sticky, hidden, boardid, username FROM topic WHERE boardid=$bid";
$result = mysqli_query($db, $query);

echo "<br>"."<br>"."Stickied Topics"."<br>";


echo "<hr>";



//This will show all the sticked topics first
while($row = $result->fetch_assoc()){
    
    if($row['sticky'] == 1 && $row['hidden'] != 1)
    {
        echo "".($row['title'])."<br>";
        echo "Number of replies: ".($row['noreply'])."<br>";
        echo "Date Created: ".($row['datecreated'])."<br>";
        echo "Created by: ".($row['username'])."<br>";
        ?>

        <form action = "topic.php" method = "post">
            <input type="hidden" value="<?php echo $row['id']?>" name="tid">
            <input type="hidden" value="<?php echo $username ?>" name="user">
            <input type="submit" value="See Topic" />
        </form>

        <?php
        
        $query2 = "SELECT rank FROM user WHERE username='$username'";
        $result2 = mysqli_query($db, $query2);
        $row2 = $result2->fetch_assoc();
        
        
        if($row2['rank'] == 0)
        {
            ?>
            <form action = "board.php" method = "post">
                <input type="hidden" value="<?php echo $row['id']?>" name="tid">
                <input type="hidden" value="<?php echo $bid ?>" name="goto_board">
                <input type="hidden" value="<?php echo $username ?>" name="user">
                <input type="hidden" value="<?php echo "2" ?>" name="sticky">
                <input type="submit" value="Unsticky" />
            </form>

            <?php
        }
        
        echo "<br>"."<br>";
    }
}

echo "<hr>";
echo "<br>"."Regular Topics"."<br>";
echo "<hr>";

//This will show the rest of the topics that aren't stickied
$result = mysqli_query($db, $query);
while($row = $result->fetch_assoc()){
    
    if($row['hidden'] != 1 && $row['sticky'] == 0)
    {
        echo "".($row['title'])."<br>";
        echo "Number of replies: ".($row['noreply'])."<br>";
        echo "Date Created: ".($row['datecreated'])."<br>";
        echo "Created by: ".($row['username'])."<br>";
        
        ?>

        <form action = "topic.php" method = "post">
            <input type="hidden" value="<?php echo $row['id']?>" name="tid">
            <input type="hidden" value="<?php echo $username ?>" name="user">
            <input type="submit" value="See Topic" />
        </form>

        <?php
        
        $query2 = "SELECT rank FROM user WHERE username='$username'";
        $result2 = mysqli_query($db, $query2);
        $row2 = $result2->fetch_assoc();
        
        if($row2['rank'] == 0)
        {
            ?>
            <form action = "board.php" method = "post">
                <input type="hidden" value="<?php echo $row['id']?>" name="tid">
                <input type="hidden" value="<?php echo $bid ?>" name="goto_board">
                <input type="hidden" value="<?php echo $username ?>" name="user">
                <input type="hidden" value="<?php echo "1" ?>" name="sticky">
                <input type="submit" value="Sticky" />
            </form>

            <?php
        }
        
        
        echo "<br>";
    } 
}

echo "<hr>";


//Now we need to retrieve the board title and description from the DB as a test
$query = "SELECT title, description FROM board WHERE id=$bid";
$result = mysqli_query($db, $query);


while ($row = $result->fetch_assoc()){
    ?>
    <br>
    <?php
    print("This Board is Called: ");
    print($row["title"]);
    ?>
    <br>
    <?php
    print("This Board Contains: ");
    print($row["description"]);
}
?>
<br>
<br>
<a href="index.php">Go Back</a>
</body>
</html>