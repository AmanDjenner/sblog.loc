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
    $Data = strftime("%%d-%b-%Y ", $CurrentTime);
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
    <div class="row">
        <div class="col-sm-2">
            <h1>Adminka</h1>

            <ul id="side_menu" class="nav nav-pills nav-stacked">
            <li><a  href="dashboard.php">
                    <span class="glyphicon glyphicon-th"></span>
                    &nbsp;Dashboard</a></li>
            <li><a  href="AddNewPost.php">
                    <span class="glyphicon glyphicon-list-alt"></span>
                    &nbsp;Post nou</a></li>
            <li><a  href="Categories.php">
                    <span class="glyphicon glyphicon-tags"></span>
                    &nbsp;Categorii</a></li>
            <li><a  href="#"><span class="glyphicon glyphicon-user"></span>
                    &nbsp;Utilizatori</a></li>
            <li><a  href="#">
                    <span class="glyphicon glyphicon-user"></span>
                    &nbsp;Administrator</a></li>
            <li><a  href="#">
                    <span class="glyphicon glyphicon-comment"></span>
                    &nbsp;Comentarii</a></li>
            <li><a  href="#">
                    <span class="glyphicon glyphicon-equalizer"></span>
                    &nbsp;Live Blog</a></li>
            <li><a  href="#">
                    <span class="glyphicon glyphicon-log-out"></span>
                    &nbsp;Iesire</a></li>
            </ul>

        </div><!-- end side areea -->
        <div class="col-sm-10">
            <div class="page-header">
                <h1>Update post</h1>
                <div><?php
                    echo Message();
                    echo SuccessMessage();
                    ?>
                </div>
            </div>
                <?php
                    $SerchQueryParsmeter=$_GET['Edit'];
                    $Connection;
                    $Query="SELECT * FROM admin_panel WHERE id='$SerchQueryParsmeter' ";
                    $ExecuteQuery=mysqli_query($Connection, $Query);
                    WHILE ($DataRows=mysqli_fetch_array($ExecuteQuery)){
                        $TitleToUpdated=$DataRows['title'];
                        $CategoryToUpdated=$DataRows['category'];
                        $ImageToUpdated=$DataRows['image'];
                        $PostToUpdated=$DataRows['post'];
                    }
                ?>
            <div>
                <form action="AddNewPost.php" method="post" enctype="multipart/form-data">
                    <fieldset>
                        <div class="form-group">
                            <label for="title"><span class="FieldInfo">Titlu:</span></label>
                            <input class="form-control" type="text" name="Title" id="title" placeholder="Titlu" value="<?php echo $TitleToUpdated ?>" >
                        </div>
<!--                        //inceputul blocului categorie-->
                        <div class="form-group col-lg-4 col-sm-12 ">
                            <span class="FieldInfo"><strong>Categoria postului:<p style="color:#000"><?php echo $CategoryToUpdated ?></p></strong></span>
                            <span class="FieldInfo"  ><strong>Imaginea postului: </strong><img src="Uploads/images/<?php echo $ImageToUpdated ?>" width="120px"></span>

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
                            <label for="imageselect"><span class="FieldInfo">Alege o alta imagine:</span></label>
                                <input type="file" class="form-control" name="Image" id="imageselect" >
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

