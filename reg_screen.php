<?php
    require_once("navbar.php");
?>

<html>
    <style type="text/css">
        #reg_form {
            text-align: center;
        }

        #reg_form form {
            display: inline-block;
            text-align: left;
        }

        #reg_form label, #reg_form input, #reg_form select {
            margin-bottom: 5px;
        }

    </style>

    <body>
        <div id="reg_form">
            <form action="register.php" method="POST">
                <label for="username_r">Username:</label>
                <input type="text" name="username_r" required><br>

                <label for="password_r">Password:</label>
                <input type="password" name="password_r" required><br>

                <label for="signature">Signature:</label>
                <input type="text" name="signature"><br>

                <label for="email">Email Address:</label>
                <input type="text" name="email" required><br>

                <label for="gender">Gender:</label>
                <select name="gender">
                    <option disabled="disabled" name="gender" value="">Choose one:</option>
                    <option name="gender" value="female">Female</option>
                    <option name="gender" value="male">Male</option>
                    <option name="gender" value="other">Other</option>
                </select><br>

                <label for="age">Age:</label>
                <input type="number" name="age" min="13" value="13" required><br>

                <label for="title">Title:</label>
                <select name="title">
                    <option disabled="disabled" name="title" value="">Choose one:</option>
                    <option name="title" value="Mrs.">Mrs.</option>
                    <option name="title" value="Ms.">Ms.</option>
                    <option name="title" value="Mr.">Mr.</option>
                    <option name="title" value="Dr.">Dr.</option>
                    <option name="title" value="Sir">Sir</option>
                    <option name="title" value="Master">Master</option>
                    <option name="title" value="King">King</option>
                    <option name="title" value="Queen">Queen</option>
                    <option name="title" value="Prince">Prince</option>
                    <option name="title" value="Princess">Princess</option>
                    <option name="title" value="N/A">Other</option>
                </select>
                <br>
                <input type="submit" value="Register">
            </form>
        </div>
    </body>
</html> 