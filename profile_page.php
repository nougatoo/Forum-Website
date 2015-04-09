<?php
require_once 'functions.php';
?>
<html>
<body>
<?php
$username = $_SESSION['username'];
print($username);
print("'s Profile Page");

$query = "SELECT * FROM user WHERE username = '$username'";
$result = mysqli_query($db, $query);
while($row = $result->fetch_assoc()) {
    $rank = $row['rank'];
    $signature = $row['signature'];
    $email = $row['email'];
    $rankColour = "black";
    $rankMsg = "Default Message";
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
            break;
        case 3:
            $rankMsg = "You are banned!";
            $rankColour = "red";
            break;
        default:
            echo "Error: Unknown Rank";
    }
    ?>
    <br> Rank: <span style="color: <?php echo $rankColour?>; "><?php echo $rankMsg?></span>
    <br> Title: <?php echo $row['title']?>
    <br> Signature: <?php echo $row['signature']?>
    <br> Email: <?php echo $row['email']?>
    <br> Gender: <?php echo $row['gender']?>
    <br> Date Joined: <?php echo $row['datejoined']?>
<?php
}
?>
    <br> Biography: <br>
    <textarea name="user_bio" rows="10" cols="50" maxlength="500" placeholder="My Biography" readonly></textarea> <br>
    <input name="Edit" type="button" value="Update Bio" onclick="edit_text()">

<!-- trying to figure out how toggle the readonly attribute of the textblock -->
<script>
    function edit_text(){

    }
</script>

<!-- Go back function if we want the edit profile link on every page-->
<br> <button onclick="goBack()">Exit</button>
<script>
    function goBack(){
        window.history.back();
    }
</script>

</body>
</html>