

    <?php
    global $Connection;
        if (isset($_POST["Submit"])) {
            $Name = mysqli_real_escape_string($Connection, $_POST["Name"]);
            $Email = mysqli_real_escape_string($Connection, $_POST["Email"]);
            $Comment = mysqli_real_escape_string($Connection, $_POST["Comment"]);
            date_default_timezone_set("Moldova/Chisinau");
            $CurrentTime = time();
            $DataTime = strftime("%d-%b-%Y %H:%M", $CurrentTime);
            $PostID2=$_GET["id"];
            if (empty($Name)|| empty($Email) || empty($Comment)) {
                /** @var TYPE_NAME $_SESSION */
                $_SESSION["ErrorMessage"] = "Completați toate campurile";
            } elseif (strlen($Comment) > 500) {
                $_SESSION["ErrorMessage"] = "Un comentariu nu poate fi mai mare de 500 simboluri";
            } elseif (strlen($Comment) < 10) {
                $_SESSION["ErrorMessage"] = "Un comentariu nu poate fi mai mic de 10 simboluri";
            } else {

                $Query="INSERT INTO comments (datatime,name,email,comment,approveredby,status,admin_panel_id,)
                        VALUES ('$DataTime', '$Name', '$Email','$Comment', 'ApproveredBy', 'OFF','$PostID2',)";
                $Execute = mysqli_query($Connection, $Query);
                if ($Execute) {
                    $_SESSION["SuccessMessage"] = "Comentariul a fost adaugat cu succes.";
//                   Redirect_to("FullPost.php?id={$PostID2}");
                } else {
                    $_SESSION["ErrorMessage"] = "Comentariul nu a fost adaugat.";
/*                    Redirect_to("FullPost.php?id=<?php echo $PostID2; ?>");*/
                }

            }

        }
