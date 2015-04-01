<html>

    <body>

        <?php
            print("Hello World, just testing -Brandon");
            require 'functions.php';
        ?>
        This is a test.
        
        <?php
            
        //mysqli('host', 'user', 'password', 'database');
        /*$db = new mysqli('zeeveener.com', 'collier', 'rox', 'collier');
        if ($db->connect_errno > 0)
        {
            die('Unable to connect to database [' . $db->connect_error . ']');
        }
        else
        {
            print('Database Connected');
        }*/
        
        
        if (isset($_SESSION['username']))
        {
            print('<br>We are so set');
        }
        else
        {
            print('<br>We are not logged in');
            echo "<br><a href='login.php'>Login</a>";
            echo "<br><a href='reg_screen.php'>Register</a>";    
        }
        ?>
        
        <?php
            close();
        ?>
    </body>
</html>