<?php require_once("include/Sessions.php");?>
<?php require_once("include/Functions.php");?>
<?php require_once("include/DB.php");?>
<?php

if(isset($_POST["Submit"])) {
    $UserName = mysqli_real_escape_string($Connection, $_POST["username"]);
    $Password = mysqli_real_escape_string($Connection, $_POST["password"]);

    if(empty($UserName) || empty($Password) ) {
        /** @var TYPE_NAME $_SESSION */
        $_SESSION["ErrorMessage"] = "Completati cimpurile!";
        Redirect_to("login.php");
    }else{
        $Found_Account=Login_Attempt($UserName,$Password);
        $_SESSION["User_id"] = $Found_Account['id'];
        $_SESSION["UserName"] = $Found_Account['username'];
        if($Found_Account){
            $_SESSION["SuccessMessage"] = "Bine ati venit {$_SESSION['UserName']}!";
            Redirect_to("dashboard.php");

        }else {
            Redirect_to("login.php");
            $_SESSION["ErrorMessage"] = "Userul sau parola a fost introdusa gresit";
        }
    }
}
?>
<?php include "include/adminHeader.php"?>
<div class="container-fluid bk ">
    <div class="row">


        <div class="panou_log col-smoffset-sm-4">
            <div class="page-header">
                <h1>Logare</h1>
                <div><?php
                    echo Message();
                    echo SuccessMessage();
                    ?>
                </div>
            </div>
            <div >
                <form action="login.php" method="post">
                    <fieldset>
                        <div class="form-group">
                            <label for="userName"><span class="FieldInfo">Utilizator:</span></label>
                            <div class="input-group input-group-lg">
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-envelope text-primary"></span>
                        </span>
                                <input class="form-control" type="text" name="username" id="userName" placeholder="Utilizator" >
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="password"><span class="FieldInfo">Parola:</span></label>
                            <div class="input-group input-group-lg">
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-lock text-primary"></span>
                        </span>
                                <input class="form-control" type="password" name="password" id="password" placeholder="Parola" >
                            </div>
                        </div>
                        <br>
                        <input class="btn btn-info btn-block" type="Submit" name="Submit" value="Logare">
                    </fieldset>
                    <br>
                </form>
            </div>


        </div><!-- end main areea -->
    </div><!-- container-fluid -->
</div>


</div>
</body>


</html>