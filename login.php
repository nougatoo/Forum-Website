<html>
    <head>
    <script>
        function gotoregister() {
    
            location.href = "register.php"
        }
        
    </script>
    </head>
    
    <body>
        Please enter your username as password
        <br>
        <br>
        <form action="welcome.php" method="post">
            Username: <input type="text" name="username"><br>
            Password: <input type="text" name="password"><br>
            <input type="submit">
        </form>

    </body>
</html> 