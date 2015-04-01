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
        
        <?php
            close();
        ?>
            <p>==========ROBERT COLLIER FAN FORUM==========</p>
    </body>
</html>