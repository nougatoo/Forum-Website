<?php
require 'functions.php';
initialize();
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

</body>
</html>