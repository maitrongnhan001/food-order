<?php
include('partials/menu.php');
if (isset($_GET['id'])) {
    //Get id
    $id = $_GET['id'];
    //Get data from database
    $query = "SELECT * FROM tbl_order WHERE id = $id";
    $result = executeResult($query);
    //check result
    if (count($result) == 1) {
        $food = $result[0]['food'];
        $price = $result[0]['price'];
        $qty = $result[0]['qty'];
        $total = $result[0]['total'];
        $order_date = $result[0]['order_date'];
        $status = $result[0]['status'];
        $customer_name = $result[0]['customer_name'];
        $customer_contact = $result[0]['customer_contact'];
        $customer_email = $result[0]['customer_email'];
        $customer_address = $result[0]['customer_address'];
    } else {
        header('Location: '.SITEURL.'admin/manager-order.php');
    }
} else {
    //redirect admin
    header('Location: '.SITEURL.'admin/manager-order.php');
}
?>

<div class="main-content">
    <div class="wrapper">
        <h1 class="text-center">Update Order</h1>

        <br /><br />

        <form action="" method="POST">
            <table class="tbl-30 center">
                <tr>
                    <td>Food Name:</td>
                    <td class="text-center"><?php echo $food; ?></td>
                </tr>
                <tr>
                    <td>Qty:</td>
                    <td>
                        <input type="number" name="qty" class="format-input" value= <?php echo $qty; ?> >
                    </td>
                </tr>
                <tr>
                    <td>Status:</td>
                    <td>
                        <select name="status" class="format-input">
                            <option value="Ordered" <?php 
                            if ($status == "Ordered") {
                                echo 'selected';
                            }
                            ?> >Ordered</option>
                            <option value="On Delivery" <?php 
                            if ($status == "On Delivery") {
                                echo 'selected';
                            }
                            ?> >On Delivery</option>
                            <option value="Delivered" <?php 
                            if ($status == "Delivered") {
                                echo 'selected';
                            }
                            ?> >Delivered</option>
                            <option value="Cancelled" <?php 
                            if ($status == "Cancelled") {
                                echo 'selected';
                            }
                            ?> >Cancelled</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Customer Name:</td>
                    <td>
                        <input type="text" name="customer_name" class="format-input" value= <?php echo "$customer_name"; ?> >
                    </td>
                </tr>
                <tr>
                    <td>Customer Contact:</td>
                    <td>
                        <input type="text" name="customer_contact" class="format-input" value= <?php echo $customer_contact; ?> >
                    </td>
                </tr>
                <tr>
                    <td>Customer Email:</td>
                    <td>
                        <input type="text" name="customer_email" class="format-input" value= <?php echo $customer_email; ?> >
                    </td>
                </tr>
                <tr>
                    <td>Customer Address:</td>
                    <td>
                        <textarea name="customer_address" id="" cols="30" rows="5" class="format-input"> <?php echo $customer_address; ?> </textarea>
                    </td>
                </tr>
            </table>
            <div class="btn-center center"><input type="submit" name="submit" value="Add Admin" class="btn-secondary"></div>
        </form>
    </div>
</div>

<?php
if (isset($_POST['submit'])) {
    //Get data
    $qty = $_POST['qty'];
    
    $total = $qty * $price;
    
    $status = $_POST['status'];

    $customer_name = $_POST['customer_name'];
    $customer_contact = $_POST['customer_contact'];
    $customer_email = $_POST['customer_email'];
    $customer_address = $_POST['customer_address'];

    //execute store data to database
    $query = "UPDATE tbl_order SET
        qty = $qty,
        total = $total,
        status = '$status',
        customer_name = '$customer_name',
        customer_contact = '$customer_contact',
        customer_email = '$customer_email',
        customer_address = '$customer_address' 
    WHERE id = $id";
    require_once('../Debug/Debug.php');
    $result = execute($query);
    //check execute
    if ($result) {
        $_SESSION['update'] = '<div class="success text-center">Update Order is Successfully.</div>';
        header('Location: '.SITEURL.'admin/manager-order.php');
    } else {
        $_SESSION['update'] = '<div class="error text-center">Faild to Update Order.</div>';
        header('Location: '.SITEURL.'admin/manager-order.php');
    }
}
include('partials/footer.php');
?>