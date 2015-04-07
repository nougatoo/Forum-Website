<?php
    require_once 'functions.php';
?>      
<html>
    <body>
        <?php

        /* 
         * To change this license header, choose License Headers in Project Properties.
         * To change this template file, choose Tools | Templates
         * and open the template in the editor.
         */
            $_SESSION['fid'] = $_POST['add_board'];
            echo $_SESSION['fid']; //This is the forum id number
            
        ?>
        <form action="create_board.php" method="post">
            Title<br>  <input type="text" name="board_title" maxlength="50"><br>
            Description <br>
            <textarea name="board_desc" rows="10" cols="50" maxlength="500"></textarea> <br>
        <input type="submit" value="Create Board">
    </body>
</html>