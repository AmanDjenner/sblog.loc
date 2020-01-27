<?php require_once("include/Sessions.php");?>
<?php require_once("include/Functions.php");?>
<?php require_once("include/DB.php");?>
<?php Confirm_Login();?>
<?php
if (isset($_GET['id'])){
    $IdCategory=$_GET['id'];
    $Connection;
    $Query="DELETE FROM category WHERE id='$IdCategory'";
    $Execute = mysqli_query($Connection, $Query);
    if ($Execute) {
        $_SESSION["SuccessMessage"] = "Categoria a fost stearsa cu succes";
        Redirect_to("Categories.php");
    } else {
        $_SESSION["ErrorMessage"] = "Error! Categoria nu a fost stersa";
        Redirect_to("Categories.php");
    }
}

?>
