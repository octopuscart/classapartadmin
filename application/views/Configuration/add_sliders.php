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
<section class="content" ng-controller="productController">
    <div class="">



        <!-- Custom Tabs -->
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="<?php echo $operation == 'add' ? 'active' : '' ?> ">
                    <a href="#tab_1" data-toggle="tab">Sliders</a>
                </li>
                <li class="<?php echo $operation == 'edit' ? 'active' : '' ?>">
                    <a href="#tab_2" data-toggle="tab">Add New</a>
                </li>

            </ul>
            <div class="tab-content">
                <div class="tab-pane <?php echo $operation == 'add' ? 'active' : '' ?>  " id="tab_1">
                    <div class="row">
                        <?php
                        foreach ($sliders as $key => $value) {
                            ?>
                            <div class="col-md-12">
                                <div class="box box-solid">
                                    <div class="box-body">
                                        <div class="col-md-6">
                                            <img src="<?php echo (base_url() . "assets_main/sliderimages/" . $value->file_name ); ?>" style="    width: 100%;">
                                        </div>
                                        <div class="col-md-5">
                                            <h3>
                                                <?php
                                                echo $value->title;
                                                ?>
                                            </h3>
                                            <p>
                                                <?php
                                                echo $value->line1;
                                                ?>
                                            </p>
                                            <p>
                                                <?php
                                                echo $value->line2;
                                                ?>
                                            </p>
                                            <button class="btn btn-primary" style="margin: 10px;" href=" <?php echo $value->link; ?>">
                                                <?php echo $value->link_text; ?>
                                            </button>

                                            <a  class="btn btn-danger pull-right" href="<?php echo site_url('Configuration/add_sliders/' . $value->id); ?>"><i class="fa fa-edit"></i> Edit</a>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane <?php echo $operation == 'edit' ? 'active' : '' ?> " id="tab_2">

                    <div class="row">

                        <form action="#" method="post" enctype="multipart/form-data">
                            <div class="form-group sliderbox-panel">
                                <div class="col-md-9">
                                    <label >Title</label>
                                    <input type="text" class="form-control" name="title"  placeholder="" value="<?php echo $sliderdata['title']; ?>">
                                </div>
                                <div class="col-md-3">
                                    <label >Title color Code</label>
                                    <input type="text"  name="title_color"  class="form-control my-colorpicker1 colorpicker-element" value="<?php echo $sliderdata['title_color']; ?>">
                                </div>
                            </div>

                            <div class="form-group sliderbox-panel">
                                <div class="col-md-9">
                                    <label >Line 1</label>
                                    <input type="text" class="form-control" name="line1"  placeholder="" value="<?php echo $sliderdata['line1']; ?>">
                                </div>
                                <div class="col-md-3">
                                    <label >Line 1 color Code</label>
                                    <input type="text"  name="line1_color"  class="form-control my-colorpicker1 colorpicker-element" value="<?php echo $sliderdata['line1_color']; ?>">
                                </div>
                            </div>
                            <div class="form-group sliderbox-panel">
                                <div class="col-md-9">
                                    <label >Line 2</label>
                                    <input type="text" class="form-control" name="line2"   placeholder="" value="<?php echo $sliderdata['line2']; ?>">
                                </div>
                                <div class="col-md-3">
                                    <label >Line 2 color Code</label>
                                    <input type="text"  name="line2_color"  class="form-control my-colorpicker1 colorpicker-element" value="<?php echo $sliderdata['line2_color']; ?>">
                                </div>
                            </div>

                            <div class="form-group sliderbox-panel">
                                <div class="col-md-9">
                                    <label >Link</label>
                                    <input type="text" class="form-control" name="link"  placeholder="" value="<?php echo $sliderdata['link']; ?>">
                                </div>
                                <div class="col-md-3">
                                    <label >Link Text</label>
                                    <input type="text" class="form-control" name="link_text"   placeholder="" value="<?php echo $sliderdata['link_text']; ?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12">
                                    <label >Position</label>
                                    <select name="position" class="form-control">
                                        <option selected="<?php echo $sliderdata['position'] == 'left' ? 'true' : ''; ?>">Left</option>
                                        <option selected="<?php echo $sliderdata['position'] == 'right' ? 'true' : ''; ?>">Right</option>
                                    </select>
                                </div>

                            </div>

                            <div style="clear: both"></div>
                            <!--pictures-->
                            <div style="margin-top:10px;">

                                <div class="row" style="margin: 0px;">
                                    <div class="col-md-3">
                                        <div class="thumbnail">
                                            <?php if ($operation == 'edit') { ?>
                                            <input type="hidden" name="slider_id" value="<?php echo $sliderdata['id'];?>">
                                                <div class="product_image product_image_back" style="background: url(<?php echo (base_url() . "assets_main/sliderimages/" . $sliderdata['file_name'] ); ?>)">

                                                    <?php
                                                } else {
                                                    ?>
                                                    <div class="product_image product_image_back" style="background: url(<?php echo (base_url() . "assets_main/" . default_image); ?>)">

                                                        <?php
                                                    }
                                                    ?> 

                                                </div>
                                                <div class="caption">
                                                    <div class="form-group">
                                                        <label for="image1">Upload Primary Image</label>
                                                        <input type="file" name="picture" />           
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>

                                </div>
                                <!--pictures-->


                        </form>

                    </div>
                </div>
                <!-- /.tab-pane -->

            </div>
            <!-- /.tab-content -->
        </div>
        <!-- nav-tabs-custom -->

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
    });

</script>

<script>
    HASALE.controller('productController', function ($scope, $http, $filter, $timeout) {
        $scope.selectedCategory = {'category_string': '', 'category_id': ""};
        var url = "<?php echo base_url(); ?>index.php/ProductManager/category_api";
        $http.get(url).then(function (rdata) {
            $scope.categorydata = rdata.data;
            $('#using_json_2').jstree({'core': {
                    'data': $scope.categorydata.tree
                }});

            $('#using_json_2').bind('ready.jstree', function (e, data) {
                $timeout(function () {
                    $scope.getCategoryString(4);
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


    })




</script>

