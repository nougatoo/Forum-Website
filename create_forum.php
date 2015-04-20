<?php
    require_once 'navbar.php';

    $title = $_GET['title'];
    $username = $_GET['user'];
    $description = $_GET['description'];

    //If the user filled in all three sections
    if (!empty($username) && !empty($title) && !empty($description)) {
        $query = "INSERT INTO `forum` (username, title, description) VALUES ('$username', '$title', '$description')";
        $result = mysqli_query($db, $query);
        if($result)
        {
            //Gets the id for the forum we just created
            $query = "SELECT MAX(f.id) AS newest FROM forum f";
            $result = mysqli_query($db, $query);
            $row = $result->fetch_assoc();
            $new_fid = $row['newest'];


            $title2 = "default";
            $description2 = "default";

            //Creates a new default board because it won't show the forum on the first page unless it has a board
            $query3 = "INSERT INTO `board` (username, forumid, title, description) VALUES ('$username', '$new_fid', '$title2', '$description2')";
            $result3 = mysqli_query($db, $query3);

            //Gets the id for the newest borad that we just created
            $query = "SELECT MAX(b.id) AS newest FROM board b";
            $result = mysqli_query($db, $query);
            $row = $result->fetch_assoc();
            $new_bid = $row['newest'];

            /** Inserts the appropirate board permissions for the board to show up
             * The default for permissions is the admin can do anything, a user
             * can see, create topic, post in topic, and banned users cant do
             * anything
             */
            $query3 = "INSERT INTO `board_permission` (boardid, rankid, stickytopic, edittopic, hidetopic, removetopic, seeboard, posttopic, createtopic) VALUES ('$new_bid', '0', '1', '1', '1', '1', '1', '1','1')";
            $result3 = mysqli_query($db, $query3);

            $query3 = "INSERT INTO `board_permission` (boardid, rankid, stickytopic, edittopic, hidetopic, removetopic, seeboard, posttopic, createtopic) VALUES ('$new_bid', '1', '0', '0', '0', '0', '1', '1','1')";
            $result3 = mysqli_query($db, $query3);

            $query3 = "INSERT INTO `board_permission` (boardid, rankid, stickytopic, edittopic, hidetopic, removetopic, seeboard, posttopic, createtopic) VALUES ('$new_bid', '2', '1', '1', '1', '1', '1', '0','0')";
            $result3 = mysqli_query($db, $query3);

            $query3 = "INSERT INTO `board_permission` (boardid, rankid, stickytopic, edittopic, hidetopic, removetopic, seeboard, posttopic, createtopic) VALUES ('$new_bid', '3', '0', '0', '0', '0', '0', '0','0')";
            $result3 = mysqli_query($db, $query3);

            $_SESSION["notification"] = "Forum Creation Successful!";
            header("Location: index.php");
        } else {
            $_SESSION["notification"] = "Forum Creation Failed...";
            header("Location: index.php");
        }
    }
?>

