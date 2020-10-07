<?php

function userReportFunction($users) {
    ?>
    <table border="1">
        <thead>
            <tr>
                <th style="width: 20px;">S.N.</th>
                <th style="width: 100px;">Customer Type</th>
                <th style="width: 250px;">Name</th>
                <th style="width: 250px;">Email</th>
                <th style="width: 100px;">Contact No.</th>
                <th style="width: 300px;">Address</th>
                <th style="width: 100px;">City</th>
                <th style="width: 100px;">State</th>
                <th style="width: 100px;">Pincode</th>
                <th style="width: 200px;">Reg. Date Time</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (count($users)) {

                $count = 1;
                foreach ($users as $key => $value) {
                    ?>
                    <tr>
                        <td><?php echo $count; ?></td>
                        <td><?php echo $value->user_type; ?></td>
                        <td><?php echo $value->first_name; ?><?php echo $value->last_name; ?></td>
                        <td><?php echo $value->email; ?></td>
                        <td><?php echo $value->contact_no; ?></td>
                        <td><?php echo $value->address; ?></td>
                        <td><?php echo $value->city; ?></td>
                        <td><?php echo $value->state; ?></td>
                        <td><?php echo $value->pincode; ?></td>  
                        <td><?php echo $value->op_date_time; ?></td>
                    </tr>
                    <?php
                    $count++;
                }
            }
            ?>
        </tbody>
    </table>
    <?php
}
?>

<?php
switch ($user_type) {
    case "vendor":
        userReportFunction($users_vendor);
        break;
    case "customers":
        userReportFunction($users_customer);
        break;
    case "blocked":
        userReportFunction($users_blocked);
        break;
    default:
        userReportFunction($users_all);
}
?>
             