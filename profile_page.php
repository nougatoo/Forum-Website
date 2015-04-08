<?php
require_once 'functions.php';
?>
<html>
<body>
<?php
$username = $_SESSION['username'];
print($username);
print("'s Profile Page");

$query = "SELECT * FROM user WHERE username=$username";
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
    <br> Rank: <p><span style="color: <?php echo $rankColour?>; "><?php echo $rankMsg?></span></p>
    <br> Signature: <?php echo $signature?>
<?php
}
?>

</body>
</html>