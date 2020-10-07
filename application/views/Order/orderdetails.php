<?php
$this->load->view('layout/layoutTop');
?>
<style>
    .vendororder{
        background: #fff;
        border-bottom: 2px solid #c5c5c5;
        border-top: 4px solid #000;
    }
    .vendor-text{
        float: left;
        height: 39px;
        /* vertical-align: middle; */
        line-height: 37px;
        font-size: 21px;
        padding-right: 15px;
        border-right: 1px solid #c5c5c5;
        margin-right: 12px;
    }
</style>

<section class="content" style="min-height: auto;">

    <div class="row">
        <!--title row--> 
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Order No.:<?php echo $ordersdetails['order_data']->order_no; ?></h3>
                </div>

                <form role="form" action="#" method="post">
                    <div class="box-body">

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Order Status</label>
                                <select class="form-control" name="status">
                                    <option>Pending</option>
                                    <option>Payment Confirmed</option>
                                    <option>Shipped</option>
                                    <option>Delivered</option>
                                    <option>Complete</option>
                                    <option>Canceled</option>
                                    <option>Returned</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-9">
                            <div class="form-group">
                                <label>Remark</label>
                                <input type="text" class="form-control" placeholder="Enter Message" name="remark" required="">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control" placeholder="Remark for order status" name="description"></textarea>
                            </div>
                        </div>

                    </div>
                    <!--/.box-body--> 

                    <div class="box-footer">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary btn-lg" name="submit" value="submit">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<div class="row">
    <div class="col-md-12">
        <div class="col-md-12">

            <?php
            foreach ($user_order_status as $key => $value) {
                ?>

                <ul class="timeline">
                    <!--timeline time label--> 
                    <li class="time-label">
                        <span class="bg-red">
                            <?php echo $value->c_date; ?>
                        </span>
                    </li>
                    <!--/.timeline-label--> 

                    <!--timeline item--> 
                    <li>
                        <!--timeline icon--> 
                        <i class="fa fa-envelope bg-blue"></i>
                        <div class="timeline-item">
                            <span class="time"><i class="fa fa-clock-o"></i> <?php echo $value->c_time; ?></span>

                            <h3 class="timeline-header"><a href="#"><?php echo $value->status ?></a></h3>

                            <div class="timeline-body">
                                <?php echo $value->remark; ?><br/>
                                <?php echo $value->description; ?>
                            </div>

                            <div class="timeline-footer">
                                <a class="btn btn-danger btn-xs" href="<?php echo site_url('Order/remove_order_status/' . $value->id . "/" . $order_key); ?>"><i class="fa fa-trash"></i> Remove</a>
                            </div>
                        </div>
                    </li>
                    <!--END timeline item--> 

                </ul>

                <?php
            }
            ?>

        </div>
    </div>
</div>

