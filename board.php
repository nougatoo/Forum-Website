<?php
    require_once 'functions.php';
?>
<html>
<body>
<?php
$_SESSION['bid'] = $_POST['goto_board'];
?>
<br>
<?php
print("This Board's ID# is: ");
print($_SESSION['bid']);
$bid = $_SESSION['bid'];

//Going to get all the topics that belong to this board
$query = "SELECT id, title, noreply, datecreated, views, sticky, hidden, boardid, username FROM topic WHERE boardid=$bid";
$result = mysqli_query($db, $query);

echo "<br>"."<br>"."Stickied Topics"."<br>"."<br>";


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
            <input type="submit" value="See Topic" />
        </form>

        <?php
        echo "<br>"."<br>";
    }
}

//This will show the rest of the topics that aren't stickied
$result = mysqli_query($db, $query);
while($row = $result->fetch_assoc()){
    
    if($row['hidden'] != 1)
    {
        echo "".($row['title'])."<br>";
        echo "Number of replies: ".($row['noreply'])."<br>";
        echo "Date Created: ".($row['datecreated'])."<br>";
        echo "Created by: ".($row['username'])."<br>";
        
        ?>

        <form action = "topic.php" method = "post">
            <input type="hidden" value="<?php echo $row['id']?>" name="tid">
            <input type="submit" value="See Topic" />
        </form>

        <?php
        echo "<br>"."<br>";
    } 
}



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