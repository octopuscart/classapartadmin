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
<section class="content" ng-controller="productController" style="min-height: 625px">
    <div class="col-md-6">
        <div class="panel">
            <div class="panel-body" style=";">
                <form action="#" method="post" enctype="multipart/form-data">
                    <div class="col-md-12">
                        <label >Title</label>
                        <input type="text" class="form-control" name="button_title"  placeholder="" value="<?php echo $sliderdata['button_title']; ?>">
                    </div>
                    
                    <div class="col-md-12">
                        <label >Display Index</label>
                        <input type="text"  name="display_index"  class="form-control my-colorpicker1 colorpicker-element" value="<?php echo $sliderdata['display_index']; ?>">
                    </div>


                    <div class="col-md-12" style="margin-top: 10px;">
                        <div class="thumbnail">
                            <?php
                            if ($operation == 'edit') {
                                $imagelinktemp = (base_url() . "assets_main/sliderimages/" . $sliderdata['file_name'] );
                                ?>

                                <input type="hidden" name="button_id" value="<?php echo $sliderdata['id']; ?>">

                                <?php
                            } else {
                                $imagelinktemp = (base_url() . "assets_main/" . default_image);
                            }
                            ?> 
                            <div class="product_image product_image_back" style="background: url(<?php echo $imagelinktemp; ?>)">

                            </div>
                            <div class="caption">
                                <div class="form-group">
                                    <label for="image1">Upload Primary Image</label>
                                    <input type="file" name="picture" />           
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>

                    </div>

      



            </form>

        </div>
    </div>
</div>
<div class="col-md-6">
    <div class="panel">
        <div class="panel-body">

            <table class="table">


                <?php
                foreach ($sliders as $key => $value) {
                    ?>
                    <tr>
                        <td>
                            <img src="<?php echo (base_url() . "assets_main/sliderimages/" . $value->file_name ); ?>" style="   width:50px">

                        </td>
                        <td>
                            <?php
                            echo $value->button_title;
                            ?>
                        </td>
                        <td>
                            <?php
                            echo $value->display_index;
                            ?>
                        </td>
                        <td>
                            <a  class="btn btn-danger pull-right" href="<?php echo site_url('Configuration/add_product_button/' . $value->id); ?>"><i class="fa fa-edit"></i> Edit</a>

                        </td>
                    </tr>
                    <?php
                }
                ?>
            </table>

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
                } else {
                    $("#finalprice").text(rprice);
                    $("#finalprice1").val(rprice);
                    $("#sale_price").val(0)
                }
            } else {
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

