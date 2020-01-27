<div class=" meniu col-sm-2">

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
        <li><a  href="admin.php">
                <span class="glyphicon glyphicon-user"></span>
                &nbsp;Administrator</a></li>
        <li><a  href="comments.php">
                <span class="glyphicon glyphicon-comment"></span>
                &nbsp;Comentarii
                <?php
                $Connection;
                $QueryFullApproved="SELECT COUNT(*) FROM comments WHERE status='OFF'";
                $ExecuteFullApproved=mysqli_query($Connection,$QueryFullApproved);
                $RowsFullApproved=mysqli_fetch_array($ExecuteFullApproved);
                $TotalFullApproved=array_shift($RowsFullApproved);
                if ($TotalFullApproved>0){
                    ?>
                    <span class="label label-danger">
                        <?php echo $TotalFullApproved ?>
                        </span>
                <?php } ?>


            </a></li>
        <li><a  href="#">
                <span class="glyphicon glyphicon-equalizer"></span>
                &nbsp;Live Blog</a></li>
        <li><a  href="Logout.php" onclick="return confirm('Cu sigurață doriți să părăsiți panoul de administrare ?')">
                <span class="glyphicon glyphicon-log-out"></span>
                &nbsp;Iesire</a></li>
    </ul>

</div><!-- end side areea -->