<div class="container">
    <div class="blog-header">
        <h1>Acesta este blogul meu</h1>
        <p class="lead">blog creat de Gheorghi Verdes</p>
    </div>
    <div class="row">
        <div class="content col-lg-9 col-sm-12">
            <?php
            global $Connection;
            if (isset($_GET["SearchButton"])) {
                $Search = $_GET["Search"];
                $ViewQuery = "SELECT * FROM admin_panel 
                                                    WHERE data LIKE '%$Search%' OR title LIKE '%$Search%'
                                                            OR category LIKE '%$Search%' OR post LIKE '%$Search%'";
            }elseif(isset($_GET['Category'])){
                $Category = $_GET['Category'];
                $ViewQuery = "SELECT *FROM admin_panel WHERE category='$Category' ORDER BY data AND time DESC ";
            }



            elseif(isset($_GET['Page'])){
                $Page = $_GET['Page'];
                if($Page==0){
                    $ShowPostFrom = 0;
                }else{
                    $ShowPostFrom = ($Page*5)-5;
                }
                $ViewQuery="SELECT * FROM admin_panel ORDER BY data AND time DESC LIMIT $ShowPostFrom, 5";

            }else{
                $ViewQuery="SELECT * FROM admin_panel ORDER BY data AND time DESC LIMIT 0, 10";}
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
                <div class="d-flex flex-column justify-content-around col-lg-8 col-sm-12">
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
                </div><?php } ?>
        </div>



        <div class="aside col-lg-3 col-sm-12">
            <div class="card bg-light  mb-3">
                <div class="card-header text-center">Publicitate</div>
                <div class="card-body">
                    <h5 class="card-title">Primary card title</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                </div>
            </div>
            <div class="card text-white bg-primary mb-3" >
                <div class="card-header text-center ">Categorii</div>
                <div class="card-body">


                    <?php $categories = getCategories(); foreach ($categories as $category):?>

                        <p class="card-text">
                            <a class="d-block rounded  bg-dark py-1 text-white text-uppercase font-weight-bold text-center text-decoration-none" href="blog.php?Category='$categories'"><?=$category["nume"]?></a>
                        </p>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="card text-white bg-warning mb-3">
                <div class="card-header text-center">Ultimele comentarii</div>
                <div class="card-body">
                    <?php
                    $Connection;
                    if (isset($_GET['id']) && !isset($_GET['id'])) {
                        $Query="SELECT * FROM comments WHERE admin_panel_id='$SortById' AND status= 'ON'
                                                                                        ORDER BY datatime DESC LIMIT 5" ;
                    } else {
                        $Query="SELECT * FROM comments ORDER BY datatime DESC
                                                  LIMIT 5" ;
                    }
                    $Execute=mysqli_query($Connection, $Query);
                    While($DataRows= mysqli_fetch_array($Execute)) {
                        $PersonName = $DataRows["name"];
                        $PersonComment = $DataRows["comment"];
                        if(strlen($PersonComment)>115){$PersonComment=substr($PersonComment,0, 115).'...';}
                        if(strlen($PersonName)>10){$PersonName=substr($PersonName,0, 10).'...';}
                        ?>
                        <p><span><i class="fa fa-comments-o fa-fw" aria-hidden="true"></i></span> <?php echo htmlentities($PersonComment); ?></p>
                    <?php } ?>
                </div>
            </div>
        </div>

    </div>
    <nav>
        <ul class="pagination">
            <?php if($Page>1){ ?>
                <li class="page-item">
                    <a class="page-link" href="blog.php?Page=<?php echo $Page-1; ?>">Precedenta</a>
                </li>
            <?php } ?>
            <?php
            global $Connection;
            $QueryPagination = 'SELECT COUNT(*) FROM admin_panel';
            $ExecutePagination = mysqli_query($Connection,$QueryPagination);
            $RowPagination = mysqli_fetch_array($ExecutePagination);
            $TotalPost = array_shift($RowPagination);
            $PostPagination = $TotalPost/5;
            $PostPagination = ceil($PostPagination);

            for($i=1;$i<=$PostPagination;$i++) {
                if (isset($Page)) {
                    if($i == $Page){
                        ?>
                        <li class="page-item active"><a class="page-link "
                                                        href="blog.php?Page=<?php echo $i; ?>"><?php echo $i; ?></a>
                        </li>
                    <?php } else { ?>
                        <li class="page-item">
                            <a class="page-link" href="blog.php?Page=<?php echo $i; ?>"><?php echo $i; ?></a>
                        </li>
                        <?php
                    }
                }
            }
            ?><?php
            if (isset($Page)) {
                if($Page+1<=$PostPagination){
                    ?>
                    <li class="page-item">
                        <a class="page-link" href="blog.php?Page=<?php echo $Page+1; ?>">Următoarea</a>
                    </li>
                <?php } }?>


        </ul>
    </nav>

</div>
</div>


