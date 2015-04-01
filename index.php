<html>
    <body>
        <?php
            print("Hello World, just testing -Brandon");
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
        ?>
    </body>
</html>