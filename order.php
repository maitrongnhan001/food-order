<?php include('Layout/menu.php');
//check login
if (isset($_SESSION['username'])) {
    //get username
    $username = $_SESSION['username'];
} else {
    //redirect to login
    header('Location: ' . SITEURL . 'customer/Login.php');
}
if (isset($_GET['id'])) {
    //Get food id
    $food_id = $_GET['id'];
    //Get data of with food id from database
    $query = "SELECT * FROM tbl_food WHERE id = $food_id";
    $result = executeResult($query);
    if (count($result) == 1) {
        //Get data from database
        $title = $result[0]['title'];
        $price = $result[0]['price'];
        $image_name = $result[0]['image_name'];
    } else {
        //Food is not availabe
        //Redirect to home page
        header('Location: ' . SITEURL);
    }
} else {
    //don't get food id
    header('Location: ' . SITEURL);
}
?>

<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search">
    <div class="container">

        <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

        <form action="#" class="order" method="POST">
            <fieldset>
                <legend>Selected Food</legend>

                <div class="food-menu-img">
                    <?php
                    if ($image_name != "") {
                    ?>
                        <img src=<?php echo SITEURL . 'images/food/' . $image_name; ?> alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                    <?php
                    } else {
                        echo '<div class="error">No Image</div>';
                    }
                    ?>
                </div>

                <div class="food-menu-desc">
                    <div class="row">
                        <div class="clearfix">
                            <h3> <?php echo $title; ?> </h3>
                            <p class="food-price"> <?php echo $price; ?> </p>

                            <input type="hidden" name="food" value=<?php echo $title; ?>>
                            <input type="hidden" id="pr" name="price" value=<?php echo $price; ?>>
                        </div>
                        <div class="clearfix total-container">
                            <h3>Total</h3>
                            <p class="food-price" id="rt"> 11</p>
                        </div>
                    </div>

                    <div class="order-label">Quantity</div>
                    <input type="number" id="ipn" name="qty" class="input-responsive" value="1" required>

                </div>

            </fieldset>

            <fieldset>
                <legend>Delivery Details</legend>
                <div class="order-label">Phone Number</div>
                <input type="tel" name="contact" placeholder="E.g. 9843xxxxxx" class="input-responsive" required>

                <div class="order-label">Email</div>
                <input type="email" name="email" placeholder="E.g. hi@vijaythapa.com" class="input-responsive" required>

                <div class="order-label">Address</div>
                <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
            </fieldset>

        </form>

    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->

<?php
require_once('./Debug/Debug.php');
if (isset($_POST['submit'])) {
    //Get data food
    $food = $_POST['food'];
    $price = $_POST['price'];
    $qty = $_POST['qty'];

    $total = $price * $qty;

    $order_date = date('Y-m-d h:i:sa');

    $status = 'Ordered';

    $customer_name = $username;
    $customer_contact = $_POST['contact'];
    $customer_email = $_POST['email'];
    $customer_address = $_POST['address'];
    //store data to database
    $sql = "INSERT INTO tbl_order 
    (
        food,
        price,
        qty,
        total,
        order_date,
        status,
        customer_name,
        customer_contact,
        customer_email,
        customer_address
    ) VALUES 
    (
        '$food',
        '$price',
        $qty,
        $total,
        '$order_date',
        '$status',
        '$customer_name',
        '$customer_contact',
        '$customer_email',
        '$customer_address'
    )";
    // debug($sql);
    $result = execute($sql);

    //check execute database
    if ($result) {
        $_SESSION['order'] = '<div class="success text-center">Food Ordered Successfully</div>';
        header('Location: ' . SITEURL);
    } else {
        $_SESSION['order'] = '<div class="error text-center">Faild to Order Food</div>';
        header('Location: ' . SITEURL);
    }
}

include('Layout/footer.php');
?>