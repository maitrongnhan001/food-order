<?php include('Layout/menu.php'); ?>

<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search text-center">
    <div class="container">

        <form action= <?php echo SITEURL.'food-search.php'; ?> method="POST">
            <input type="search" name="search" placeholder="Search for Food.." required>
            <input type="submit" name="submit" value="Search" class="btn btn-primary">
        </form>

    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->

<?php
//check order
if (isset($_SESSION['order'])) {
    echo '<br/>'.$_SESSION['order'].'<br/>';
    unset($_SESSION['order']);
}
?>

<!-- CAtegories Section Starts Here -->
<section class="categories">
    <div class="container">
        <h2 class="text-center">Explore Foods</h2>

        <?php
        //Get data from database
        $query = "SELECT * FROM tbi_category WHERE active = 'Yes' AND featured = 'Yes' LIMIT 3";
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

<!-- fOOD MEnu Section Starts Here -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Food Menu</h2>

        <?php
        //Get data from database
        $query = "SELECT * FROM tbl_food WHERE active = 'Yes' AND featured = 'Yes' LIMIT 6";
        $result = executeResult($query);
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

                        <a href= <?php echo SITEURL.'order.php?id='.$id; ?> class="btn btn-primary">Order Now</a>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>

        <div class="clearfix"></div>



    </div>

    <p class="text-center">
        <a href="#">See All Foods</a>
    </p>
</section>
<!-- fOOD Menu Section Ends Here -->
<?php include('Layout/footer.php'); ?>