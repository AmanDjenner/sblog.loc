<div class="container">
    <div class="blog-header">
        <h1>Acesta este blogul meu</h1>
        <p class="lead">blog creat de Gheorghi Verdes</p>
    </div>
    <div class="row">
        <div class="content col-lg-9 col-sm-12">
            <section>
                <?php
                global $Connection;
                    if (isset($_GET["SearchButton"])){
                        $Search=$_GET["Search"];
                        $ViewQuery="SELECT * FROM admin_panel 
                        WHERE data LIKE '%$Search%' OR title LIKE '%$Search%'
                                OR category LIKE '%$Search%' OR post LIKE '%$Search%'";
                    }else{
                $ViewQuery="SELECT * FROM admin_panel ORDER BY data AND time DESC ";}
                $Execute=mysqli_query($Connection ,$ViewQuery);
                While($DataRows= mysqli_fetch_array($Execute)){
                    $PostID = $DataRows["id"];
                    $Data = $DataRows["data"];
                    $Title = $DataRows["title"];
                    $Category = $DataRows["category"];
                    $Autor = $DataRows["autor"];
                    $Image = $DataRows["image"];
                    $Post = $DataRows["post"];
                ?>
                   <div class="d-flex flex-lg-row flex-sm-column p-4 my-3 Small shadow">
                       <div class="thumbail d-flex align-items-center justify-content-sm-center p-2 col-lg-4 col-sm-12">
                           <img src="Uploads/images/<?php echo $Image ?>" alt="">
                       </div>
                       <div class="d-flex flex-column col-lg-8 col-sm-12">
                           <div class="title ">
                               <a href="FullPost.php?id=<? echo $PostID ?> " class="text-decoration-none text-primary text-uppercase"><h4><?php echo $Title ?></h4></a>
                               <p><span></span><b>Categoria:</b> <?php echo $Category?> <span class="p-2"><i class="fa fa-calendar" ></i></span> <b>Adăugat la:</b> <?php echo $Data ?></p>
                           </div>
                           <div class="post">
                               <p>
                                   <?php
                                       echo substr( $Post, 0,250 ).' ...';

                                   ?>
                               </p>
                               <div class="d-flex flex-row-reverse ">
                                   <a href="FullPost.php?id=<? echo $PostID ?>"><span class=" btn btn-success px-5 mr-2">Mai mult &rsaquo;&rsaquo;&rsaquo;</span></a>
                               </div>
                            </div>
                       </div>
                   </div>
                <?php } ?>
            </section>
        </div>

