
<html>
<head>
    <script>
        function gotoregister() {
            location.href = "register.php"
        }

    </script>
</head>

<body>

<form action="register.php" method="POST">
    Username: <input type="text" name="username_r"><br>
    Password: <input type="password" name="password_r"><br>
    Signature: <input type="text" name="signature"><br>
    Email Address: <input type="text" name="email"><br>
    Gender: <select name="gender">
        <option disabled="disabled" name="gender" value="">Choose one:</option>
        <option name="gender" value="female">Female</option>
        <option name="gender" value="male">Male</option>
        <option name="gender" value="other">Other</option>
    </select><br>
    <!-- Do we want to have the user's age? for age restrictions to the site?-->
    Age: <input type="text" name="age"><br>
    Title: <input type="text" name="title"><br>
    <input type="submit" value="Register">

</body>
</html> 