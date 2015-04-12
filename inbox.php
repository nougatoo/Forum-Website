<html>
    <body>
        
        <a href="profile_page.php">Go Back to Profile Page</a>
        <br>
        <?php
            require_once 'functions.php';
            
            $username = $_SESSION['username'];
            
            /**
             * If statement could probably be a query to check if username
             * is in db, but just check it simple for now
             * - Could be removed entirely if we have profile page not show
             *   anything for guests and banned people
             */
            
            if($username == "Guest")
            {
                echo "You are a guest and have no inbox"."<br>"."Redirecting you to index page";
                header("refresh:3; url=index.php");
            }
            else
            {
                echo "<br>";
                echo "<a href='sent.php'>Messages You Sent</a>"."<br>"."<br>";
                echo "<a href='received.php'>Messages You Received</a>"."<br>"."<br>";
                echo "<a href='send_screen.php'>Send a New Message</a>"."<br>"."<br>";
                
            }
            
        ?>
        
        

    </body>
    
</html>
