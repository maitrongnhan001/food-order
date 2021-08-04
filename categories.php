<?php include('Layout/menu.php'); ?>



<!-- CAtegories Section Starts Here -->
<section class="categories">
    <div class="container">
        <h2 class="text-center">Explore Foods</h2>

        <?php
        //Get data from database
        $query = "SELECT * FROM tbi_category WHERE active = 'Yes' AND featured = 'Yes'";
        $result = executeResult($query);
        foreach ($result as $index) {
            $id = $index['id'];
            $image_name = $index['image_name'];
            $title = $index['title'];
        ?>
            <a href= <?php echo SITEURL.'category-foods.php?category_id='.$id.'&title='.$title; ?>>
                <div class="box-3 float-container">
                    <?php
                    if ($image_name != "") {
                    ?>
                        <img src=<?php echo SITEURL.'images/category/' . $image_name; ?> alt="Pizza" class="img-responsive img-curve">
                    <?php
                    } else {
                        echo '<div class="error">No Image.</div>';
                    }
                    ?>

                    <h3 class="float-text text-white"><?php echo $title; ?></h3>
                </div>
            </a>
        <?php
        }
        ?>




        <div class="clearfix"></div>
    </div>
</section>
<!-- Categories Section Ends Here -->


<?php include('Layout/footer.php'); ?>