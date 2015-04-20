<?php
    require_once("functions.php");

    $notification = "";

    if(isset($_SESSION["notification"])){
        $notification = $_SESSION["notification"];
        unsset($_SESSION["notification"]);
    }
?>
<link rel="stylesheet" type="text/css" href="styles.css"/>

<div class="navbar">
    <ul>
        <li style="float: left"><a href="index.php">Home</a></li>
        <li style="float: left"><label><?php echo $notification?></label></li>

<?php
    if(!isset($_SESSION["username"]) || $_SESSION["username"] === "Guest"){
?>
        <li><a href="login.php">Login</a></li>
        <li><a href="reg_screen.php">Register</a></li>
<?php
    }else{
?>
        <li><a href="logout.php">Logout</a></li>
        <li><a href="profile_page.php">Profile Page</a></li>
        <li><label>Hello <?php echo $_SESSION["username"]?>!</label></li>
<?php
    }
?>
    </ul>
</div>