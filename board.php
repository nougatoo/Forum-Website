<?php
require 'functions.php';
initialize();
?>
<html>
<body>
<?php

$_SESSION['title'] = $_POST['goto_board'];
print($_SESSION['title']); //Prints the name of the board you chose to enter

?>

</body>
</html>