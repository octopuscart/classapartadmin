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
<!-- Main content -->
<section class="content">
    <div class="">

        <div class="box box-danger">
            <div class="box-header">
                <h3 class="box-title">Add Vendor / Manager </h3>
            </div>
            <div class="box-body">
                <form action="#" method="post" enctype="multipart/form-data">

                    

                   <?php
                   if($message){
                   ?>
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="icon fa fa-ban"></i> Alert!</h4>
                        <?php echo $message;?>
                    </div>
                    <?php 
                   }
                    ?>


                    <div class="row">

                        <div class="col-md-4">
                            <div class="thumbnail">
                                <div class="product_image product_image_back" style="background: url(<?php echo (base_url() . "assets_main/" . default_image); ?>)">
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
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label >User Type</label>
                                        <select name="user_type" class="form-control">
                                            <option>Vendor</option>
                                             <?php if($user_type=='Admin'){;?><
                                            <option>Manager</option>
                                             <?php }?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label >First Name</label>
                                        <input type="text" class="form-control" name="first_name"  placeholder="First Name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label >Last Name</label>
                                        <input type="text" class="form-control"  name="last_name"  placeholder="Last Name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Email address</label>
                                        <input type="email" class="form-control"  name="email" placeholder="Enter email">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Contact No.</label>
                                        <input type="text" class="form-control"  name="contact_no" placeholder="Contact No.">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Address</label>
                                        <textarea class="form-control"  placeholder="Address" name="address"></textarea>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label >City</label>
                                        <input type="text" class="form-control" name="city"  placeholder="City" value="">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label >State</label>
                                        <input type="text" class="form-control"  name="state"  placeholder="State" value="">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Pincode</label>
                                        <input type="text" class="form-control"  name="pincode"  placeholder="Pincode" value="">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <button type="submit" name="submit" class="btn btn-primary">Add User</button>
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

