<?php
    require 'functions.php';
    initialize();
?>      
<html>
    <body>
        <?php

        /* 
         * To change this license header, choose License Headers in Project Properties.
         * To change this template file, choose Tools | Templates
         * and open the template in the editor.
         */
        $fid = $_POST['add_board'];
        echo $fid;
        
        header("refresh:1; url=index.php"); //Remove this later
        ?>
    </body>
    Wait 1 seconds.
    We will take you back to the index page~
</html>