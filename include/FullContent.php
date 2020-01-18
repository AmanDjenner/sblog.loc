    <?php
    global $Connection;
        if (isset($_GET["SearchButton"])){
            $Search=$_GET["Search"];
            $ViewQuery="SELECT * FROM admin_panel 
                                WHERE data LIKE '%$Search%' OR title LIKE '%$Search%'
                                        OR category LIKE '%$Search%' OR post LIKE '%$Search%'";
        }else{
            $PostIDFromURL=$_GET["id"];
            $ViewQuery="SELECT * FROM admin_panel where id='$PostIDFromURL' ORDER BY data AND time DESC ";}
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
<div class="container">
    <div class="blog-header">
    </div>
    <div class="row">
                <div class="content col-lg-9 col-sm-12">
                    <section>
                                   <div class="d-flex flex-column Small shadow" >
                                       <div class="d-flex flex-lg-row flex-sm-column p-4 my-3 ">
                                           <div class="d-flex flex-column"><h1><?php echo $Title ?></h1>
                                               <p class="lead">
                                                   <strong>Categoria:</strong> <?php echo $Category?>
                                                        <span class="p-2"><i class="fa fa-calendar" ></i></span>
                                                            <strong>Adăugat la:</strong> <?php echo $Data ?></p>
                                               <div class="d-flex flex-row">
                                                   <div class="thumbail d-flex align-items-center justify-content-sm-center p-2 col-lg-4 col-sm-12">
                                                       <img src="Uploads/images/<?php echo $Image ?>" alt="<?php echo $Title ?>">
                                                   </div>
                                                   <div class="d-flex flex-column col-lg-8 col-sm-12">
                                                       <!--                           <div class="title ">-->
                                                       <!--                               <a href="FullPost.php?id=--><?// echo $PostID ?><!-- " class="text-decoration-none text-primary text-uppercase"><h4>--><?php //echo $Title ?><!--</h4></a>-->
                                                       <!--                               <p><b>Categoria:</b> --><?php //echo $Category?><!-- <span class="p-2"><i class="fa fa-calendar" ></i></span> <b>Adăugat la:</b> --><?php //echo $Data ?><!--</p>-->
                                                       <!--                           </div>-->
                                                       <div class="post">
                                                           <p>
                                                               <?php
                                                               echo $Post;

                                                               ?>
                                                           </p>
                                                       </div>
                                               </div>
                                            </div>
                                        </div>
                                   </div>
                                       <div> <hr>
                                           <br>
                                       </div> <div class="d-flex flex-row-reverse justify-content-between  mx-2" ">
                                       <a href="javascript:history.go(-1)"><span class=" btn btn-warning px-5 ">Back</span></a>
                                       <script src="js/JavaScript.js"></script>
                                       <div class="pluso col-8 pb-4" data-background="transparent" data-options="medium,square,line,horizontal,counter,theme=04" data-services="vkontakte,odnoklassniki,facebook,twitter,google,moimir,email,print"></div>
                                    </div>

                            <?php } ?>
                    </section>
        </div>

