<?php require_once("include/DB.php");

?>

<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bootstrap</title>
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

                <ulid="side_menu" class="nav nav-pills nav-stacked">
                    <li class=" active dropdown-item"><a  href="dashboard.php">
                        <span class="glyphicon glyphicon-th"></span>
                    Dashboard</a></li>
                    <li><a  href="#">
                    <span class="glyphicon glyphicon-list-alt"></span>
                    Post nou</a></li>
                    <li><a  href="categories.php">
                    <span class="glyphicon glyphicon-tags"></span>
                    Categorii</a></li>
                    <li><a  href="#"><span class="glyphicon glyphicon-user"></span>
                    Utilizatori</a></li>
                    <li><a  href="#">
                    <span class="glyphicon glyphicon-user"></span>
                    Administrator</a></li>
                    <li><a  href="#">
                    <span class="glyphicon glyphicon-comment"></span>
                    Comentarii</a></li>
                    <li><a  href="#">
                    <span class="glyphicon glyphicon-equalizer"></span>
                    Live Blog</a></li>
                    <li><a  href="#">
                    <span class="glyphicon glyphicon-log-out"></span>
                    Iesire</a></li>
                </ul>

             </div><!-- end side areea -->
            <div class="col-sm-10">
            <div class="page-header">
                <h1>CATEGORII</h1>
            </div>
            <div>
                   <form action="categories.php" method="post">
                       <fieldset>
                            <div class="form-group">
                           <label for="categoryname">Name:</label>
                           <input class="form-control" type="text" name="Category" id="categoryname" placeholder="Name" >
                           </div>
                           <br>
                           <input class="btn btn-success btn-block" type="Submit" name="Submit" value="Adaugă categorie">
                        </fieldset>
                        <br>
                   </form>
               </div>
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