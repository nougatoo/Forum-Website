<?php
require_once 'navbar.php';
?>
<html>
<body>


<?php

/**
 * Should add an if statement here to make sure they aren't a guest or banned
 * so that we don't show anything for guests
 */
$isGuestBannedFlag = False;
$username = $_SESSION['username'];
print($username);
print("'s Profile Page");
echo "<br><a href='inbox.php'>Inbox</a>";


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
            echo "Error: Unknown Rank";
    }
    ?>
    <br> Rank: <span style="color: <?php echo $rankColour?>; "><?php echo $rankMsg?></span>
    <?php if(!$isGuestBannedFlag) { ?>
        <br> Title: <?php echo $row['title']?>
        <br> Signature: <?php echo $row['signature']?>
        <br> Email: <?php echo $row['email']?>
        <br> Gender: <?php echo $row['gender']?>
        <br> Date Joined: <?php echo $row['datejoined']?>
        <br> Number of Posts: <?php echo $row2['count(id)']?>
    <?php } ?>
<?php
}
if(!$isGuestBannedFlag) { ?>
    <form>
        <label>Biography:</label> <br>
        <textarea name="biography" id="bio" rows="10" cols="50" maxlength="500" placeholder="My Bio" readonly></textarea> <br>
        <input name="Edit" type="button" id="edit" value="Edit" onclick="edit_text()">
    </form>
    <!-- Function used to toggle the readonly attribute of the textblock -->
    <script>
        function edit_text(){
            if(document.getElementById("bio").readOnly == true){
                document.getElementById("bio").readOnly = false;
                document.getElementById("edit").value = "Save";
            } else {
                document.getElementById("bio").readOnly = true;
                document.getElementById("edit").value = "Edit";
                <!-- update biography entry in DB -->
                //console.log(document.getElementById("bio").value);
            }
        }
    </script>
<?php } ?>
<!-- Go back function if we want the edit profile link on every page-->
<br> <button onclick="goBack()">Exit</button>
<script>
    function goBack(){
        window.history.back();
    }
</script>

</body>
</html>