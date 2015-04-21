<?php
    require_once "navbar.php";
    $username = $_SESSION['username'];

    if(isset($_POST["biography"])){
        $query4 = "UPDATE `profile_page` SET biography='{$_POST['biography']}' WHERE user='$username';";
        $result4 = mysqli_query($db, $query4);
    }
?>
<html>
    <head>
        <title>Profile Page</title>
    </head>
    <body>
        <div class="profile">
<?php

    /**
     * Should add an if statement here to make sure they aren't a guest or banned
     * so that we don't show anything for guests
     */
    $isGuestBannedFlag = False;

    $query = "SELECT * FROM user WHERE username = '$username'";
    $result = mysqli_query($db, $query);
    while($row = $result->fetch_assoc()) {
        $rank = $row['rank'];
        $signature = $row['signature'];
        $email = $row['email'];
        $rankColour = "black";
        $rankMsg = "Default Message";

    //Query to get the number of posts by user
        $query2 = "SELECT count(id), username FROM post WHERE username = '$username'";
        $result2 = mysqli_query($db, $query2);
        $row2 = $result2->fetch_assoc();
    //Query to get the biography and status of the user
        $query3 = "SELECT `status`,`biography` FROM profile_page WHERE user = '$username'";
        $result3 = mysqli_query($db, $query3);
        $row3 = $result3->fetch_assoc();
        $status = $row3['status'] == 1;

        switch ($rank) {
            case 0:
                $rankMsg = "You are an Administrator";
                $rankColour = "blue";
                break;
            case 1:
                $rankMsg = "You are a Registered User";
                $rankColour = "green";
                break;
            case 2:
                $rankMsg = "You are a Guest";
                $rankColour = "yellow";
                $isGuestBannedFlag = True;
                break;
            case 3:
                $rankMsg = "You are banned!";
                $rankColour = "red";
                $isGuestBannedFlag = True;
                break;
            default:
                $rankMsg = "Unknown Rank";
                $rankColour = "red";
                break;
        }
        if(!$isGuestBannedFlag) {
?>
            <table cellpadding="2" cellspacing="2" align="center">
                <tr>
                    <th colspan="2"><h2><?php echo $username?>'s Profile Page</h2></th>
                </tr>
                <tr>
                    <td>Status:</td>
                    <td><span style="color: <?php echo $status ? 'green' : 'red'?>"><?php echo $status ? 'Online' : 'Offline'?></span></td>
                </tr>
                <tr>
                    <td>Inbox:</td>
                    <td><a href='inbox.php'>Go To Inbox</a></td>
                </tr>
                <tr>
                    <td>Rank:</td>
                    <td><span style="color: <?php echo $rankColour?>; "><?php echo $rankMsg?></span></td>
                </tr>
                <tr>
                    <td>Title:</td>
                    <td><?php echo $row['title']?></td>
                </tr>
                <tr>
                    <td>Signature:</td>
                    <td><?php echo $row['signature']?></td>
                </tr>
                <tr>
                    <td>Email:</td>
                    <td><?php echo $row['email']?></td>
                </tr>
                <tr>
                    <td>Gender:</td>
                    <td><?php echo $row['gender']?></td>
                </tr>
                <tr>
                    <td>Date Joined:</td>
                    <td><?php echo $row['datejoined']?></td>
                </tr>
                <tr>
                    <td>Posts:</td>
                    <td><?php echo $row2['count(id)']?></td>
                </tr>
                <tr>
                    <td colspan="20">
                        <form action="profile_page.php" method="post">
                            Biography: <br>
                            <textarea maxlength="10000" name="biography" rows="10" cols="40"><?php echo $row3['biography']?></textarea>
                            <input name="editbio" type="submit" value="Save">
                        </form>
                    </td>
                </tr>
            </table>
<?php
        }
    }
?>
        </div>
    </body>
</html>