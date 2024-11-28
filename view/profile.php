<?php
session_start();
if(!isset($_SESSION["first_name"])){
    header("Location: ../view/customer_registration.php");
}

?>
<html>
    <body>
        Hi <?php echo $_SESSION["first_name"]; ?>
        <a href="../control/sessionout.php">Log Out</a> 
    </body>
</html>
