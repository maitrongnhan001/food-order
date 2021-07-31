<?php include('partials/menu.php')?>
<div class="main-content">
    <div>
        <h1 class="text-center">Manager Order</h1>
        <br />
        <?php
        if (isset($_SESSION['update'])) {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }
        ?>
        <br /><br /><br />
        <table class="tbl-full">
            <tr>
                <th>S.N.</th>
                <th>Food</th>
                <th>Price</th>
                <th>Qty</th>
                <th>Total</th>
                <th>Order Date</th>
                <th>Status</th>
                <th>Customer Name</th>
                <th>Customer Contact</th>
                <th>Customer email</th>
                <th>Customer Address</th>
                <th>Actions</th>
            </tr>
            <?php
            //Get data from database order food
            $query = "SELECT * FROM tbl_order";
            $result = executeResult($query);
            //Get each item from array order food
            foreach ($result as $index) {
                ?>
                <tr>
                    <td><?php echo $index['id']; ?></td>
                    <td><?php echo $index['food']; ?></td>
                    <td><?php echo $index['price']; ?></td>
                    <td><?php echo $index['qty']; ?></td>
                    <td><?php echo $index['total']; ?></td>
                    <td><?php echo $index['order_date']; ?></td>
                    <td><?php 
                    switch ($index['status']) {
                        case "Ordered" :
                            echo '<label>Ordered</label>';
                            break;
                        case "On Delivery" :
                            echo '<label class = "orange">On Delivery</label>';
                            break;
                        case "Delivered":
                            echo '<label class = "green">Delivered</label>';
                            break;
                        case "Cancelled":
                            echo '<label class = "red">Cancelled</label>';
                            break;
                    }
                    ?></td>
                    <td><?php echo $index['customer_name']; ?></td>
                    <td><?php echo $index['customer_contact']; ?></td>
                    <td><?php echo $index['customer_email']; ?></td>
                    <td class="text-center"><?php echo $index['customer_address']; ?></td>
                    <td>
                        <a href= <?php echo SITEURL.'admin/update-order.php?id='.$index['id']; ?> class="btn-secondary"><span>Update Order</span></a>
                    </td>
                </tr>
                <?php
            }
            ?>
        </table>
    </div>
</div>
<?php include('partials/footer.php')?>