<?php require_once("include/Sessions.php");?>
<?php require_once("include/Functions.php");?>
<?php require_once("include/DB.php");?>
<?php Confirm_Login();?>
<?php
    $DeleteFromURL = $_GET['id'];
    $VieWQuery="SELECT  image FROM admin_panel WHERE id = $DeleteFromURL";
    $Execute = mysqli_query($Connection, $VieWQuery);
    $Result = mysqli_fetch_assoc($Execute);
    $Target="Uploads/images/" . $Result["image"];

    $Query = "DELETE FROM admin_panel where id='$DeleteFromURL' ";
    $Execute = mysqli_query($Connection, $Query);
    if ($Execute) {
        $_SESSION["SuccessMessage"] = "Postul a fost sters cu succes.";
        unlink ($Target);
        Redirect_to("Dashboard.php");
    } else {
        $_SESSION["ErrorMessage"] = "Eror la stergerea postului.";
        Redirect_to("Dashboard.php");
    }
?>

