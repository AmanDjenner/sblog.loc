<?php require_once("include/Sessions.php");?>
<?php require_once("include/Functions.php");?>
<?php require_once("include/DB.php");?>
<?php Confirm_Login();?>
<?php

if(isset($_POST["Submit"])) {
    $UserName = mysqli_real_escape_string($Connection, $_POST["userName"]);
    $Password = mysqli_real_escape_string($Connection, $_POST["password"]);
    $ConfirmPassword = mysqli_real_escape_string($Connection, $_POST["confirmPassword"]);
    date_default_timezone_set("Moldova/Chisinau");
    $CurrentTime = time();
    $Data = strftime("%d-%b-%Y", $CurrentTime);
    $Time = strftime("%H:%M:%S", $CurrentTime);
    $Data;
    $Time;

    $Admin=$_SESSION["UserName"];
    if(empty($UserName) || empty($Password) ||empty($ConfirmPassword)) {
        /** @var TYPE_NAME $_SESSION */
        $_SESSION["ErrorMessage"] = "Completati cimpurile!";
        Redirect_to("admin.php");
    }elseif(strlen($Password)<3) {
        $_SESSION["ErrorMessage"] = "Parola nu poate fi mai mica de 8 simboluri";
        Redirect_to("admin.php");
    }elseif($Password!==$ConfirmPassword) {
        $_SESSION["ErrorMessage"] = "Parola introdusa sunt difera de parola confirmata.";
        Redirect_to("admin.php");
    }else{
        global $Connection;
        $Query = "INSERT INTO registration 
                    (data,time,username,password,addedby)
        VALUES
                    ('$Data','$Time','$UserName','$Password','$Admin')";
        $result=mysqli_query(  $Connection, $Query);
        if ($result){
            $_SESSION["SuccessMessage"] = "Userul a fost adaugata cu succes.";
            Redirect_to("admin.php");
        }else{
            $_SESSION["ErrorMessage"] = "Userul nu a fost adaugat.";
            Redirect_to("admin.php");
//        if (mysqli_affected_rows($Connection)!= 1){
//            echo '<p>Eruare</p>'.mysqli_connect_error($Connection);
//            echo $Query;
//            mysqli_close($Connection);
//        }
//        else
//            {
//                mysqli_close($Connection);
//                header("Location:Categories.php");
        }

    }

}
?>
<?php include "include/adminHeader.php"?>
<div class="container-fluid">
    <div class="row">

<?php include "include/adminMeniu.php"?>
<div class="panou col-sm-10">
    <div class="page-header">
        <h1>Adminka</h1>
        <div><?php
            echo Message();
            echo SuccessMessage();
            ?>
        </div>
    </div>
    <div>
        <form action="admin.php" method="post">
            <fieldset>
                <div class="form-group">
                    <label for="userName"><span class="FieldInfo">Utilizator:</span></label>
                    <input class="form-control" type="text" name="userName" id="userName" placeholder="userName" >
                </div>
                <br>
                <div class="form-group">
                    <label for="password"><span class="FieldInfo">Parola:</span></label>
                    <input class="form-control" type="password" name="password" id="password" placeholder="password" >
                </div>
                <br>
                <div class="form-group">
                    <label for="confirmPassword"><span class="FieldInfo">Confirma parola:</span></label>
                    <input class="form-control" type="password" name="confirmPassword" id="confirmPassword" placeholder="confirmPassword" >
                </div>
                <br>
                <input class="btn btn-success btn-block" type="Submit" name="Submit" value="Adaugă administrator">
            </fieldset>
            <br>
        </form>
    </div>
    <br>
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <tr>
                <th>ID</th>
                <th>Data</th>
                <th>Ora</th>
                <th>Administrator</th>
                <th>Adaugat de</th>
                <th>Actiune</th>
            </tr>
            <?php
            global $Connection;
            $VieWQuery="SELECT  * FROM registration ORDER BY data AND time DESC";
            $Execute=mysqli_query($Connection, $VieWQuery);
            $SRno=0;

            While($DataRows=mysqli_fetch_array( $Execute)){
                $Id=$DataRows["id"];
                $Data=$DataRows["data"];
                $Time=$DataRows["time"];
                $Nume=$DataRows["username"];
                $CreatorName=$DataRows["addedby"];
                $SRno++
                ?>
                <tr>
                    <td><?php echo $SRno; ?></td>
                    <td><?php echo $Data; ?></td>
                    <td><?php echo $Time; ?></td>
                    <td><?php echo $Nume; ?></td>
                    <td><?php echo $CreatorName; ?></td>
                    <td><a href="deleteUser.php?id=<?php echo $Id; ?>"><span class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></span></a></td>
                </tr>
            <?php } ?>
        </table>
    </div>

</div><!-- end main areea -->
</div><!-- container-fluid -->
</div>
</div>

</body>

<!--
   <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script> -->
<!-- <script src="/js/jquery-3.4.1.min.js"></script>
<script src="/js/bootstrap.min.js"></script> -->
<div id="footer">
    <br>
    <hr>
    <p>   Creat de | Gheorghi Vedeș | &copy;2019 --- Cu drepturi rezervate</p>
    <hr>
</div>
<!-- beg
</body>  in Footer -->
</html>