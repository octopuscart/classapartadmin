<?php
$this->load->view('layout/layoutTop');
?>
<style>
    .product_image{
        height: 200px!important;
    }
    .product_image_back{
        background-size: contain!important;
        background-repeat: no-repeat!important;
        height: 200px!important;
        background-position-x: center!important;
        background-position-y: center!important;
    }
</style>
<style>
    .cartbutton{
        width: 100%;
        padding: 6px;
        color: #fff!important;
    }
    .noti-check1{
        background: #f5f5f5;
        padding: 25px 30px;

        font-weight: 600;
        margin-bottom: 30px;
    }

    .noti-check1 span{
        color: red;
        color: red;
        width: 111px;
        float: left;
        text-align: right;
        padding-right: 13px;
    }

    .noti-check1 h6{
        font-size: 15px;
        font-weight: 600;
    }

    .address_block{
        background: #fff;
        border: 3px solid #d30603;
        padding: 5px 10px;
        margin-bottom: 20px;

    }
    .checkcart {
        border-radius: 50%;
        position: absolute;
        top: -12px;
        left: 2px;
        font-size: 6px;
        padding: 4px;
        background: #fff;
        border: 2px solid green;
    }


    .default{
        border: 2px solid green;
    }

    .default{
        border: 2px solid green;
    }

    .checkcart i{
        color: green;
    }



    .cartdetail_small {
        float: left;
        width: 203px;
    }

</style>

<style>
    .order_box{
        padding: 10px;
        padding-bottom: 11px!important;
        height: 110px;
        border-bottom: 1px solid #c5c5c5;
    }
    .order_box li{
        line-height: 19px!important;
        padding: 7px!important;
        border: none!important;
    }

    .order_box li i{
        float: left!important;
        line-height: 19px!important;
        margin-right: 13px!important;
    }

    .blog-posts article {
        margin-bottom: 10px;
    }
</style>

