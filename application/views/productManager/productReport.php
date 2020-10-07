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
</style>
<!-- Main content -->
<section class="content">
    <div class="">

        <div class="box box-danger">
            <div class="box-header">
                <h3 class="box-title">Product Reports</h3>
            </div>
            <div class="box-body">
                <table id="tableData" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th style="width: 20px;">S.N.</th>
                            <th style="width:50px;">Image</th>
                            <th style="width: 75px;">Category</th>
                            <th style="width: 100px;">Product</th>
                            <th style="width: 100px;">Price Desc.</th>
                            <th style="width: 100px;">Seller</th>
                            <th style="width: 75px;">Date Time</th>
                            <th style="width: 75px;">Stock Status</th>
                            <th style="width: 75px;">Edit</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (count($product_data)) {
                            $count = 1;
                            foreach ($product_data as $key => $value) {
                                ?>
                                <tr>
                                    <td><?php echo $count; ?></td>
                                    <td>
                                        <img src="<?php echo base_url(); ?>assets_main/productimages/<?php echo $value['file_name']; ?>" style="height:51px;">
                                    </td>
                                    <td >
                                        <span class="">
                                            <?php
                                            $catarray = $product_model->parent_get($value['category_id']);
                                            echo $catarray['category_string'];
                                            ?>
                                        </span>
                                    </td>
                                    <td >
                                        <span class="product_title  product_text"><?php echo $value['title']; ?></span>
                                        <br/>
                                        <span class="product_description product_text"><?php echo $value['short_description']; ?></span>
                                    </td>
                                    <td>
                                        <span class="price_tag">R:<b><?php echo $value['regular_price']; ?></b></span>
                                        <span class="price_tag">S:<b><?php echo $value['sale_price']; ?></b></span><br/>
                                        <span class="price_tag">P:<b><?php echo $value['price']; ?></b></span>
                                    </td>
                                    <td>
                                        <span class="seller_tag"><b><?php echo $value['first_name']; ?> <?php echo $value['last_name']; ?></b></span>
                                    </td>
                                    <td >
                                        <span class="">
                                            <?php echo $value['op_date_time']; ?>
                                        </span>
                                    </td>
                                    <td >
                                        <span class="">
                                            <?php echo $value['stock_status']; ?>
                                        </span>
                                    </td>
                                    <td >
                                        <a href="<?php echo site_url('ProductManager/edit_product/'.$value['id']); ?>" class="btn btn-danger"><i class="fa fa-edit"></i> Edit</a>
                                    </td>
                                </tr>
                                <?php
                                $count++;
                            }
                        }
                        ?>
                    </tbody>
                </table>
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