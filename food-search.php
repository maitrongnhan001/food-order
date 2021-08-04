<?php include('Layout/menu.php'); ?>

<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search text-center">
    <div class="container">
        <?php
        //Get data from input search
        if (isset($_POST['search'])) {
            $search = $_POST['search'];
        }
        ?>
        <h2>Foods on Your Search <a href="#" class="text-white"> "<?php echo $search; ?>" </a></h2>

    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->



<!-- fOOD MEnu Section Starts Here -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Food Menu</h2>
        <?php
        //clear search
        $search = clearStringSql($search);
        //Get data from database
        $query = "SELECT * FROM tbl_food WHERE title LIKE '%$search%' OR description LIKE '%$search%'";
        $result = executeResult($query);
        //Get each item from array foods
        //select each item from array foods
        for ($index = 0; $index < count($result); $index += 2) {
            $id = $result[$index]['id'];
            $title = $result[$index]['title'];
            $description = $result[$index]['description'];
            $price = $result[$index]['price'];
            $image_name = $result[$index]['image_name'];
        ?>
            <div class="row">
                <div class="food-menu-box">
                    <?php
                    if ($image_name != "") {
                    ?>
                        <div class="food-menu-img">
                            <img src=<?php echo SITEURL.'images/food/' . $image_name; ?> alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                        </div>
                    <?php
                    } else {
                        echo '<div class="error">No Image.</div>';
                    }
                    ?>

                    <div class="food-menu-desc">
                        <h4><?php echo $title; ?></h4>
                        <p class="food-price"> <?php echo '$' . $price; ?> </p>
                        <p class="food-detail">
                            <?php echo $description; ?>
                        </p>
                        <br>

                        <a href=<?php echo SITEURL.'order.php?id='.$id; ?> class="btn btn-primary">Order Now</a>
                    </div>
                </div>
                <?php
                //fix action $index >= members of array result
                if ($index + 1 >= count($result)) {
                    break;
                }
                $id = $result[$index + 1]['id'];
                $title = $result[$index + 1]['title'];
                $description = $result[$index + 1]['description'];
                $price = $result[$index + 1]['price'];
                $image_name = $result[$index + 1]['image_name'];
                ?>
                <div class="food-menu-box">
                    <?php
                    if ($image_name != "") {
                    ?>
                        <div class="food-menu-img">
                            <img src=<?php echo SITEURL.'images/food/' . $image_name; ?> alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                        </div>
                    <?php
                    } else {
                        echo '<div class="error">No Image.</div>';
                    }
                    ?>

                    <div class="food-menu-desc">
                        <h4><?php echo $title; ?></h4>
                        <p class="food-price"> <?php echo '$' . $price; ?> </p>
                        <p class="food-detail">
                            <?php echo $description; ?>
                        </p>
                        <br>

                        <a href=<?php echo SITEURL.'order.php?id='.$id; ?> class="btn btn-primary">Order Now</a>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>


        <div class="clearfix"></div>



    </div>

</section>
<!-- fOOD Menu Section Ends Here -->

<?php include('Layout/footer.php'); ?>