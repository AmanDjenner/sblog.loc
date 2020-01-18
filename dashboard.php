<?php require_once("include/DB.php");?>
<?php require_once("include/Sessions.php");?>
<?php require_once("include/Functions.php");?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>BootstraP</title>
    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap-theme.min.css" integrity="sha384-6pzBo3FDv/PJ8r2KRkGHifhEocL+1X2rVCTTkUfGk7/0pbek5mMa1upzvWbrUbOZ" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"> -->
    <!-- //<link rel="stylesheet" href="/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="/css/adminstyles.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">


    </head>

<body>
   <div class="container-fluid">
        <div class="row">
            <div class="col-sm-2">

                <h1>Adminka </h1>
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
<!--            navbar-->

<!--            navbar-->
            <div class="col-sm-10">
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
                <table class="table table-striped table-hover">
                    <tr>
                            <th>No</th>
                            <th>Imagine</th>
                            <th>Titlu</th>
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
                <tr class="justify-content-center">
                    <td><?php echo $SrNo?></td>
                    <td><img src="Uploads/images/<?php echo $Image?>" width="35px" height="35px" </td>
                    <td>
                        <?php
                            if (strlen($Title)>66){$Title= substr($Title,0,66)."...";}
                                echo $Title
                        ?>
                    </td>
                    <td width="100px"><?php echo $Data?></td>
                    <td><?php echo $Category?></td>
                    <td class="post-author">
                        <?php echo $Autor?></td>
                    <td>Processing</td>
                    <td>

                        <a href="EditPost.php?Edit=<?php echo $PostID; ?>" target="_blank">
                            <span class="btn btn-warning">
                                <i class="fa fa-pencil" aria-hidden="true"></i></span>
                        </a>
                        <a href="DeletePost.php?id=<?php echo $PostID; ?>">
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