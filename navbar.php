<?php
    require_once("functions.php");

    $notification = "";

    if(isset($_SESSION["reg_success"])){
        if($_SESSION["reg_success"] === true){
            $notification = "Registration Successful!";
        }else{
            $notification = "Registration Failed!";
        }
    }else{}
?>
<style type="text/css">
    div.navbar ul {
        list-style-type: none;
        margin: 0 10px;
        padding: 0;
        overflow: hidden;
    }

    div.navbar li {
        float: right;
        padding: 2px;
    }

    div.navbar {
        padding-bottom: 10px;
        width: 100%;
    }
</style>


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