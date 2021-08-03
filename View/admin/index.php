<?php include('partials/menu.php')?>
    <!--main content section start-->
    <div class="main-content">
        <div class="wrapper">
            <h1>Dashboard</h1>
            <div class="center">
            <div class="col-4 text-center">
                <?php
                //count catagory from database
                $query = "SELECT count(id) as member_id FROM tbi_category";
                $result = executeResult($query);
                ?>
                <h1> <?php echo $result[0]['member_id']; ?> </h1>
                <br/>
                Categogys
            </div>
            <div class="col-4 text-center">
            <?php
                //count catagory from database
                $query = "SELECT count(id) as member_id FROM tbl_food";
                $result = executeResult($query);
                ?>
                <h1> <?php echo $result[0]['member_id']; ?> </h1>
                <br/>
                Foods
            </div>
            <div class="col-4 text-center">
            <?php
                //count catagory from database
                $query = "SELECT count(id) as member_id FROM tbl_order";
                $result = executeResult($query);
                ?>
                <h1> <?php echo $result[0]['member_id']; ?> </h1>
                <br/>
                Total Order
            </div>
            <div class="col-4 text-center">
            <?php
                //count catagory from database
                $query = "SELECT sum(total) as Total FROM tbl_order WHERE status = 'Delivered'";
                $result = executeResult($query);
                ?>
                <h1> <?php echo $result[0]['Total']; ?> </h1>
                <br/>
                Revenue Generated
            </div>
            <div class="clear-fix"></div>
            </div>
        </div>
    </div>
    <!--main content section end-->
    <?php include('partials/footer.php') ?>