<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    
    <body>
        <?php
        // put your code here
        require 'functions.php';
        loguser();
        header("refresh:1; url=index.php");
        ?>
        You have been logged out...
        Wait 1 second to be redirected.
    </body>
</html>
