<?php require_once("include/Sessions.php");?>
<?php require_once("include/Functions.php");?>
<?php require_once("include/DB.php");?>
<?php Confirm_Login();?>
<?php include "include/adminHeader.php"?>
<div class="container-fluid">
    <div class="row">


            <?php include "include/adminMeniu.php"?>
            <div class="panou col-sm-10">

                <div class="page-header">
                    <div>
                        <?php
                             echo Message();
                             echo SuccessMessage();
                         ?>
                    </div>
                </div>
                <div class="table-responsive">
                    <div>
                        <h1>Comentarii noi</h1>

                        <table class="table table-striped table-hover">
                           <tr>
                               <th>№</th>
                               <th>Data</th>
                               <th>Nume</th>
                               <th>Comentariu</th>
                               <th>Acceptă</th>
                               <th>Șterge</th>
                               <th>Detalii</th>
                           </tr>
                            <?php
                            $SortById=$_GET['id'];
                            $Connection;
                            if (isset($_GET['id'])) {
                                $Query="SELECT * FROM comments 
                                    WHERE admin_panel_id='$SortById' AND status= 'OFF'
                                    ORDER BY datatime DESC" ;
                            } else {
                                $Query="SELECT * FROM comments  
                                    WHERE status= 'OFF'
                                    ORDER BY datatime DESC" ;
                            }

                            $Execute=mysqli_query($Connection, $Query);
                            $SrNo=0;
                            While($DataRows= mysqli_fetch_array($Execute)) {
                                $CommentId = $DataRows["id"];
                                $CommentData = $DataRows["datatime"];
                                $PersonName = $DataRows["name"];
                                $PersonComment = $DataRows["comment"];
                                $CommentedPostId = $DataRows["admin_panel_id"];

                                $SrNo++;
if(strlen($PersonComment)>215){$PersonComment=substr($PersonComment,0, 215).'...';}
if(strlen($PersonName)>10){$PersonName=substr($PersonName,0, 10).'...';}
                            ?>
                            <tr  class="justify-content-center">
                                <td><?php echo htmlentities($SrNo) ; ?></td>
                                <td width="100px"><?php echo htmlentities($CommentData); ?></td>
                                <td class="text-primary"><?php echo htmlentities($PersonName); ?></td>
                                <td><?php echo htmlentities($PersonComment); ?></td>
                                <td><a href="approvedComments.php?id=<? echo $CommentId ?>&post=<? echo $CommentedPostId ?>">
                                        <span class="btn btn-warning"><i class="fa fa-check" aria-hidden="true"></i></span></a></td>

                                <td><a href="dropComments.php?id=<? echo $CommentId ?>">
                                        <span class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></span></a></td>
                                <td><a href="FullPost.php?id=<?php echo $CommentedPostId?>" target="_blank"><span class="btn btn-success"><i class="fa fa-eye" aria-hidden="true"></i></span></a></td>
                            </tr>
                            <?php } ?>
                        </table>
                    </div>
                    <div>
                        <h1>Comentarii acceptate</h1>
                        <table class="table table-striped table-hover">
                            <tr>
                                <th>№</th>
                                <th>Data</th>
                                <th>Nume</th>
                                <th>Comentariu</th>
                                <th>Acceptat de</th>
                                <th>Anulează</th>
                                <th>Șterge</th>
                                <th>Detalii</th>
                            </tr>
                            <?php
                            $Connection;
                            if (isset($_GET['id'])) {
                                $Query="SELECT * FROM comments 
                                    WHERE admin_panel_id='$SortById' AND status= 'ON'
                                    ORDER BY datatime DESC" ;
                            } else {
                                $Query="SELECT * FROM comments  
                                    WHERE status= 'ON'
                                    ORDER BY datatime DESC" ;
                            }

                            $Execute=mysqli_query($Connection, $Query);
                            $SrNo=0;
                            While($DataRows= mysqli_fetch_array($Execute)) {
                                $CommentId = $DataRows["id"];
                                $CommentData = $DataRows["datatime"];
                                $PersonName = $DataRows["name"];
                                $PersonComment = $DataRows["comment"];
                                $ApproveredBy = $DataRows["approveredby"];
                                $CommentedPostId = $DataRows["admin_panel_id"];
                                $SrNo++;
                                if(strlen($PersonComment)>215){$PersonComment=substr($PersonComment,0, 215).'...';}
                                if(strlen($PersonName)>10){$PersonName=substr($PersonName,0, 10).'...';}
                                ?>
                                <tr  class="justify-content-center">
                                    <td><?php echo htmlentities($SrNo) ; ?></td>
                                    <td width="100px"><?php echo htmlentities($CommentData); ?></td>
                                    <td class="text-primary"><?php echo htmlentities($PersonName); ?></td>

                                    <td><?php echo htmlentities($PersonComment); ?></td>
                                    <td class="text-primary"><?php echo htmlentities($ApproveredBy); ?></td>
                                    <td><a href="disApprovedComments.php?id=<? echo $CommentId ?>&post=<? echo $CommentedPostId ?>">
                                            <span class="btn btn-primary"><i class="fa fa-reply" aria-hidden="true"></i></span></a></td>
                                    <td><a href="dropComments.php?id=<? echo $CommentId ?>">
                                            <span class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></span></a></td>
                                    <td><a href="FullPost.php?id=<?php echo $CommentedPostId?>" target="_blank" ><span class="btn btn-success"><i class="fa fa-eye" aria-hidden="true"></i></span></a></td>
                                </tr>
                            <?php } ?>
                        </table>
                    </div>

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