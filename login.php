<?php
    require_once "navbar.php";
?>

<html>
    <head>
        <title>Login</title>
    </head>
    <style type="text/css">
        div {
            text-align: center;
        }

        form {
            display: inline-block;
            text-align: left;
        }

        label, input {
            margin-bottom: 5px;
        }
    </style>

    <body>
        <div>
            <form action="welcome.php" method="post">
                <label>Please enter your username and password</label><br>

                <label for="username">Username:</label>
                <input type="text" name="username"><br>

                <label for="password">Password:</label>
                <input type="password" name="password"><br>

                <input type="submit" value="Log In">
            </form>
        </div>
    </body>
</html> 