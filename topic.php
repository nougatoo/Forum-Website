<?php
    require_once "navbar.php";
?>

<html>
    <body>


<?php

//$_SESSION['topicid'] = $_POST['tid'];
//$tid = $_SESSION['topicid'];
$tid = $_GET['tid'];
$user = $_SESSION['username'];

//echo "Topic id: ".$_SESSION['topicid'];



//Gets the current number of views and increases by 1
$query = "SELECT views FROM topic WHERE id='$tid'";
$result = mysqli_query($db, $query);
$row = $result->fetch_assoc();
$num_views = $row['views'];

$num_views = $num_views+1;

$query = "UPDATE `topic` SET views='$num_views' WHERE id='$tid'";
$result = mysqli_query($db, $query); 

echo "Topic id: ".$tid;


//This shows the OP and how many views this topic has
$query = "SELECT title,views FROM topic WHERE id=$tid";
$result = mysqli_query($db, $query);

$row = $result->fetch_assoc();
echo "<br>"."Topic Title: ".$row['title']."<br>"."<br>";
echo "<br>"."Number of views: ".$row['views']."<br>"."<br>";


//Gets the boardid that this topic belongs to so we can go back
$queryBack = "SELECT boardid FROM topic WHERE id='$tid'";
$resultBack = mysqli_query($db, $queryBack);
$board_id = $resultBack->fetch_assoc(); 

?>

<form action = "board.php" method = "get">
    <input type="hidden" value="<?php echo $board_id['boardid'] ?>" name="boardid">
    <input type="submit" value="Go Back" />
</form>

<?php


//Going to get all the topics that belong to this board
$query = "SELECT id, datecreated, datereply, content, postid, username, topicid FROM post WHERE topicid=$tid";
$result = mysqli_query($db, $query);

echo "<br>"."-------------------------------------------------------------";

//Shows all the posts in reply to a topic
while($row = $result->fetch_assoc()){
    
    echo "<br>";
    echo $row['content']."<br>"."<br>";
    echo "Posted by: ".$row['username']." on ".$row['datecreated']."<br>";
    echo "Post Number: ".$row['id'];
    
    if($row['postid'] > 0)
    {
        $postid = $row['postid'];
        $query2 = "SELECT content FROM post WHERE id=$postid";
        $result2 = mysqli_query($db, $query2);
        
        $row2 = $result2->fetch_assoc();
        
        
        echo "<br>"."In reply to: ".'"'.$row2['content'].'"';

    }
    echo "<br>"."-------------------------------------------------------------";
    
}

if($user != "Guest"){
?>


        <br>
        <br>
        <form action="post.php" method="get">
            Post number you're replying to (leave blank if none): <input type="text" name="reply_to"><br>
            <input type="hidden" value="<?php echo $tid ?>" name="tid">
            <textarea name="post_content" rows="10" cols="50" maxlength="500"></textarea> <br>
        <input type="submit" value="Reply">
        
        <br>
        <br>
        <br>
        
        
        <?php
        /**
         * Need to put a button here that lets the user go back to the board page
         * without breaking it, because the board needs things to be posted to work
         * 
         * Will up date later, just didn't have time -Brandon
         */
        ?>
    </body>
</html>


<?php

}

?>