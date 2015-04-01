<html>
    <body>
        <?php
            print("Hello World, just testing -Brandon");
            session_start();
        ?>
        This is a test.
        <br><a href="login.php">Login</a>
        <br><a href="reg_screen.php">Register</a>
        
        <?php
        //mysqli('host', 'user', 'password', 'database');
        $db = new mysqli('zeeveener.com', 'collier', 'rox', 'collier');
        
        if ($db->connect_errno > 0)
        {
            die('Unable to connect to database [' . $db->connect_error . ']');
        }
        else
        {
            print('Database Connected');
        }
        
        if (isset($_SESSION['username']))
        {
            print('<br>We are so set');
        }
        else
        {
            print('<br>We are not logged in');
        }
        ?>
        
        <?php
        if (CONNECTION_ABORTED==1)
        {
            session_unset();
            session_destroy();
        }
        ?>
    </body>
</html>