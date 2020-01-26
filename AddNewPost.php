<?php require_once("include/Sessions.php");?>
<?php require_once("include/Functions.php");?>
<?php require_once("include/DB.php");?>
<?php Confirm_Login();?>

<?php
if(isset($_POST["Submit"])) {
    $Title = mysqli_real_escape_string($Connection, $_POST["Title"]);
    $Category = mysqli_real_escape_string($Connection, $_POST["Category"]);
    $Post = mysqli_real_escape_string($Connection, $_POST["Post"]);
    date_default_timezone_set("Moldova/Chisinau");
    $CurrentTime = time();
    $Data = strftime("%d-%b-%Y ", $CurrentTime);
    $Time = strftime("%H:%M:%S", $CurrentTime);
    $Data;
    $Time;
    $Admin="Verdes Gheorghi";
    $Image=$_FILES["Image"]["name"];
    $Target="Uploads/images/".basename($_FILES["Image"]["name"]);
    if(empty($Title)) {
        /** @var TYPE_NAME $_SESSION */
        $_SESSION["ErrorMessage"] = "Indicati titlul!";
        Redirect_to("AddNewPost.php");
    }elseif(strlen($Title)>150) {
        $_SESSION["ErrorMessage"] = "Ati introdus un nume prea mare.";
        Redirect_to("AddNewPost.php");
    }elseif(strlen($Title)<5) {
        $_SESSION["ErrorMessage"] = "Denumirea postului nu poate fi mai mica decit 5 simboluri.";
        Redirect_to("AddNewPost.php");
    }else{
        $Query = "INSERT into admin_panel
                    (data,time,title,category,autor,image,post)
        VALUES
                    ('$Data','$Time','$Title','$Category','$Admin','$Image','$Post')";
        $Execute=mysqli_query(  $Connection, $Query);
        move_uploaded_file($_FILES["Image"]["tmp_name"],$Target);
        if ($Execute){
            $_SESSION["SuccessMessage"] = "Postul a fost adaugat cu succes.";
            Redirect_to("AddNewPost.php");
        }else{
            $_SESSION["ErrorMessage"] = "Postul a fost adaugat cu erori.";
            Redirect_to("AddNewPost.php");
        }

    }

}
?>
            <?php include "include/adminHeader.php"?>
            <?php include "include/adminMeniu.php"?>
<div class="container-fluid">
    <div class="row">

        <div class="panou col-sm-10">
            <div class="page-header">
                <h1>Adauga un post</h1>
                <div>
                    <?php
                    echo Message();
                    echo SuccessMessage();
                    ?>
                </div>
            </div>
            <div>
                <form action="AddNewPost.php" method="post" enctype="multipart/form-data">
                    <fieldset>
                        <div class="form-group">
                            <label for="title"><span class="FieldInfo">Titlu:</span></label>
                            <input class="form-control" type="text" name="Title" id="title" placeholder="Titlu" >
                        </div>
<!--                        //inceputul blocului categorie-->
                        <div class="form-group col-lg-6 col-sm-12 ">
                            <label for="categoryselect"><span class="FieldInfo">Categorie:</span></label>
                            <select class="form-control" id="categoryselect" name="Category"   placeholder="Selecteaza categoria" >
                        <?php
                        $VieWQuery="SELECT  * FROM category ORDER BY data AND time DESC";
                        $Execute=mysqli_query($Connection, $VieWQuery);
                        While($DataRows=mysqli_fetch_array($Execute)){
                        $Id=$DataRows["id"];
                        $Nume=$DataRows["nume"];
                        ?>
                                <option><?php echo $Nume?></option>
                            <?php } ?>
                                </select>
                        </div>
<!--                        //sfirsit categorie-->
<!--                        inceput imagine-->
                        <div class="form-group col-sm-12 col-lg-6">
                            <label for="imageselect"><span class="FieldInfo">Imagine:</span></label>
                                <input type="file" class="form-control" name="Image" id="imageselect" >
                        </div>
<!--                        sfirsit imagine-->
<!--                        inceput post-->
                        <div class="form-group">
                            <label for="postarea"><span class="FieldInfo">Post:</span></label>
                            <textarea class="form-control" name="Post" id="postarea"></textarea>
                        </div>
<!--                        sfirsit post-->

                        <br>
                        <input class="btn btn-success btn-block" type="Submit" name="Submit" value="Adaugă post">
                    </fieldset>
                    <br>
                </form>

            </div>

        </div><!-- end main areea -->
    </div><!-- container-fluid -->
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

