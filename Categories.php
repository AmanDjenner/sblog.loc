<?php require_once("include/DB.php");?>
<?php require_once("include/Sessions.php");?>
<?php require_once("include/Functions.php");?>
<?php
if(isset($_POST["Submit"])) {
    $Category = mysqli_real_escape_string($Connection, $_POST["Category"]);
    date_default_timezone_set("Moldova/Chisinau");
    $CurrentTime = time();
    $Data = strftime("%d-%b-%Y", $CurrentTime);
    $Time = strftime("%H:%M:%S", $CurrentTime);
    $Data;
    $Time;

    $Admin="Verdes Gheorghi";
    if(empty($Category)) {
        /** @var TYPE_NAME $_SESSION */
        $_SESSION["ErrorMessage"] = "Completati cimpurile!";
        Redirect_to("Categories.php");
    }elseif(strlen($Category)>99) {
        $_SESSION["ErrorMessage"] = "Ati introdus un nume prea mare pentru categorie.";
        Redirect_to("Categories.php");
    }else{


        $Query = "INSERT into category 
                    (data,time,nume,creatorname)
        VALUES
                    ('$Data','$Time','$Category','$Admin')";
        $result=mysqli_query(  $Connection, $Query);
        if ($result){
        $_SESSION["SuccessMessage"] = "Categoria a fost adaugata cu succes.";
        Redirect_to("Categories.php");
        }else{
        $_SESSION["ErrorMessage"] = "Categoria adaugata cu erori.";
        Redirect_to("Categories.php");
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
                <h1>CATEGORII</h1>
                <div><?php
                    echo Message();
                    echo SuccessMessage();
                    ?>
                </div>
            </div>
            <div>
                <form action="Categories.php" method="post">
                    <fieldset>
                        <div class="form-group">
                            <label for="categoryname"><span class="FieldInfo">Nume:</span></label>
                            <input class="form-control" type="text" name="Category" id="categoryname" placeholder="Name" >
                        </div>
                        <br>
                        <input class="btn btn-success btn-block" type="Submit" name="Submit" value="Adaugă categorie">
                    </fieldset>
                    <br>
                </form>
            </div>
            <?php
            $SelCat="SELECT COUNT(*) FROM category";
            $res = mysqli_query($Connection, $SelCat);
            $row = mysqli_fetch_row($res);
            $total_category = $row[0]; // всего записей
            ?>

            <div class="alert-success"><strong>Categorii in total:<?php echo $total_category; ?></strong></div>
            <br>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <tr>
                        <th>ID</th>
                        <th>Data</th>
                        <th>Ora</th>
                        <th>Categorie</th>
                        <th>Autor</th>
                    </tr>
                    <?php
                    $VieWQuery="SELECT  * FROM category ORDER BY data AND time DESC";
                    $Execute=mysqli_query($Connection, $VieWQuery);
                    $SRno=0;

                    While($DataRows=mysqli_fetch_array( $Execute)){
                        $Id=$DataRows["id"];
                        $Data=$DataRows["data"];
                        $Time=$DataRows["time"];
                        $Nume=$DataRows["nume"];
                        $CreatorName=$DataRows["creatorname"];
                        $SRno++
                    ?>
                    <tr>
                        <td><?php echo $SRno; ?></td>
                        <td><?php echo $Data; ?></td>
                        <td><?php echo $Time; ?></td>
                        <td><?php echo $Nume; ?></td>
                        <td><?php echo $CreatorName; ?></td>
                    </tr>
                    <?php } ?>
                </table>
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