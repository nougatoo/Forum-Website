<?php
require 'functions.php';
initialize();
?>
<html>
<body>
<?php
//Storing what the user input
$username = $_POST['username'];
$password = $_POST['password'];

$query = "SELECT * FROM user WHERE username='$username' and password='$password'";
$result = mysqli_query($db, $query) or die(mysqli_error);
$count = mysqli_num_rows($result);


if ($count == 1){
    $_SESSION['username'] = $username;
    print("<br> Hello, you are a registered user");
    //
} else {
    print("<br> You are not a registered user, or you have entered an incorrect password");
    //Maybe have two buttons here that give user option to go back and register or continue as guest
}

header("refresh:1; url=index.php");
?>
</body>
Redirecting you to the home page...
</html> 