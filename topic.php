<?php
    require_once 'functions.php';


$_SESSION['topicid'] = $_POST['tid'];
$tid = $_SESSION['topicid'];


echo "Topic id: ".$_SESSION['topicid'];

//This shows the OP
$query = "SELECT title FROM topic WHERE id=$tid";
$result = mysqli_query($db, $query);

$row = $result->fetch_assoc();
echo "<br>"."Topic Title: ".$row['title']."<br>"."<br>";



//Going to get all the topics that belong to this board
$query = "SELECT id, datecreated, datereply, content, postid, username, topicid FROM post WHERE topicid=$tid";
$result = mysqli_query($db, $query);


echo "<br>"."-------------------------------------------------------------";

//Shows all the posts in reply to a topic
while($row = $result->fetch_assoc()){
    
    echo "<br>";
    echo $row['content']."<br>"."<br>";
    echo "Posted by: ".$row['username']." on ".$row['datecreated'];
    
    if($row['postid'] > 0)
    {
        $postid = $row['postid'];
        $query2 = "SELECT content FROM post WHERE id=$postid";
        $result2 = mysqli_query($db, $query2);
        
        $row2 = $result2->fetch_assoc();
        
        
        echo "<br>"."In reply to: ".$row2['content'];

    }
    echo "<br>"."-------------------------------------------------------------";
    
    
    /**
     * TODO: Need to add a "Post reply" button and text box that lets users reply
     * and need to update number of replies when someone posts and number of 
     * views everytime someone views a topic
     *
     */
 
}