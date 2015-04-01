<html>
    <head>
    <script>
        function gotoregister() {
    
            location.href = "register.php"
        }
        
    </script>
    </head>
    
    <body>
        
        <form action="welcome.php" method="post">
            Username: <input type="text" name="username"><br>
            Password: <input type="text" name="password"><br>
            <input type="submit">
        </form>
        
        Or Register
        <br> 
        <br>
        <br>
        
        <form action="register.php" method="post">
        Username: <input type="text" name="username_r"><br>
        Password: <input type="text" name="password_r"><br>
        Signature: <input type="text" name="signature"><br>
        Email Address: <input type="text" name="email"><br>
        Gender: <input type="text" name="gender"><br>
        Title: <input type="text" name="title"><br>
        <input type="submit" value="Register">
        
    </body>
</html> 