<?php
$this->load->view('layout/layoutTop');
?>

<section class="content" style="min-height: auto;">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-body">
                    <?php
                    $this->load->view('Order/orderdates');
                    ?>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-aqua">
                        <div class="inner">
                            <h3><?php
                                echo $total_order;
                                ?></h3>

                            <p>New Orders</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="<?php echo site_url('Order/orderslist?daterange='.$daterange.'&submit=searchdata');?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-green">
                        <div class="inner">
                            <h3><?php echo $vendor_orders; ?></h3>

                            <p>Vendor Orders</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="<?php echo site_url('Order/orderslistvendor?daterange='.$daterange.'&submit=searchdata');?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-yellow">
                        <div class="inner">
                            <h3><?php echo $total_users; ?></h3>

                            <p>User Registrations</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="<?php echo site_url('UserManager/usersReport');?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-red">
                        <div class="inner">
                            <h3><?php echo $total_amount; ?></h3>

                            <p>Order Amount</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
            </div>
        </div>



        <div class="col-md-6">
            <div class="box box-default">
                <div class="box-header with-border">
                    <i class="fa fa-line-chart"></i>
                    <h3 class="box-title">Order By Date</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 300px;"></div>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <div class="col-md-6">
            <!-- solid sales graph -->
            <div class="box box-solid bg-teal-gradient">
                <div class="box-header">
                    <i class="fa fa-th"></i>

                    <h3 class="box-title">Sales Graph</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn bg-teal btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn bg-teal btn-sm" data-widget="remove"><i class="fa fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body border-radius-none">
                    <div class="chart" id="line-chart" style="height: 300px;"></div>
                </div>
            </div>
            <!-- /.box -->
        </div>


    </div>
</section>



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


            // Sales chart
            var area = new Morris.Area({
            element: 'revenue-chart',
                    resize: true,
                    data: [
<?php
foreach ($order_date_graph as $key => $value) {
    ?>
                        {y: '<?php echo $key; ?>', orders: <?php echo $value; ?>},
    <?php
}
?>
                    ],
                    xkey: 'y',
                    ykeys: ['orders'],
                    labels: ['Total Orders'],
                    lineColors: ['#a0d0e0', '#3c8dbc'],
                    hideHover: 'auto'
            });
            var line = new Morris.Line({
            element: 'line-chart',
                    resize: true,
                    data: [
<?php
foreach ($salesgraph as $key => $value) {
    ?>

                        {y: '<?php echo $key; ?>', item1: <?php echo $value; ?>},
    <?php
}
?>

                    ],
                    xkey: 'y',
                    ykeys: ['item1'],
                    labels: ['Orders'],
                    lineColors: ['#efefef'],
                    lineWidth: 2,
                    hideHover: 'auto',
                    gridTextColor: '#fff',
                    gridStrokeWidth: 0.4,
                    pointSize: 4,
                    pointStrokeColors: ['#efefef'],
                    gridLineColor: '#efefef',
                    gridTextFamily: 'Open Sans',
                    gridTextSize: 10
            });

</script>