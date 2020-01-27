<?php require_once("include/DB.php");?>
<?php require_once("include/Sessions.php");?>
<?php
//session_start();
/**
 * @param $New_Location
 */
function Redirect_to($New_Location){
    header("Location:" .$New_Location);
    exit;
}
function Login_Attempt($UserName,$Password){
    global $Connection;
    $Query="SELECT * FROM registration
            WHERE username='$UserName' AND password='$Password'";
    $Execute=mysqli_query($Connection, $Query);
    if($admin=mysqli_fetch_assoc($Execute)){
        return $admin;
    }else{
        return null;
    }
}
function Login(){
    if(isset($_SESSION['User_id'])){
        return true;
    }
}

function Confirm_Login() {
    if(!Login()){
        $_SESSION["ErrorMessage"] = "Accesul doar pentru utilizatori logați .";
        Redirect_to("login.php");
    }
}

function getCategories() {
    global $Connection;
    $Query="SELECT * FROM category";
    $result = $Execute = mysqli_query($Connection, $Query);

    return $result;
}