<!-- Main content -->
<section class="content "  style="min-height: auto;">

    <div class="col-md-12">

        <!-- title row -->
        <div class="row">
            <div class="col-xs-12">
                <h2 class="page-header">
                    Class Apart Store.
                    <small class="pull-right">Date: <?php echo $ordersdetails['order_data']->order_date; ?></small>
                </h2>
            </div>
            <!-- /.col -->
        </div>
        <!-- info row -->
        <div class="row invoice-info">
            <div class="col-sm-4 invoice-col">
                To
                <address>
                    <strong><?php echo $ordersdetails['order_data']->name; ?></strong><br>
                    <?php echo $ordersdetails['order_data']->address; ?><br/>
                    <?php echo $ordersdetails['order_data']->state; ?>  <?php echo $ordersdetails['order_data']->city; ?> <?php echo $ordersdetails['order_data']->pincode; ?><br/>
                    <i class="fa fa-phone"></i> <?php echo $ordersdetails['order_data']->contact_no; ?><br>
                    <i class="fa fa-envelope"></i> <?php echo $ordersdetails['order_data']->email; ?>
                </address>
            </div>
            <!-- /.col -->
            <div class="col-sm-4 invoice-col">

            </div>
            <!-- /.col -->
            <div class="col-sm-4 invoice-col">
                <b>Invoice #<?php echo $ordersdetails['order_data']->id; ?></b><br><br/>
                <b>Order No.:</b> <?php echo $ordersdetails['order_data']->order_no; ?><br>
                <b>Date:</b> <?php echo $ordersdetails['order_data']->order_date; ?><br>
                <b>Time:</b>  <?php echo $ordersdetails['order_data']->order_time; ?>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- Table row -->
        <div class="row">
            <div class="col-xs-12 table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr style="font-weight: bold">
                            <td style="width: 20px;text-align: center">S.No.</td>
                            <td colspan="2"  style="text-align: center">Product</td>
                            <td style="text-align: right;width: 100px"">Price<br/><span style="font-size: 10px">(In INR)</span></td>
                            <td style="text-align: right;width: 60px"">Qnty.</td>
                            <td style="text-align: right;width: 100px">Total<br/><span style="font-size: 10px">(In INR)</span></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($vendor_order['vendor'] as $key => $voc) {
                            $vendor = $voc['vendor'];
                            ?>
                            <tr class="vendororder" >
                                <td colspan="3">
                                    <span class="vendor-text">Vendor</span>
                                    <b>
                                        <?php
                                        echo $vendor->vendor_name;
                                        ?>
                                    </b><br/>
                                    <?php
                                    echo $vendor->vendor_email;
                                    ?><br/>
                                </td>
                                <td colspan="2">
                                    <p>   
                                        Status : <b>
                                            <?php
                                            echo $voc['status'];
                                            ?>
                                        </b>
                                        <br/>
                                       
                                            <?php
                                            echo $voc['remark'];
                                            ?>
                                    </p>
                                </td>
                                <td>
                                    <p>   
                                        Sub Order No. : <b>
                                            <?php
                                            echo $vendor->vendor_order_no;
                                            ?>
                                        </b>
                                       
                                    </p>
                                    <a class="btn btn-primary btn-xs" href="<?php echo site_url('Order/vendor_order_details/'.$vendor->id);?>">Process As Vendor</a>
                                </td>
                                
                            </tr>

                            <?php
                            $vendor_total_price = 0;
                            $vendor_total_quntity = 0;
                            foreach ($voc['cart_items'] as $key => $product) {
                                ?>
                                <tr>
                                    <td>
                                        <?php echo $key + 1; ?>
                                    </td>

                                    <td style="width: 60px"> 
                                        <img src=" <?php echo $product->file_name; ?>" style="height: 50px;"/>
                                    </td>

                                    <td style="width: 200px;">
                                        <?php echo $product->title; ?><br/><small><?php echo $product->sku; ?></small>
                                    </td>

                                    <td style="text-align: right">
                                        <?php echo $product->price; ?>
                                    </td>

                                    <td style="text-align: right">
                                        <?php echo $product->quantity; ?>
                                    </td>

                                    <td style="text-align: right;">
                                        <?php echo $product->total_price; ?>
                                    </td>
                                </tr>
                                <?php
                                $vendor_total_price += $product->total_price;
                                $vendor_total_quntity += $product->quantity;
                            }
                            ?>
                            <tr style="font-weight: bold;background: #fff;">
                                <td colspan="4" style="text-align: right;">
                                    Total
                                </td>
                                <td style="text-align: right;">
                                    {{<?php echo $vendor_total_quntity; ?>}}
                                </td>

                                <td style="text-align: right;">
                                    {{<?php echo $vendor_total_price; ?>|currency:' '}}
                                </td>
                            </tr>
                            <?php
                        }
                        ?>



                    </tbody>
                </table>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <div class="row">
            <div class="col-md-12">
                <p class="lead" style="text-align: right">Amount Description</p>

                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <td colspan="3"  rowspan="4" style="font-size: 12px;text-align: right">
                                <b>Total Amount in Words:</b><br/>
                                <span style="text-transform: capitalize"> <?php echo $ordersdetails['order_data']->amount_in_word; ?></span>
                            </td>

                        </tr>
                        <tr style="font-weight: bold;">
                            <td colspan="2" style="text-align: right">Total</td>
                            <td style="text-align: right;width: 60px">{{<?php echo $ordersdetails['order_data']->sub_total_price; ?>|currency:' '}} </td>
                        </tr>
                        <tr  style="font-weight: bold;">
                            <td colspan="2" style="text-align: right">Credit Used</td>
                            <td style="text-align: right;width: 60px">{{<?php echo $ordersdetails['order_data']->credit_price; ?>|currency:' '}} </td>
                        </tr>
                        <tr  style="font-weight: bold;">
                            <td colspan="2" style="text-align: right">Total Amount</td>
                            <td style="text-align: right;width: 60px">{{<?php echo $ordersdetails['order_data']->total_price; ?>|currency:' '}} </td>
                        </tr>

                    </table>
                </div>
            </div>
        </div>
        <!-- /.row -->

        <!-- this row will not appear when printing -->
        <div class="row no-print">
            <div class="col-xs-12">
                <a href="invoice-print.html" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
                <!--<button type="button" class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Submit Payment-->
                </button>
                <!--            <button type="button" class="btn btn-primary pull-right" style="margin-right: 5px;">
                                <i class="fa fa-download"></i> Generate PDF
                            </button>-->
            </div>
        </div>

    </div>

</section>
<!-- /.content -->
<div class="clearfix"></div>








<?php
$this->load->view('layout/layoutFooter');
?> 