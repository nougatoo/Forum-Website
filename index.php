<html>
    <body>
        <?php
            print("Hello World, just testing -Brandon");
            require 'functions.php';
        ?>        
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
                $query = "SELECT create_forum FROM rank JOIN user ON user.rank=rank.id WHERE username='$user'";
                $result = mysqli_query($db, $query);
                
                if ($result->num_rows>0)
                {
                    $value = $result->fetch_assoc();
                    if ($value['create_forum']==1)
                    {
                        echo 'I am an Administrator! I have Rights!!';
                    }
                    else
                    {
                        echo 'Lol I anit an admin...';
                    }
                }
                else
                {
                    echo "Welp this didnt work";
                }
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