<!-- Main content -->
<section class="content">

    <div class="row">
        <div class="col-md-3">

            <!-- Profile Image -->
            <div class="box box-primary">
                <div class="box-body box-profile">
                    <img class="profile-user-img img-responsive img-circle" src="<?php
                    if ($user_details->image) {
                        echo base_url() . 'assets_main/userimages/' . $user_details->image;
                    } else {
                        echo (base_url() . "assets_main/" . default_image);
                    }
                    ?>" alt="User profile picture">

                    <h3 class="profile-username text-center"><?php echo $user_details->first_name; ?> <?php echo $user_details->last_name; ?></h3>

                    <p class="text-muted text-center"><?php echo $user_details->user_type; ?></p>

                    <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                            <b>Contact no.</b> <a class="pull-right"><?php echo $user_details->contact_no; ?></a>
                        </li>
                        <li class="list-group-item">
                            <b>Gender</b> <a class="pull-right"><?php echo $user_details->gender; ?></a>
                        </li>
                        <li class="list-group-item">
                            <b>Date Of Birth</b> <a class="pull-right"><?php echo $user_details->birth_date; ?></a>
                        </li>
                        <li class="list-group-item">
                            <b>Registration Date</b> <a class="pull-right"><?php echo $user_details->op_date_time; ?></a>
                        </li>
                    </ul>


                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->


        </div>
        <!-- /.col -->
        <div class="col-md-9">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a href="#activity" data-toggle="tab">Orders</a>
                    </li>
                    <li>
                        <a href="#settings" data-toggle="tab">Update Profile</a>
                    </li>
                    <li>
                        <a href="#timeline" data-toggle="tab">Address</a>
                    </li>
                    <li>
                        <a href="#creditstatement" data-toggle="tab">Credit Statement</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="active tab-pane" id="activity">
                        <div class="row">
                            <div class="col-md-12">
                                <?php
                                if (count($orderslist)) {
                                    foreach ($orderslist as $key => $value) {
                                        ?>
                                        <div class="col-md-12  "> 
                                            <div class="pricing">
                                                <article class="order_box" style="padding: 10px">
                                                    <div class="col-md-12">
                                                        <h6 style="font-weight: bold;">
                                                            Order No. #<?php echo $value->order_no; ?>
                                                            <span style="float: right;margin: 0px">
                                                                <i class="fa fa-calendar"></i> <?php echo $value->order_date; ?>  <?php echo $value->order_time; ?>
                                                            </span>
                                                        </h6>
                                                    </div>
                                                    <div class="col-md-4">
                                                        Total Amount: {{<?php echo $value->total_price; ?>|currency:"Rs. "}}
                                                        <br/>
                                                        Total Products: {{<?php echo $value->total_quantity; ?>}}
                                                    </div>
                                                    <div class="col-md-4">
                                                        Status: <?php echo $value->status; ?>

                                                    </div>
                                                    <div class="col-md-4">
                                                        <a href="<?php echo site_url('order/orderdetails/' . $value->order_key); ?>" class="btn btn-inverse btn-small" style="margin: 0px;    float: right;">View Order</a>
                                                    </div>
                                                </article>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                } else {
                                    ?>
                                    <h4><i class="fa fa-warning"></i> No order found</h4>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <!-- /.tab-pane -->

                    <div class="tab-pane" id="timeline">
                        <div class="row">
                            <div class="col-md-12" style="margin-top:25px;">
                                <?php
                                if (count($user_address_details)) {
                                    ?>
                                    <?php
                                    foreach ($user_address_details as $key => $value) {
                                        ?>
                                        <div class="col-md-12">
                                            <?php if ($value['status'] == 'default') { ?> 
                                                <div class="checkcart <?php echo $value['status']; ?> ">
                                                    <i class="fa fa-check fa-2x"></i>
                                                </div>
                                            <?php } ?> 
                                            <div class=" address_block <?php echo $value['status']; ?> ">
                                                <p>
                                                    <?php echo $value['address']; ?>,<br/>
                                                    <?php echo $value['city']; ?>, <?php echo $value['state']; ?> <?php echo $value['pincode']; ?>
                                                </p>

                                            </div>
                                        </div>
                                        <?php
                                    }
                                } else {
                                    ?>
                                    <h4><i class="fa fa-warning"></i> No Shipping Address Found</h4>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>  
                    </div>
                    <!-- /.tab-pane -->

                    <div class="tab-pane" id="settings">
                        <div class="row">

                            <form action="#" method="post" enctype="multipart/form-data">
                                <div class="col-md-12">


                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label >First Name</label>
                                            <input type="text" class="form-control" name="first_name"  placeholder="First Name" value="<?php echo $user_details->first_name; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label >Last Name</label>
                                            <input type="text" class="form-control"  name="last_name"  placeholder="Last Name" value="<?php echo $user_details->last_name; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Email address</label>
                                            <span class="form-control"  ><?php echo $user_details->email; ?></span> 
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Contact No.</label>
                                            <input type="text" class="form-control"  name="contact_no" placeholder="Contact No." value="<?php echo $user_details->contact_no; ?>">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Gender</label>
                                            <input type="text" class="form-control"  name="contact_no" placeholder="Contact No." value="<?php echo $user_details->gender; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Birth Date</label>
                                            <input type="text" class="form-control"  name="contact_no" placeholder="Contact No." value="<?php echo $user_details->birth_date; ?>">
                                        </div>
                                    </div>


                                    <?php
                                    if ($user_details->user_type == 'Vendor') {
                                        ?>


                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Shop/Office Address</label>
                                                <textarea class="form-control"  placeholder="Address" name="address"><?php echo $user_details->address; ?></textarea>
                                            </div>
                                        </div>


                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label >City</label>
                                                <input type="text" class="form-control" name="city"  placeholder="City" value="<?php echo $user_details->city; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label >State</label>
                                                <input type="text" class="form-control"  name="state"  placeholder="State" value="<?php echo $user_details->state; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Pincode</label>
                                                <input type="text" class="form-control"  name="pincode"  placeholder="Pincode" value="<?php echo $user_details->pincode; ?>">
                                            </div>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                    <div class="col-md-12">
                                        <button type="submit" name="submit" class="btn btn-primary">Update Profile</button>
                                        <button type="submit" name="delete_user" class="btn btn-danger pull-right" value="<?php echo $user_details->id; ?>" >Delete User</button>
                                        <button type="submit" name="<?php echo $user_details->status == 'Blocked' ? 'unblock_user' : 'block_user'; ?>" class="btn btn-<?php echo $user_details->status == 'Blocked' ? 'success' : 'warning'; ?> pull-right" value="<?php echo $user_details->id; ?>" style="margin-right: 10px"><?php echo $user_details->status == 'Blocked' ? 'Unblock User' : 'Block User'; ?></button>
                                    </div>
                                </div>
                            </form>
                        </div>


                    </div>
                    <!-- /.tab-pane -->

                    <div class="tab-pane" id="creditstatement">
                        <div class="row">
                            <div class="col-md-12" style="margin-top:25px;">
                                <div class="" >
                                    <h4>Available Credits : <small>Rs.</small> {{<?php echo $user_credits; ?> |currency:" "}}</h4>

                                    <h5 style="    margin-top: 51px;
                                        font-size: 18px;
                                        font-weight: 400">Credits Statement</h5>


                                    <table class="table">
                                        <tr>
                                            <th>S.No.</th>
                                            <th>Date</th>
                                            <th>Time</th>
                                            <th>Credit</th>
                                            <th>Debit</th>
                                            <th>Remark</th>
                                        </tr>
                                        <?php
                                        foreach ($creditlist as $key => $value) {
                                            ?>
                                            <tr>
                                                <td><?php echo $key + 1; ?></td>
                                                <td><?php echo $value->c_date; ?></td>
                                                <td><?php echo $value->c_time; ?></td>
                                                <td>{{<?php echo $value->credit ? $value->credit : 0; ?> |currency:" "}}</td>
                                                <td>{{<?php echo $value->debit ? $value->debit : 0; ?> |currency:" "}}</td>
                                                <td><?php echo $value->remark; ?></td>

                                            </tr>
                                            <?php
                                        }
                                        ?>
                                    </table>
                                </div>
                            </div>
                        </div>  
                    </div>
                    <!-- /.tab-pane -->


                </div>
                <!-- /.tab-content -->
            </div>
            <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

</section>
<!-- /.content -->





<?php
$this->load->view('layout/layoutFooter');
?> 

