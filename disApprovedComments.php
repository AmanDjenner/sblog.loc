<?php require_once("include/Sessions.php");?>
<?php require_once("include/Functions.php");?>
<?php require_once("include/DB.php");?>
<?php Confirm_Login();?>
<?php
if (isset($_GET['id'])){
    $IdFromURL=$_GET['id'];
    $IdPost=$_GET['post'];
    $Connection;
    $Query="UPDATE comments SET status='OFF' 
        where id='$IdFromURL'";
    $Execute = mysqli_query($Connection, $Query);
    if ($Execute) {
        $_SESSION["SuccessMessage"] = "Comentariul cu ID-ul .$IdFromURL a fost a fost adaugat in lista cu comentarii noi";
    Redirect_to("comments.php?id=$IdPost");
    } else {
        $_SESSION["ErrorMessage"] = "Error! Comentariul cu ID-ul .$IdFromURL  nu a fost adaugat in lista cu comentarii noi.";
                         Redirect_to("comments.php?id=$IdPost");
    }
}

?>
