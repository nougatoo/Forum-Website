<?php
    require 'functions.php';
    initialize();
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
                         * Display a Forum Based of how many Board is Visible
                         * If a Forum have at LEAST ONE VISIBLE BOARD for a user, then the Forum should be displayed
                         * with the visible boards.
                         * If a Forum does NOT have ANY VISIBLE BOARD for a user, then the Forum should NOT be displayed
                         * Extra: Delete Forum
                         */
                        
                        ?>
            
                        <form action = "create_forum.php" method = "post">
                            <input type="submit" value="Create Forum" />
                        </form>
                        
                        <?php
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
                
                $query = "SELECT title, id FROM forum";
                $result = mysqli_query($db, $query);
                
                
                //Shows all the forums and the boards that go with 
                while($row = $result->fetch_assoc()){
                    echo "<br>"."<br>";
                    ?>
            
                    <font size="4"><b>
                        
                    <?php 
                    echo $row["title"]. ": ";
                    ?> 
                        
                    </font></b>
                    
                    <?php 
                    
                    $fid = $row["id"];

                    $query2 = "SELECT title, description,id FROM board WHERE forumid=$fid";
                    $result2 = mysqli_query($db, $query2);
                    
                    while($row2 = $result2->fetch_assoc()) {
                        
                        echo "<br>".$row2["title"].": ";
                        echo $row2["description"]. " ";
                        $bid = $row2["id"];
                    ?>
                    
                    <form action = "board.php" method = "post">
                        <input type="submit" name=$bid value="Go Here" />
                    </form>
                 
                    <?php
                    }
                   
                }
                
                 
            }
        ?>
           <!-- Need to join the user with rank, and then check for create_forum
           select create_forum
            FROM rank
            INNER JOIN user
            ON user.rank=rank.id
            WHERE username='collier';
           
            UPDATE board
            SET notopic=(SELECT COUNT(*) FROM topic WHERE id=boardid)
            WHERE id=1;
            ^This will update the number of topics inside a board.
           
           --> 
           
    </body>
</html>