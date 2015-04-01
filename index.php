<?php
    require 'functions.php';
?>        

<html>
    <body>

        <?php if (isset($_SESSION['username'])) : ?>
            We are set set.
            <br><a href='logout.php'>Log Out</a>
        <?php else : ?>
            We are not logged in
            <br><a href='login.php'>Login</a>
            <br><a href='reg_screen.php'>Register</a>        
        <?php endif; ?>
        

            <p>==========ROBERT COLLIER FAN FORUM==========</p>
            
        <?php
            if (isset($_SESSION['username']))
            {
                $user = $_SESSION['username'];
                $query = "SELECT create_forum, create_board FROM rank JOIN user ON user.rank=rank.id WHERE username='$user'";
                $perm_result = mysqli_query($db, $query);
                
                if ($perm_result->num_rows>0)
                {
                    $value = $perm_result->fetch_assoc();
                    if ($value['create_forum']==1)
                    {
                        echo 'I am an Administrator! I have Rights to Create Forums!!<br>';
                        /*
                         * TODO: Display "Add Forum" Function.
                         * Also display the Forum with the corresponding Boards underneath
                         * We also need to implement the "Add Board" Function underneath every forum.
                         * Possibly assign the Forum ID to be associated with the Add Board link?
                         * Extra: Delete Forum
                         */
                    }
                    
                    if ($value['create_board']==1)
                    {
                        echo 'I have permission to create boards!<br>';
                        
                    }
                }
                else
                {
                    echo "Welp this didnt work";
                }
                /*
                * TODO: Display Forums for Regular Users
                * We may not even need this else statement, because Admins should be able to see the rest of the Forums too.
                */
            }
        ?>
           <!-- Need to join the user with rank, and then check for create_forum
           select create_forum
            FROM rank
            INNER JOIN user
            ON user.rank=rank.id
            WHERE username='collier';
           
           --> 
           
        <?php
            close();
        ?>
    </body>
</html>