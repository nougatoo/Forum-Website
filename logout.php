<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
    require 'functions.php';
?>      
<html>
    
    <body>
        <?php
        // put your code here
        loguser();
        header("refresh:1; url=index.php");
        ?>
        Logging out...
        Redirecting you to the home page...
    </body>
</html>
