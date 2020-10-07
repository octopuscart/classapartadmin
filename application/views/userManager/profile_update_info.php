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
        top: -28px;
        left: -8px;
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
    <div class="">

        <div class="box box-danger">
            <div class="box-header">
                <h3 class="box-title">Vendor Id:<?php echo $user_details->email; ?></h3>
            </div>
            <div class="box-body">

                <form action="#" method="post" enctype="multipart/form-data">

                    <div class="row">

                        <div class="col-md-4">
                            <div class="thumbnail">
                                <div class="product_image product_image_back" style="background: url(<?php
                                if ($user_details->image) {
                                    echo base_url() . 'assets_main/userimages/' . $user_details->image;
                                } else {
                                    echo (base_url() . "assets_main/" . default_image);
                                }
                                ?>)">
                                </div>
                                <div class="caption">
                                    <div class="form-group">
                                        <label for="image1">Upload Store Image</label>
                                        <input type="file" name="picture" />           
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
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
                               

                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- end col-6 -->
</div>


<?php
$this->load->view('layout/layoutFooter');
?> 

