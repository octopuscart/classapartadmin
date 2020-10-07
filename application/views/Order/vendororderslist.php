<?php
$this->load->view('layout/layoutTop');
?>

<style>
    .order_box{
        padding: 10px;
        padding-bottom: 11px!important;
        border: 1px solid #c5c5c5;
        background: #fff;

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
    .order_box h6{
        margin-top: 0px;
        margin-bottom: 5px;
    }

    .blog-posts article {
        margin-bottom: 10px;
    }
</style>


<!-- Main content -->
<section class="content">
    <div class="row" style="margin:0px;">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <?php
            $this->load->view('Order/orderdates');
            ?>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="tableData" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (count($orderslist)) {
                                    foreach ($orderslist as $key => $value) {
                                        ?>
                                        <tr>
                                            <td>
                                                <div class="col-md-12  "> 
                                                    <div class="pricing">
                                                        <article class="order_box" style="padding: 10px">
                                                            <div class="col-md-3">
                                                                <h6 style="font-weight: bold;">
                                                                    Order No. #<?php echo $value->vendor_order_no; ?>
                                                                </h6>
                                                                Total Amount: {{<?php echo $value->total_price; ?>|currency:"Rs. "}}
                                                                <br/>
                                                                Total Products: {{<?php echo $value->total_quantity; ?>}}
                                                            </div>
                                                            <div class="col-md-4">
                                                                <h6 style="font-weight: bold;">
                                                                    <?php echo $value->name; ?>
                                                                </h6>
                                                                <span style="border-bottom: 1px solid #c5c5c5;">Email:<?php echo $value->email; ?></span>
                                                                <br/>
                                                                <p style="font-size:12px"><?php echo $value->address; ?> <?php echo $value->city; ?> <?php echo $value->state; ?><p>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <span >
                                                                    <i class="fa fa-calendar"></i> <?php echo $value->c_date; ?>  <?php echo $value->c_time; ?>
                                                                </span><br/>
                                                                Status: <?php echo $value->status; ?>

                                                            </div>
                                                            <div class="col-md-2">
                                                                <a href="<?php echo site_url('order/vendor_order_details/' . $value->id); ?>" class="btn btn-default btn-lg" style="margin: 0px;    float: right;">
                                                                    View Order <i class="fa fa-arrow-right"></i>
                                                                </a>
                                                            </div>
                                                            <div style="clear: both"></div>
                                                        </article>
                                                    </div>
                                                </div>
                                                <div style="clear: both"></div>
                                            </td>
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

                    </div>
                </div>

            </div>
        </div>
    </div>
    
</section>
<!-- /.content -->

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



    $(function () {
        $("#daterangepicker").daterangepicker({
            format: 'YYYY-MM-DD',
            showDropdowns: true,
            showWeekNumbers: true,
            timePicker: false,
            timePickerIncrement: 1,
            timePicker12Hour: true,
            ranges: {
                "Today's": [moment(), moment()],
                "Yesterday's": [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            },
            opens: 'right',
            drops: 'down',
            buttonClasses: ['btn', 'btn-sm'],
            applyClass: 'btn-primary',
            cancelClass: 'btn-default',
            separator: ' to ',
            locale: {
                applyLabel: 'Submit',
                cancelLabel: 'Cancel',
                fromLabel: 'From',
                toLabel: 'To',
                customRangeLabel: 'Custom',
                daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
                monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                firstDay: 1
            }
        }, function (start, end, label) {
            $('input[name=daterange]').val(start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
        });
        $(".data_table").DataTable();
    })

</script>