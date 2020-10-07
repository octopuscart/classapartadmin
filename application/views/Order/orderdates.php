<form action="#" method="get" class="form-inline">
    <div class="col-md-6">
        <div class="input-group" id="daterangepicker">
            <input type="text" name="daterange" class="form-control dateFormat"  placeholder="click to select the date range" readonly="" style="    background: #FFFFFF;
                   opacity: 1;" value="<?php echo $daterange; ?>">
            <span class="input-group-btn">
                <button class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button>
            </span>
        </div>
        <button class="btn btn-success" type="submit" name="submit" value="searchdata"><i class="fa fa-send"></i> Submit</button>
        <?php
        if ($exportdata == 'yes') {
            ?>
            <a class="btn btn-warning" href="<?php echo site_url("Order/orderslistxls/$daterange"); ?>">Export</a>
            <?php
        }
        ?>
    </div>
    <div class="col-md-6">
        <h4> Orders from <small><?php echo $daterange; ?></small></h4>
    </div>

</form>
