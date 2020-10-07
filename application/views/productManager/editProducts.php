<?php
$this->load->view('layout/layoutTop');
?>
<?php
$session_data = $this->session->userdata('logged_in');
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


    .product_image_back_slider{
        background-size: contain!important;
        background-repeat: no-repeat!important;
        height: 400px!important;
        background-position-x: center!important;
        background-position-y: center!important;
    }

    .tab_title_d{
        font-size: 18px;
        background: #eee!important;
    }

    .checkboxproduct{
        height: 30px;
        width: 30px;
        margin-left: -33px!important;
    }

    .attrval {
        background: #9C27B0;
        color: white;
        padding: 0px 5px;
        background-color: #FF5722;
        border: 1px solid #e13803;

    }
    .attrkey {
        background: #9C27B0;
        color: white;
        padding: 0px 5px;
        background-color: #3F51B5;
        border: 1px solid #e13803;

    }

    .editbutonproduct{
        font-size: 24px;
        color: red;
        position: absolute;
        top: 0px;
        right: 20px;
    }



</style>
<!-- Main content -->
<section class="content" ng-controller="editProductController">
    <div class="">

        <div class="box box-danger">
            <div class="box-header">
                <h3 class="box-title"><?php echo $product_obj->title; ?></h3>
            </div>
            <div class="box-body">
                <form action="#" method="post" enctype="multipart/form-data">

                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a href="#tab_0" data-toggle="tab" class="tab_title_d">Preview</a>
                            </li>
                            <li >
                                <a href="#tab_1" data-toggle="tab" class="tab_title_d">General Information</a>
                            </li>
                            <li><a href="#tab_2" data-toggle="tab" class="tab_title_d">Description</a></li>
                            <li><a href="#tab_3" data-toggle="tab" class="tab_title_d">Images</a></li>
                            <li><a href="#tab_4" data-toggle="tab" class="tab_title_d">Price & Stock Status</a></li>
                            <li><a href="#tab_5" data-toggle="tab" class="tab_title_d">Attributes</a></li>
                            <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
                        </ul>
                        <div class="tab-content">

                            <div class="tab-pane active" id="tab_0">
                                <div class="row">

                                    <div class="col-md-6">
                                        <div id="carousel-generic" class="carousel slide" data-ride="carousel">
                                            <ol class="carousel-indicators">
                                                <li data-target="#carousel-generic" data-slide-to="0" class=""></li>
                                                <li data-target="#carousel-generic" data-slide-to="1" class="active"></li>
                                                <li data-target="#carousel-generic" data-slide-to="2" class=""></li>
                                            </ol>
                                            <div class="carousel-inner">
                                                <div class="item active">
                                                    <div class="product_image product_image_back_slider" style="background: url(<?php echo ($product_obj->file_name ? base_url() . "assets_main/productimages/" . $product_obj->file_name : base_url() . "assets_main/" . default_image); ?>)" style="height:400px!important">
                                                    </div>  
                                                </div>
                                                <div class="item ">
                                                    <div class="product_image product_image_back_slider" style="background: url(<?php echo ($product_obj->file_name1 ? base_url() . "assets_main/productimages/" . $product_obj->file_name1 : base_url() . "assets_main/" . default_image); ?>)"  style="height:400px!important">
                                                    </div>  
                                                </div>
                                                <div class="item">
                                                    <div class="product_image product_image_back_slider" style="background: url(<?php echo ($product_obj->file_name2 ? base_url() . "assets_main/productimages/" . $product_obj->file_name2 : base_url() . "assets_main/" . default_image); ?>)"  style="height:400px!important">
                                                    </div>  
                                                </div>
                                            </div>
                                            <a class="left carousel-control" href="#carousel-generic" data-slide="prev">
                                                <span class="fa fa-angle-left"></span>
                                            </a>
                                            <a class="right carousel-control" href="#carousel-generic" data-slide="next">
                                                <span class="fa fa-angle-right"></span>
                                            </a>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <h3><?php echo $product_obj->title; ?></h3>
                                        <p>SKU:<?php echo $product_obj->sku; ?></p>
                                        <p><?php echo $product_obj->short_description; ?></p>
                                        <h4><small>Price</small> {{<?php echo $product_obj->price; ?>|currency:'Rs.'}}</h4>

                                        <h4><small>Credit Limit </small> {{<?php echo $product_obj->credit_limit | 0; ?>|currency:'Rs.'}}</h4>

                                        <?php
                                        if (count($product_detail_attrs)) {
                                            foreach ($product_detail_attrs as $key => $value) {
                                                ?>
                                                <li style="margin: 5px"><span class="attrkey">
                                                        <?php echo $value['attribute']; ?>
                                                    </span>
                                                    <span class="attrval">
                                                        <?php echo $value['attribute_value']; ?>
                                                    </span>
                                                </li>
                                                <?php
                                            }
                                        }
                                        ?>
                                        <h4><small>Stock Status</small> <?php echo $product_obj->stock_status; ?></h4>

                                    </div>
                                </div>


                            </div>


                            <div class="tab-pane " id="tab_1">

                                <div class="form-group">
                                    <label >SKU</label>
                                    <span class="form-control" ><?php echo $product_obj->sku; ?></span>
                                </div>

                                <div class="form-group">
                                    <label >Title</label>
                                    <input type="text" class="form-control" name="title" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="" value="<?php echo $product_obj->title; ?>">
                                </div>
                                <div class="form-group">
                                    <label >Short Description</label>
                                    <input type="text" class="form-control" name="short_description" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="" value="<?php echo $product_obj->short_description; ?>">
                                </div>
                                <div class="form-group">
                                    <label >Category         </label><br/>
                                    <span class='categorystring'>{{selectedCategory.category_string}}</span>
                                    <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target=".categoryopen" style="margin-left: 21px;">Select Category</button>
                                    <input type="hidden" name="category_name" id="category_id" value="<?php echo $product_obj->category_id; ?>">
                                </div>

                            </div>


                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="tab_2">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Description</label>
                                    <textarea class="form-control"  name="description" style="height:250px" ><?php echo $product_obj->description; ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Video Link</label>
                                    <input type="text" class="form-control price_tag_text" id='regular_price' name="video_link" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="" value="<?php echo $product_obj->video_link; ?>">
                                </div>
                            </div>

                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="tab_3">
                                <!--pictures-->
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="thumbnail">
                                            <div class="product_image product_image_back" style="background: url(<?php echo ($product_obj->file_name ? base_url() . "assets_main/productimages/" . $product_obj->file_name : base_url() . "assets_main/" . default_image); ?>)">
                                            </div>
                                            <div class="caption">
                                                <div class="form-group">
                                                    <label for="image1">Upload Primary Image</label>
                                                    <input type="file" name="picture" />           
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">                           
                                        <div class="thumbnail" >
                                            <div class="product_image product_image_back" style="background: url(<?php echo ($product_obj->file_name1 ? base_url() . "assets_main/productimages/" . $product_obj->file_name1 : base_url() . "assets_main/" . default_image); ?>)">
                                            </div>               
                                            <div class="caption">
                                                <div class="form-group">
                                                    <label for="image1">Upload Image 1</label>
                                                    <input type="file" name="picture1" />           
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">                           
                                        <div class="thumbnail" >
                                            <div class="product_image product_image_back" style="background: url(<?php echo ($product_obj->file_name2 ? base_url() . "assets_main/productimages/" . $product_obj->file_name2 : base_url() . "assets_main/" . default_image); ?>)">
                                            </div>               
                                            <div class="caption">
                                                <div class="form-group">
                                                    <label for="image1">Upload Image 2</label>
                                                    <input type="file" name="picture2" />           
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--pictures-->
                            </div>

                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="tab_4">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label >Regular Price</label>
                                            <input type="number" class="form-control price_tag_text" id='regular_price' name="regular_price" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="" value="<?php echo $product_obj->regular_price; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label >Sale Price</label>
                                            <input type="number" class="form-control price_tag_text" id='sale_price' name="sale_price" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="" value="<?php echo $product_obj->sale_price; ?>"> 
                                        </div>
                                        <div class="form-group">
                                            <label >Final Price</label>
                                            <span class="final_price form-control" id='finalprice'><?php echo $product_obj->price; ?></span>
                                            <input type="hidden" class="form-control price_tag_text" id='finalprice1' name="price" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="" value="<?php echo $product_obj->price; ?>"> 
                                        </div>

                                        <div class="form-group">
                                            <label >Credit Can Used To Buy</label>
                                            <input type="number" class="form-control price_tag_text" id='credit_limit' name="credit_limit"  aria-describedby="emailHelp" placeholder="" value="<?php echo $product_obj->credit_limit; ?>"> 
                                        </div>

                                        <div class="form-group">
                                            <label >Product Availabilities: <?php echo $product_obj->stock_status; ?></label>
                                            <select  name='stock_status' class='form-control'>
                                                <option value='In Stock' <?php echo ($product_obj->stock_status == 'In of Stock' ? 'selected' : ''); ?> >In Stock</option>
                                                <option value='Out of Stock' <?php echo ($product_obj->stock_status == 'Out of Stock' ? 'selected' : ''); ?> >Out of Stock</option>
                                            </select>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!-- /.tab-pane -->


                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="tab_5">
                                <!--product availabilities-->
                                <div class='row'>
                                    <div class="col-md-6" style="margin-top: 20px;">

                                        <ul class="list-group">
                                            <div class="form-group">
                                                <label >Product Keywords For SEO and Searching (Should Separated By ',')</label>
                                                <input type="text" class="form-control" name="keywords" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="" value="<?php echo $product_obj->keywords; ?>">
                                            </div>

                                            <?php
                                            foreach ($category_attribute as $key => $value) {
                                                $atid = $value->id;
                                                $attr = $value->attribute;
                                                $attribuites = $product_model->category_attribute_list($atid);
                                                ?>
                                                <li class='list-group-item'>
                                                    <?php echo $attr; ?> 
                                                    <input type="hidden" name="attr_name[]" value="<?php echo $attr; ?>">
                                                    <input type="hidden" name="attr_id[]" value="<?php echo $atid; ?>">
                                                    <button type="button" class="btn btn-success btn-xs" style="margin-left: 10px" ng-click="addAttribute('<?php echo $atid; ?>', '<?php echo $attr; ?>')" data-toggle="modal" data-target="#attributeModel">Add New</button>

                                                    <select  name='attr_value[]' class='form-control' style="margin-top: 10px;">
                                                        <?php
                                                        foreach ($attribuites as $key => $value) {
                                                            $atv = $value['attribute_value'];
                                                            $atid = $value['attribute_id'];
                                                            $atvid = $value['id'];
                                                            $preatter = $product_attributes[$atid]['attribute_value_id'] == $atvid ? 'selected' : '';
                                                            echo "<option value='$atvid' $preatter>$atv</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </li>
                                                <?php
                                            }
                                            ?>
                                        </ul>
                                    </div>

                                    <?php if ($session_data['user_type'] == 'Admin') { ?>

                                        <div class="col-md-6" style="margin-top: 20px;">

                                            <ul class="list-group">

                                                <div class="checkbox">
                                                    <label style="font-size: 20px;line-height: 31px;">
                                                        <input type="checkbox" class="checkboxproduct" name="home_slider" <?php echo $product_obj->home_slider == "on" ? "checked" : ""; ?>> Show in Home Slider
                                                    </label>
                                                </div>
                                                <hr/>
                                                <div class="checkbox">
                                                    <label style="font-size: 20px;line-height: 31px;">
                                                        <input type="checkbox" class="checkboxproduct" name="home_bottom" <?php echo $product_obj->home_bottom == "on" ? "checked" : ""; ?>> Show in Home Bottom
                                                    </label>
                                                </div>


                                            </ul>
                                        </div>
                                        <?php
                                    }
                                    ?>


                                </div>
                            </div>
                            <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div>

                    <button type="submit" name="editdata" class="btn btn-primary btn-lg">Submit</button>
                </form>

            </div>


        </div>
    </div>


    <!--veriant products-->
    <div class="box box-danger">
        <div class="box-header">
            <h3 class="box-title">
                Products Variant
                <?php
                if (!$product_obj->variant_product_of) {
                    ?>
                    <a class="btn btn-success" href="<?php echo site_url('ProductManager/variant_product/' . $product_obj->id); ?>" style="margin-left: 50px"><i class="fa fa-plus"></i> Add New</a>
                    <?php
                }
                ?>
                <?php
                if ($product_obj->variant_product_of) {
                    ?>
                    <a class="btn btn-success" href="<?php echo site_url('ProductManager/variant_product/' . $product_obj->variant_product_of); ?>" style="margin-left: 50px"><i class="fa fa-plus"></i> Add New</a>
                    <?php
                }
                ?>
            </h3>

        </div>
        <div class="box-body">
            <div class="row">
                <?php
                foreach ($variant_products as $key => $value) {
                    ?>
                    <div class="col-md-3">                           
                        <div class="thumbnail" >
                            <div class="product_image product_image_back" style="background: url(<?php echo ($value->file_name ? base_url() . "assets_main/productimages/" . $value->file_name : base_url() . "assets_main/" . default_image); ?>)">
                            </div>               
                            <div class="caption">

                                <a href="<?php echo site_url('ProductManager/edit_product/' . $value->product_id); ?>" class="editbutonproduct">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <h4 style="font-size: 15px"> <?php echo $value->title; ?></h4>


                                <h4 style="font-size: 15px">{{<?php echo $value->price; ?>|currency:" "}}</h4>
                                <p style="font-size: 12px;"><b>SKU</b>:<?php echo $value->sku; ?></p>
                                <P>
                                    <?php
                                    $attr = $attributefunction->variant_product_attr($value->product_id);
                                    foreach ($attr as $key => $value) {
                                        ?>
                                    <li style="margin: 5px"><span class="attrkey">
                                            <?php echo $value['attribute']; ?>
                                        </span>
                                        <span class="attrval">
                                            <?php echo $value['attribute_value']; ?>
                                        </span>
                                    </li>
                                    <?php
                                }
                                ?>
                                </P>
                            </div>
                        </div>
                    </div>
                <?php }
                ?>
            </div>
        </div>
    </div>
    <!--end of verient products-->


    <?php if ($session_data['user_type'] == 'Admin') { ?>

        <!--related products select-->
        <div class="box box-danger">
            <div class="box-header">
                <h3 class="box-title">
                    Select Related Products
                </h3>
            </div>
            <div class="box-body">
                <form action="#" method="post">
                    <div class="row">
                        <?php
                        foreach ($related_products as $key => $value) {
                            ?>
                            <div class="col-md-6 ">
                                <div class="panel panel-default">
                                    <div class="media" style="    padding: 10px;">
                                        <div class="media-left">
                                            <a href="#">
                                                <img class="media-object" src="<?php echo ($value->file_name ? base_url() . "assets_main/productimages/" . $value->file_name : base_url() . "assets_main/" . default_image); ?>" alt="..." style="    width: auto; height: 93px;">
                                            </a>
                                        </div>
                                        <div class="media-body">
                                            <h4 class="media-heading"><?php echo $value->title; ?></h4>
                                            <p style="font-size: 12px;"><?php echo $value->short_description; ?></p>
                                            <p >{{<?php echo $value->price; ?>|currency:" "}}</p>
                                            <input type="checkbox" name="related_product_id[]" value="<?php echo $value->related_product_id; ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>


                        <?php }
                        ?>
                    </div>
                    <button class="btn btn-danger" type="submit" name="remove_realted_products">Remove Related Products</button>
                </form>
            </div>
        </div>
        <!--end of related products-->


        <!--related products select-->
        <div class="box box-danger">
            <div class="box-header">
                <h3 class="box-title">
                    Select Related Products
                </h3>
            </div>
            <div class="box-body">
                <form action="#" method="post">
                    <div class="row">
                        <?php
                        foreach ($related_products_check as $key => $value) {
                            ?>
                            <div class="col-md-6 ">
                                <div class="panel panel-default">
                                    <div class="media" style="    padding: 10px;">
                                        <div class="media-left">
                                            <a href="#">
                                                <img class="media-object" src="<?php echo ($value->file_name ? base_url() . "assets_main/productimages/" . $value->file_name : base_url() . "assets_main/" . default_image); ?>" alt="..." style="    width: auto; height: 93px;">
                                            </a>
                                        </div>
                                        <div class="media-body">
                                            <h4 class="media-heading"><?php echo $value->title; ?></h4>
                                            <p style="font-size: 12px;"><?php echo $value->short_description; ?></p>
                                            <p >{{<?php echo $value->price; ?>|currency:" "}}</p>
                                            <input type="checkbox" name="related_product_id[]" value="<?php echo $value->product_id; ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>


                        <?php }
                        ?>
                    </div>
                    <button class="btn btn-primary" type="submit" name="add_realted_products">Add Related Products</button>
                </form>
            </div>
        </div>
        <!--end of related products-->
        <?php
    }
    ?>



    <!-- Modal -->
    <div class="modal fade categoryopen" id="category_model">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Select Category</h4>
                </div>
                <div class="modal-body">
                    <div id="using_json_2" class="demo">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="attributeModel" tabindex="-1" role="dialog" aria-labelledby="attributeModel">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <form action="#" method="post">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">{{attributeSelected.title}}</h4>
                    </div>
                    <div class="modal-body">
                        <input type="text" class="form-control" name="attribute_value">
                        <input type="hidden" class="form-control" name="attribute_name" ng-model="attributeSelected.title" value="{{attributeSelected.title}}">
                        <input type="hidden" class="form-control" name="attribute_id" ng-model="attributeSelected.id" value="{{attributeSelected.id}}">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="save_attr" value="save_attr" class="btn btn-primary">Save</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>




</section>
<!-- end col-6 -->


<script src="<?php echo base_url(); ?>assets_main/tinymce/js/tinymce/tinymce.min.js"></script>

<?php
$this->load->view('layout/layoutFooter');
?> 

<script>
                            tinymce.init({selector: 'textarea', plugins: 'advlist autolink link image lists charmap print preview'});
                            $(function () {

                                $(".price_tag_text").keyup(function () {
                                    var rprice = Number($("#regular_price").val());
                                    var sprice = Number($("#sale_price").val());
                                    console.log(sprice, rprice)
                                    if (sprice) {
                                        if (rprice > sprice) {
                                            $("#finalprice").text(sprice);
                                            $("#finalprice1").val(sprice);
                                        }
                                        else {
                                            $("#finalprice").text(rprice);
                                            $("#finalprice1").val(rprice);
                                            $("#sale_price").val(0)
                                        }
                                    }
                                    else {
                                        $("#finalprice").text(rprice);
                                        $("#finalprice1").val(rprice);
                                        $("#sale_price").val(0)
                                    }
                                })


                            })
</script>

<script>
    HASALE.controller('editProductController', function ($scope, $http, $filter, $timeout) {
        $scope.selectedCategory = {'category_string': '', 'category_id': ""};
        var url = "<?php echo base_url(); ?>index.php/ProductManager/category_api";
        $http.get(url).then(function (rdata) {
            $scope.categorydata = rdata.data;
            $('#using_json_2').jstree({'core': {
                    'data': $scope.categorydata.tree,
                }});

            $('#using_json_2').bind('ready.jstree', function (e, data) {
                $timeout(function () {
                    $scope.getCategoryString(<?php echo $product_obj->category_id; ?>);
                }, 100);
            })
        });


        $scope.getCategoryString = function (catid) {
            console.log(catid)
            var objdata = $('#using_json_2').jstree('get_node', catid);
            var catlist = objdata.parents;
            $timeout(function () {
                $scope.selectedCategory.selected = objdata;
                var catsst = [];
                for (i = catlist.length + 1; i >= 0; i--) {
                    var catid = catlist[i];
                    var catstr = $scope.categorydata.list[catid];
                    if (catstr) {
                        catsst.push(catstr.text);
                    }
                }
                catsst.push(objdata.text);
                $("#category_id").val(objdata.id);
                console.log(objdata.id)
                $scope.selectedCategory.category_string = catsst.join("->")
            }, 100)
        }

        $(document).on("click", "[selectcategory]", function (event) {
            var catid = $(this).attr("selectcategory");
            $scope.getCategoryString(catid);
        })

        $scope.attributeSelected = {'id': '', 'title': ''};

        $scope.addAttribute = function (id, attr) {
            $scope.attributeSelected.id = id;
            $scope.attributeSelected.title = attr;
        }


    })




</script>
