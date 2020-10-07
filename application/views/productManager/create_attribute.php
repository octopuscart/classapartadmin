<?php
$this->load->view('layout/layoutTop');
?>

<style>
    .attr_container{}
    .attr_container button{

        margin: 3px;
    }
</style>

<!-- Main content -->
<section class="content" ng-controller="category_attribute">
    <div class="row">

        <!--list of category-->
        <div class='col-md-6'>
            <div class="box box-danger">
                <div class="box-header">
                    <h3 class="box-title">Categories</h3>
                </div>
                <div class="box-body">
                    <div class="col-md-4">
                        <div id="using_json_2" class="demo">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end of list category-->


        <!--add category-->
        <div class='col-md-6'>
            <div class="box box-danger">
                <div class="box-header">
                    <h3 class="box-title">Add/Edit Category Attributes</h3>
                </div>
                <div class="box-body">


                    <form action="#" method="post">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Category</label><br/>
                            <span class='categorystring'><?php echo $category_str; ?></span>

                        </div>
                        <div class="row">


                            <div class="form-group col-md-8">
                                <label for="">Attribute</label>
                                <input  type="text" class="form-control" name="attribute" id="category_name"  placeholder="Category Name" ng-model="selectedCategory.category.category_name">
                            </div>
                            <div class="form-group  col-md-4">
                                <label for="">Display Index</label>
                                <input type="number" class="form-control"  name="display_index" id="description" placeholder="Index" ng-model="selectedCategory.category.description">
                            </div>
                        </div>
                        <button id='submit_button' type="submit" name="submit" class="btn btn-primary" value="{{selectedCategory.operation}}">{{selectedCategory.operation}}</button>
                        <button id='submit_button' type="button"  class="btn btn-warning" ng-click="cencel()">Cancel</button>
                    </form>

                    <div class="col-md-12" style="margin-top: 20px;">
                        <ul class="list-group">
                            <?php
                            foreach ($category_attribute as $key => $value) {
                                $atid = $value->id;
                                $attr = $value->attribute;
                                ?>
                                <li class='list-group-item'>
                                    <?php echo $attr; ?> 
                                    <div class="attr_container">
                                        <?php
                                        $attribuites = $product_model->category_attribute_list($atid);
                                        foreach ($attribuites as $key => $value) {
                                            $atv = $value['attribute_value'];
                                            echo "<button class='btn btn-primary btn-xs'>$atv</button>";
                                        }
                                        ?>
                                        <button class="btn btn-success btn-xs" ng-click="addAttribute('<?php echo $atid; ?>', '<?php echo $attr; ?>')" data-toggle="modal" data-target="#attributeModel">Add New</button>
                                    </div>


                                </li>
                                <?php
                            }
                            ?>
                        </ul>
                    </div>

                </div>

            </div>
        </div>
        <!--end of add category-->

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
</div>


<?php
$this->load->view('layout/layoutFooter');
?> 

<script>
    var jsondata;
    var selectedcategory;

    HASALE.controller('category_attribute', function ($scope, $http, $filter, $timeout) {
        $scope.selectedCategory = {
            "selected": {}, "parents": [],
            "category_string": "Main Category",
            "category": {'parent_id': '0', 'category_name': '', 'description': '', 'id': ''},
            "operation": "Add Category"
        };


        var url = "<?php echo base_url(); ?>index.php/ProductManager/category_api";
        $http.get(url).then(function (rdata) {
            $scope.categorydata = rdata.data;
            $('#using_json_2').jstree({'core': {
                    'data': $scope.categorydata.tree
                }});
        })

        $scope.resetData = function () {
            $scope.selectedCategory.operation = "Add Category";
            $scope.selectedCategory.category.parent_id = '0';
            $scope.selectedCategory.category.category_name = '';
            $scope.selectedCategory.category.description = '';
        }

        $scope.cencel = function () {
            $scope.resetData();
        }


        $(document).on("click", "[selectcategory]", function (event) {
            var catid = $(this).attr("selectcategory");
            var objdata = $('#using_json_2').jstree('get_node', catid);
            window.location = "<?php echo base_url(); ?>index.php/ProductManager/createAttribute/" + catid;
        })

        //edit data
        $scope.editCategory = function (cid) {
            console.log($scope.selectedCategory.selected.id);
            $scope.selectedCategory.operation = "Edit";
            var cobj = $scope.categorydata.list[$scope.selectedCategory.selected.id];
            $scope.selectedCategory.category.parent_id = cobj.id;
            $scope.selectedCategory.category.category_name = cobj.text;
            $scope.selectedCategory.category.description = cobj.description;
        }
        //edit data



        //delete data
        $scope.deleteData = function (cateid) {
            var url = "<?php echo base_url(); ?>index.php/ProductManager/categorie_delete/" + cateid;
            $http.get(url).then(function (rdata) {
                window.location.reload();
            })
        }
        //end of delete data

        $scope.attributeSelected = {'id': '', 'title': ''};

        $scope.addAttribute = function (id, attr) {
            $scope.attributeSelected.id = id;
            $scope.attributeSelected.title = attr;
        }


    })


</script>