?><?php
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
<div class="container"><br>
    <div class="blog-header">


    </div>
    <div class="row">

                <div class="content col-lg-9 col-sm-12">
                    <?php
                    echo Message();
                    echo SuccessMessage();
                    ?>
                    <section>
                                   <div class="d-flex flex-column Small shadow" >
                                       <div class="thumbail d-flex align-items-center justify-content-sm-center p-2 col-lg-12 col-sm-12">
                                           <img src="Uploads/images/<?php echo $Image ?>" alt="<?php echo $Title ?>">
                                       </div>
                                       <div class="d-flex flex-lg-row flex-sm-column p-4 my-3 ">

                                           <div class="d-flex flex-column"><h1><?php echo $Title ?></h1>
                                               <p class="lead">
                                                   <strong>Categoria:</strong> <?php echo $Category?>
                                                        <span class="p-2"><i class="fa fa-calendar" ></i></span>
                                                            <strong>Adăugat la:</strong> <?php echo $Data ?></p>
                                               <div class="d-flex flex-column">

                                                   <div class="d-flex flex-column col-lg-12 col-sm-12">
                                                       <!--                           <div class="title ">-->
                                                       <!--                               <a href="FullPost.php?id=--><?// echo $PostID ?><!-- " class="text-decoration-none text-primary text-uppercase"><h4>--><?php //echo $Title ?><!--</h4></a>-->
                                                       <!--                               <p><b>Categoria:</b> --><?php //echo $Category?><!-- <span class="p-2"><i class="fa fa-calendar" ></i></span> <b>Adăugat la:</b> --><?php //echo $Data ?><!--</p>-->
                                                       <!--                           </div>-->
                                                       <div class="post">
                                                           <p>
                                                               <?php echo nl2br($Post); ?>
                                                           </p>
                                                       </div>
                                               </div>
                                            </div>
                                        </div>
                                   </div>
                                       <div> <hr>
                                           <br>
                                       </div> <div class="d-flex flex-row-reverse justify-content-between  mx-2" ">
                                       <a href="javascript:history.go(-1)"><span class=" btn btn-warning px-5 "><< Înapoi</span></a>
                                       <script src="js/JavaScript.js"></script>
                                       <div class="pluso col-8 pb-4" data-background="transparent" data-options="medium,square,line,horizontal,counter,theme=04" data-services="vkontakte,odnoklassniki,facebook,twitter,google,moimir,email,print"></div>
                                    </div>

                            <?php } ?>
                    </section>
                    <br>
                    <br>
                    <span class="FieldInfo">Comentarii</span>
                    <?php
                    $Connection;
                    $PostIDFromComments=$_GET['id'];
                    $ExtatingCommentsQuery="SELECT * FROM comments
                    WHERE admin_panel_id='$PostIDFromComments' AND status='on'";
                        $Execute=mysqli_query($Connection, $ExtatingCommentsQuery);
                    While($DataRows= mysqli_fetch_array($Execute)) {
                        $CommentData = $DataRows["datatime"];
                        $CommenterName = $DataRows["name"];
                        $Comments = $DataRows["comment"];


                    ?>
                    <div class=" d-flex flex-row border border-light rounded" >
                        <img class="float-left p-3" src="../img/avatar/no-avatar.png" alt="no-avatar" width="85px" height="100px">
                       <div class=" CommentBlock d-flex flex-column m-2 rounded " >
                          <div class="mx-3  text-info font-weight-bold"> <span class="text-dark">Nume: </span><?php echo $CommenterName; ?></div>
                           <div class="mx-3 pb-1 text-secondary border-bottom  border-secondary"><span class=" text-dark font-weight-bold">Adăugat la: </span><?php echo $CommentData; ?></div>
                               <div class=" commentbyuser mb-3 mx-3"><?php echo nl2br($Comments);  ?></div>
                       </div>

                    </div> <br>
<?php } ?>

                    <br>
                    <div class="card card-body"">
                    <h5 class="card-title">Adaugă comentariu:</h5>
                        <form action="FullPost.php?id=<?php echo $PostIDFromComments ?>" method="post" enctype="multipart/form-data">
                            <fieldset>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">Nume:</span>
                                    </div>
                                    <input type="text" name="Name" class="form-control" aria-label="<?php
                                    $PostName = $_POST['Name'];
                                    if (isset($PostName)) {
                                        echo $PostName;
                                    }else
                                        echo 'Name';
                                    ?>" aria-label="Name" aria-describedby="basic-addon1">"

                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">E-mail:</span>
                                    </div>
                                    <input type="email" name="Email" class="form-control" placeholder="E-mail" aria-label="E-mail" aria-describedby="basic-addon1">
                                    <?php
                                    $PostEmail = $_POST['email'];
                                    if (isset($PostEmail)) echo $PostEmail;
                                    ?>
                                </div>
                                <script>
                                    var maxCount = 500;
                                    var redCount = 0;
                                    $("#count").text(maxCount);
                                    function getCount() {
                                        var count = maxCount - $("#comentText").val().length;
                                        $("#count").text(count);
                                        if (count <= redCount) {
                                            $(".inform-text").addClass("text-danger");
                                        } else if (count > 0 && $(".inform-text").hasClass("text-danger")) {
                                            $(".inform-text").removeClass("text-danger");

                                            $("#submit-button").removeClass("disabled");

                                        }
                                        if (count <= 0) {
                                            // $("#submit-button").addClass("disabled");
                                            $("#submit-button").attr("disabled", true);

                                        } else if (count > 0 )
                                        {
                                            $("#submit-button").attr("disabled", false);

                                        }
                                    }
                                </script>
                                <p class="inform-text">Количество оставшихся символов: <span id="count"></span></p>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Comentariu:</span>
                                    </div>
                                    <textarea id="comentText" name="Comment" class="form-control" aria-label="coment" oninput="getCount()"> </textarea>
                                </div>

                                <br>
                                <button id="submit-button" class="btn btn-success btn-block " type="Submit"  name="Submit" >Adaugă comentariu</button>


                            </fieldset>
                            <br>
                        </form>

                    </div>
                    </div>
                    </div>
                    </div>


