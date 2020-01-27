<?php require_once("include/Sessions.php");?>
<?php require_once("include/Functions.php");?>
<?php require_once("include/DB.php");?>
<?php Confirm_Login();?>
<?php
if(isset($_POST["Submit"])) {
    $Category = mysqli_real_escape_string($Connection, $_POST["Category"]);
    date_default_timezone_set("Moldova/Chisinau");
    $CurrentTime = time();
    $Data = strftime("%d-%b-%Y", $CurrentTime);
    $Time = strftime("%H:%M:%S", $CurrentTime);
    $Data;
    $Time;

    $Admin=$_SESSION["UserName"];
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
                        <th>Actiune</th>
                    </tr>
                    <?php
                    global $Connection;
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
                            <td><a href="deleteCategory.php?id=<?php echo $Id; ?>" onclick="return confirm('Doriti sa stergeti aceasta postare?')"><span class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></span></a></td>
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