<?php require_once("include/DB.php");?>
<?php require_once("include/Sessions.php");?>
<?php require_once("include/Functions.php");?>
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
    $Target="Uploads/images/".basename($Image);

        global $Connection;
        $EditFromURL=$_GET['Edit'];
        $Query = "UPDATE admin_panel SET
                            data='$Data', 
                            time='$Time', 
                            title='$Title', 
                            category='$Category', 
                            autor='$Admin',
                            image='$Image', 
                            post='$Post'
                    where id='$EditFromURL'
                     ";
        $Execute=mysqli_query(  $Connection, $Query);
        move_uploaded_file($_FILES["Image"]["tmp_name"],$Target);
        if ($Execute){
            $_SESSION["SuccessMessage"] = "Postul a fost redactat cu succes.";
            Redirect_to("Dashboard.php");
        }else{
            $_SESSION["ErrorMessage"] = "Postul a fost redactat cu erori.";
            Redirect_to("Dashboard.php");
        }



}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bootstrap</title>
    <link rel="stylesheet" href="css/styles.css">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
    <script src="js/jquery-3.4.1.min.js"></script>
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap-theme.min.css" integrity="sha384-6pzBo3FDv/PJ8r2KRkGHifhEocL+1X2rVCTTkUfGk7/0pbek5mMa1upzvWbrUbOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/adminstyles.css">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>

    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"> -->
    <!-- //<link rel="stylesheet" href="/css/bootstrap.min.css"> -->

</ head>

<body>
<div class="container-fluid">
    <?php include "include/adminMeniu.php"?>
        <div class="panou col-sm-10">
            <div class="page-header">
                <h1>Update post</h1>
                <div><?php
                    echo Message();
                    echo SuccessMessage();
                    ?>
                </div>
            </div>
                <?php
                    $SearchQueryParameter=$_GET['Edit'];
                    $Connection;
                    $Query="SELECT * FROM admin_panel WHERE id='$SearchQueryParameter' ";
                    $ExecuteQuery=mysqli_query($Connection, $Query);
                    WHILE ($DataRows=mysqli_fetch_array($ExecuteQuery)){
                        $TitleToUpdated=$DataRows['title'];
                        $CategoryToUpdated=$DataRows['category'];
                        $ImageToUpdated=$DataRows['image'];
                        $PostToUpdated=$DataRows['post'];
                    }
                ?>
            <div>
                <form action="EditPost.php?Edit=<?php echo $SearchQueryParameter; ?>" method="post" enctype="multipart/form-data">
                    <fieldset>
                        <div class="form-group">
                            <label for="title"><span class="FieldInfo">Titlu:</span></label>
                            <input class="form-control" type="text" name="Title" id="title" placeholder="Titlu" value="<?php echo $TitleToUpdated ?>" >
                        </div>
<!--                        //inceputul blocului categorie-->
                        <div class="form-group col-lg-4 col-sm-12 ">
                            <span class="FieldInfo"><strong>Categoria postului:<p style="color:#000"><?php echo $CategoryToUpdated ?></p></strong></span>
                            <span class="FieldInfo"  ><strong>Imaginea postului: </strong><img src="Uploads/images/<?php echo $ImageToUpdated ?>" width="120px"></span>
                            <span><?php echo $ImageToUpdated ?></span>

                        </div>
<!--                        //sfirsit categorie-->
<!--                        inceput imagine-->
                        <div class="form-group col-sm-12 col-lg-8">
                            <label for="categoryselect"><span class="FieldInfo">Schimba categoria:</span></label>
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
                            <br> <br> <br>
                            <label for="imageSelect"><span class="FieldInfo">Alege o alta imagine:</span></label>
                                <input type="File"  class="form-control" name="Image" id="imageSelect" accept="image/jpeg,image/png,image/gif" >

                        </div>
<!--                        sfirsit imagine-->
<!--                        inceput post-->
                        <div class="form-group ">
                            <label for="postarea"><span class="FieldInfo pt-4">Post:</span></label>
                            <textarea class="form-control" name="Post" id="postarea" >
                                <?php echo $PostToUpdated ?>
                            </textarea>
                        </div>
<!--                        sfirsit post-->

                        <br>
                        <input class="btn btn-success btn-block" type="Submit" name="Submit" value="Update post">
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

