<?php require_once("include/Sessions.php");?>
<?php require_once("include/Functions.php");?>
<?php require_once("include/DB.php");?>
<?php Confirm_Login();?>
<?php
if (isset($_GET['id'])){
    $Id=$_GET['id'];
    $Connection;
    $Query="DELETE FROM registration WHERE id='$Id'";
    $Execute = mysqli_query($Connection, $Query);
    if ($Execute) {
        $_SESSION["SuccessMessage"] = "Userul a fost stears cu succes";
        Redirect_to("admin.php");
    } else {
        $_SESSION["ErrorMessage"] = "Error! Userul nu a fost sters";
        Redirect_to("dmin.php");
    }
}

?>
