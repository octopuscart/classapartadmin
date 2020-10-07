<table border="1">
    <thead>
        <tr>
            <th>Order No.</th>
            <th>Total Price</th>
            <th>Total Quantity</th>
            <th>Total Credits</th>
            <th>Customer Name</th>
            <th>Customer Email</th>
            <th>Contact No.</th>
            <th>Customer Address</th>
            <th>City</th>
            <th>State</th>
            <th>Pincode</th>
            <th>Order Date</th>
            <th>Order Time</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if (count($orderslist)) {
            foreach ($orderslist as $key => $value) {
                ?>
                <tr>
                    <td><?php echo $value->order_no; ?></td>
                    <td><?php echo $value->total_price; ?></td>
                    <td><?php echo $value->total_quantity; ?></td>
                    <td><?php echo $value->credit_price;?></td>
                    <td><?php echo $value->name; ?></td>
                    <td><?php echo $value->email; ?></td>
                    <td><?php echo $value->contact_no; ?></td>
                    <td><?php echo $value->address; ?></td>
                    <td><?php echo $value->city; ?></td>
                    <td><?php echo $value->state; ?></td>
                    <td><?php echo $value->pincode; ?></td>
                    <td><?php echo $value->order_date; ?></td>
                    <td><?php echo $value->order_time; ?></td>
                    <td><?php echo $value->status; ?></td>
                </tr>
                <?php
            }
        } else {
            ?>
        <h4><i class="fa fa-warning"></i> No order found</h4>
        <?php
    }
    ?>

</tbody>
</table>
