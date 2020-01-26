<?php require_once("include/Sessions.php");?>
<?php require_once("include/Functions.php");?>
<?php require_once("include/DB.php");?>
<?php Confirm_Login();?>
<?php
if (isset($_GET['id'])){
    $IdFromURL=$_GET['id'];
    $Connection;
    $Query="DELETE FROM comments WHERE id='$IdFromURL'";
    $Execute = mysqli_query($Connection, $Query);
    if ($Execute) {
        $_SESSION["SuccessMessage"] = "Comentariul cu ID-ul .$IdFromURL  a fost sters";
    Redirect_to("comments.php");
    } else {
        $_SESSION["ErrorMessage"] = "Error! Comentariul cu ID-ul .$IdFromURL nu a fost sters";
                         Redirect_to("comments.php");
    }
}

?>
