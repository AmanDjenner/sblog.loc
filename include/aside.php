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
            <?php
                $categories = getCategories();
                foreach ($categories as $category):
            ?>
                <p class="card-text"><?=$category["nume"]?></p>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="card text-white bg-warning mb-3">
        <div class="card-header text-center">Ultimele comentarii</div>
        <div class="card-body">
                <?php
                $Connection;
                if (isset($_GET['id']) && !isset($_GET['id'])) {
                    $Query="SELECT * FROM comments 
                                    WHERE admin_panel_id='$SortById' AND status= 'ON'
                                    ORDER BY datatime DESC
                                    LIMIT 5" ;
                } else {
                    $Query="SELECT * FROM comments  
                                    WHERE status= 'ON'
                                    ORDER BY datatime DESC
                                    LIMIT 5" ;
                }

                $Execute=mysqli_query($Connection, $Query);
                While($DataRows= mysqli_fetch_array($Execute)) {
                    $PersonName = $DataRows["name"];
                    $PersonComment = $DataRows["comment"];
                    if(strlen($PersonComment)>115){$PersonComment=substr($PersonComment,0, 115).'...';}
                    if(strlen($PersonName)>10){$PersonName=substr($PersonName,0, 10).'...';}
                    ?>
                        <p><?php echo htmlentities($PersonComment); ?></p>
                <?php } ?>
        </div>
    </div>
</div>

</div>
</div>