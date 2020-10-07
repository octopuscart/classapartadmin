<?php
$this->load->view('layout/layoutTop');
?>
<style>
    .product_text {
        float: left;
        text-overflow: ellipsis;
        white-space: nowrap;
        overflow: hidden;
        width:350px
    }
    .product_title {
        font-weight: 700;
    }
    .price_tag{
        float: left;
        width: 100%;
        border: 1px solid #222d3233;
        margin: 2px;
        padding: 0px 2px;
    }
    .price_tag_final{
        width: 100%;
    }

    .exportdata{
        margin: 15px 0px 0px 0px;
    }
</style>
<!-- Main content -->


<?php

function userReportFunction($users) {
    ?>
    <table id="tableData" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th style="width: 20px;">S.N.</th>
                <th style="width:50px;">Image</th>
                <th style="width: 75px;">Name</th>
                <th style="width: 100px;">Email / Contact No.</th>
                <th style="width: 100px;">Address</th>
                <th style="width: 75px;">Registration Date Time</th>
                <th style="width: 75px;">Edit</th>
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

                        <td>
                            <img src="<?php echo base_url(); ?>assets_main/userimages/<?php echo $value->image; ?>" style="height:51px;">
                        </td>

                        <td>
                            <span class="">
                                <span class="seller_tag"><?php echo $value->first_name; ?><?php echo $value->last_name; ?></span>
                                <br/>
                                <b><?php echo $value->user_type; ?></b>
                            </span>
                        </td>

                        <td>
                            <span class="">
                                <span class="seller_tag">
                                    <?php echo $value->email; ?>
                                </span>
                                <br/>
                                <?php echo $value->contact_no; ?>
                            </span>
                        </td>

                        <td>
                            <span class="" style="font-size: 12px;">
                                <span class="">
                                    <?php echo $value->address; ?>
                                </span>
                                <br/>
                                <?php echo $value->city; ?> <?php echo $value->state; ?> <?php echo $value->pincode; ?>
                            </span>
                        </td>

                        <td>
                            <span class="">
                                <?php echo $value->op_date_time; ?>
                            </span>
                        </td>

                        <td>
                            <a href="<?php echo '../userManager/user_details/' . $value->id; ?>" class="btn btn-danger"><i class="fa fa-eye "></i> View</a>
                        </td>
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


<section class="content">
    <div class="">

        <div class="box box-danger">
            <div class="box-header">
                <h3 class="box-title">Users Reports</h3>
            </div>
            <div class="box-body">

                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#allusers" aria-controls="home" role="tab" data-toggle="tab">All Users</a></li>
                    <li role="presentation"><a href="#vendors" aria-controls="profile" role="tab" data-toggle="tab">Vendors</a></li>
                    <li role="presentation"><a href="#manager" aria-controls="manager" role="tab" data-toggle="tab">Manager</a></li>
                    <li role="presentation"><a href="#customers" aria-controls="messages" role="tab" data-toggle="tab">Customers</a></li>
                    <li role="presentation"><a href="#blockedusers" aria-controls="settings" role="tab" data-toggle="tab">Blocked</a></li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="allusers">
                        <a class="btn btn-success exportdata" href="<?php echo site_url('userManager/user_profile_record_xls/all'); ?>"  targer="_blank">
                            Export Data
                        </a>
                        <div class="" style="padding:20px">
<?php userReportFunction($users_all); ?>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="vendors">
                        <a class="btn btn-success exportdata" href="<?php echo site_url('userManager/user_profile_record_xls/vendor'); ?>"  targer="_blank">
                            Export Data
                        </a>
                        <div class="" style="padding:20px">
<?php userReportFunction($users_vendor); ?>
                        </div>
                    </div>
                    
                    <div role="tabpanel" class="tab-pane" id="manager">
                        <a class="btn btn-success exportdata" href="<?php echo site_url('userManager/user_profile_record_xls/manager'); ?>"  targer="_blank">
                            Export Data
                        </a>
                        <div class="" style="padding:20px">
<?php userReportFunction($users_manager); ?>
                        </div>
                    </div>
                    
                    
                    
                    <div role="tabpanel" class="tab-pane" id="customers">
                        <a class="btn btn-success exportdata" href="<?php echo site_url('userManager/user_profile_record_xls/customers'); ?>"  targer="_blank">
                            Export Data
                        </a>
                        <div class="" style="padding:20px">
<?php userReportFunction($users_customer); ?>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="blockedusers">
                        <a class="btn btn-success exportdata" href="<?php echo site_url('userManager/user_profile_record_xls/blocked'); ?>" targer="_blank">
                            Export Data
                        </a>
                        <div class="" style="padding:20px">
<?php userReportFunction($users_blocked); ?>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
</section>
<!-- end col-6 -->
</div>


<?php
$this->load->view('layout/layoutFooter');
?> 
<script>
    $(function () {

        $('#tableData').DataTable({
//      'paging'      : true,
//      'lengthChange': false,
//      'searching'   : false,
//      'ordering'    : true,
//      'info'        : true,
//      'autoWidth'   : false
        })
    })

</script>