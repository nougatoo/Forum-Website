<?php
    require_once("functions.php");
    if(isset($_SESSION["reg_success"]) && !$_SESSION["reg_success"]){
        print("Unable to Register with that Information. Please try again.\n");
        unset($_SESSION["reg_success"]);
    }
?>

<html>
    <body>
        <form action="register.php" method="POST">
            Username: <input type="text" name="username_r" required><br>
            Password: <input type="password" name="password_r" required><br>
            Signature: <input type="text" name="signature"><br>
            Email Address: <input type="text" name="email" required><br>
            Gender: 
                <select name="gender">
                    <option disabled="disabled" name="gender" value="">Choose one:</option>
                    <option name="gender" value="female">Female</option>
                    <option name="gender" value="male">Male</option>
                    <option name="gender" value="other">Other</option>
                </select><br>
            Age: <input type="number" name="age" min="13" required><br>
            Title: <input type="text" name="title"><br>
            <input type="submit" value="Register">
        </form>
    </body>
</html> 