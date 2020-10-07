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

        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Order No.:<b><?php echo $vendor_order->vendor_order_no; ?></b></h3>
                </div>

                <form role="form" action="#" method="post">
                    <div class="box-body">

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Order Status</label>
                                <select class="form-control" name="status" id="order_status">
                                    <option>Pending</option>
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
                                <textarea class="form-control" placeholder="Remark for order status" name="description" required=""></textarea>
                            </div>
                        </div>
                    </div>

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
            foreach ($vendor_order_status as $key => $value) {
                ?>
                <ul class="timeline">
                    <li class="time-label">
                        <span class="bg-red">
                            <?php echo $value->c_date; ?>
                        </span>
                    </li>
                    <li>   
                        <i class="fa fa-envelope bg-blue"></i>
                        <div class="timeline-item">
                            <span class="time"><i class="fa fa-clock-o"></i> <?php echo $value->c_time; ?></span>

                            <h3 class="timeline-header"><a href="#"><?php echo $value->status ?></a></h3>

                            <div class="timeline-body">
                                <?php echo $value->remark; ?><br/>
                                <?php echo $value->description; ?>
                            </div>

                            <div class="timeline-footer">
                                <a class="btn btn-danger btn-xs" href="<?php echo site_url('Order/remove_vendor_order_status/' . $value->id . "/" . $order_details->id); ?>"><i class="fa fa-trash"></i> Remove</a>
                            </div>
                        </div>
                    </li>
                </ul>
                <?php
            }
            ?>
        </div>
    </div>
</div>

<!-- Main content -->
<section class="content "  style="min-height: auto;">
    <div class="col-md-12 box box-default">
        <div class="box-body">
            <!-- title row -->
            <div class="row">
                <div class="col-xs-12">
                    <h2 class="page-header">
                        Class Apart Store.
                        <small class="pull-right">Date: <?php echo $vendor_order->c_date; ?></small>
                    </h2>
                </div>
                <!-- /.col -->
            </div>
            <!-- info row -->
            <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                    To
                    <address>
                        <strong><?php echo $order_details->name; ?></strong><br>
                        <?php echo $order_details->address; ?><br/>
                        <?php echo $order_details->state; ?>  <?php echo $order_details->city; ?> <?php echo $order_details->pincode; ?><br/>
                        <i class="fa fa-phone"></i> <?php echo $order_details->contact_no; ?><br>
                        <i class="fa fa-envelope"></i> <?php echo $order_details->email; ?>
                    </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">

                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                    <b>Invoice #<?php echo $vendor_order->id; ?></b><br><br/>
                    <b>Order No.:</b> <?php echo $vendor_order->vendor_order_no; ?><br>
                    <b>Date:</b> <?php echo $vendor_order->c_date; ?><br>
                    <b>Time:</b>  <?php echo $vendor_order->c_time; ?>
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
                            foreach ($cart_items as $key => $product) {
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
                            }
                            ?>
                            <tr style="font-weight: bold;background: #fff;">
                                <td colspan="4" style="text-align: right;">
                                    Total
                                </td>
                                <td style="text-align: right;">
                                    {{<?php echo $vendor_order->total_quantity; ?>}}
                                </td>
                                <td style="text-align: right;">
                                    {{<?php echo $vendor_order->total_price; ?>|currency:' '}}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- /.col -->
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
    </div>
</section>
<!-- /.content -->
<div class="clearfix"></div>


<?php
$this->load->view('layout/layoutFooter');
?> 

<script>

$(function(){
    $("#order_status").val("<?php echo $cstatus;?>")
})

</script>