<html>
    <body>

        Welcome <?php 
        session_start();
        //Connecting to DB
        $db = new mysqli('zeeveener.com', 'collier', 'rox', 'collier');
        
        if ($db->connect_errno > 0)
        {
            die('Unable to connect to database [' . $db->connect_error . ']');
        }
        else
        {
            print('Database Connected');
        }
        
        //Storing what the user input
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        $query = "SELECT * FROM user WHERE username='$username' and password='$password'";
        $result = mysqli_query($db, $query) or die(mysqli_error);
        $count = mysqli_num_rows($result);
        
        
        if ($count == 1)
        {
            $_SESSION['username'] = $username;
            print("<br> Hello, you are a registered user");
            //
        }
        else
        {
            print("<br> You are not a registered user, or you have entered an incorrect password");
            //Maybe have two buttons here that give user option to go back and register or continue as guest
              
        }
            
        header("refresh:5; url=index.php");

        ?>
        
        

    </body>
    Wait 5 seconds. We will take you back to the index page~
</html> 