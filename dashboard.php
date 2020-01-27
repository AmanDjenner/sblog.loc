<?php require_once("include/Sessions.php");?>
<?php require_once("include/Functions.php");?>
<?php require_once("include/DB.php");?>
<?php Confirm_Login();?>
<?php include "include/adminHeader.php"?>

</div>
</div>
            <?php include "include/adminMeniu.php"?>
<div class="container-fluid">
    <div class="row">

            <div class="panou col-sm-10">
                <div class="page-header">

                    <h1>PANOUL DE ADMINISTRARE</h1>
                    <div>
                        <?php
                             echo Message();
                             echo SuccessMessage();
                         ?>
                    </div>
                </div>
                <div class="table-responsive">
                <table class="table table-striped table-hover align-td">
                    <tr>
                            <th>No</th>
                            <th>Imagine</th>
                            <th >Titlu</th>
                            <th>Data</th>
                            <th>Categorie</th>
                            <th>Autor</th>
                            <th>Comentarii</th>
                            <th>Actiune</th>
                    </tr>
                <?php
                global $Connection;
                $ViewQuery="SELECT * FROM admin_panel ORDER BY data AND time DESC ";
                $Execute=mysqli_query($Connection ,$ViewQuery);
                $SrNo=0;
                While($DataRows= mysqli_fetch_array($Execute)){
                $PostID = $DataRows["id"];
                $Title = $DataRows["title"];
                $Data = $DataRows["data"];
                $Category = $DataRows["category"];
                $Autor = $DataRows["autor"];
                $Image = $DataRows["image"];
                $Post = $DataRows["post"];
                    $SrNo++;
                ?>
                <tr class="justify-content-center ">
                    <td><?php echo $SrNo?></td>
                    <td><img class="img-fluid" src="Uploads/images/<?php echo $Image?>" width="100px" </td>
                    <td class="text-center">
                        <?php
//                            if (strlen($Title)>66){$Title= substr($Title,0,66)."...";}
                               echo $Title;
                        ?>
                    </td>
                    <td width="100px"><?php echo $Data?></td>
                    <td><?php echo $Category?></td>
                    <td class="post-author">
                        <?php echo $Autor?></td>
                    <td>
                        <?php
                        $Connection;
                        $QueryApproved="SELECT COUNT(*) FROM comments WHERE admin_panel_id='$PostID' AND status='ON'";
                        $ExecuteApproved=mysqli_query($Connection,$QueryApproved);
                        $RowsApproved=mysqli_fetch_array($ExecuteApproved);
                        $TotalApproved=array_shift($RowsApproved);

                        ?>
                        <span class="label pull-left label-success">
                        <?php echo $TotalApproved ?>
                        </span>

                        <?php
                        $Connection;
                        $QueryUnApproved="SELECT COUNT(*) FROM comments  WHERE admin_panel_id='$PostID' AND status='OFF'";
                        $ExecuteUnApproved=mysqli_query($Connection,$QueryUnApproved);
                        $RowsUnApproved=mysqli_fetch_array($ExecuteUnApproved);
                        $TotalUnApproved=array_shift($RowsUnApproved);

                            ?>
                        <a href="comments.php?id=<?php echo $PostID?>"><span class="label pull-right label-danger">
                            <?php echo $TotalUnApproved ?></span>
                        </a>





                    </td>
                    <td width="130px">

                        <a href="EditPost.php?Edit=<?php echo $PostID; ?>" target="_blank">
                            <span class="btn btn-warning">
                                <i class="fa fa-pencil" aria-hidden="true"></i></span>
                        </a>
                        <a href="DeletePost.php?id=<?php echo $PostID; ?>" onclick="return confirm('Doriti sa stergeti aceasta postare?')">
                            <span class="btn btn-danger">
                                <i class="fa fa-trash" aria-hidden="true"></i></span>
                        </a>
                        <a href="FullPost.php?id=<?php echo $PostID; ?>" target="_blank">
                            <span class="btn btn-success">
                                <i class="fa fa-eye" aria-hidden="true"></i></span>
                        </a>
                    </td>
                </tr>

                <?php } ?>

                </table></div>
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