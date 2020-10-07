<?php
$this->load->view('layout/layoutTop');
?>
<!-- Main content -->
<section class="content" ng-controller="category_controller">
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
                    <h3 class="box-title">Add/Edit Category</h3>
                </div>
                <div class="box-body">
                

                    <form action="#" method="post">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Parent Category</label><br/>
                            <span class='categorystring'>{{selectedCategory.category_string}}</span>

                            <button id='editbutton' ng-click="editData()" type='button' class='btn btn-default btn-sm cat_button' style='margin-left:15px;'>
                                <i class='fa fa-edit'></i>
                            </button>
                            <a id='deletebutton'  ng-click="deleteData(selectedCategory.selected.id)" ng-if="selectedCategory.selected.children.length == 0"  type='button' class='btn btn-default btn-sm cat_button'>
                                <i class='fa fa-trash'></i>
                            </a>

                            <input type='hidden' id='parent_id' value='0' name='parent_id' ng-model="selectedCategory.category.parent_id">
                        </div>
                        <div class="form-group">
                            <label for="">Category Name</label>
                            <input  type="text" class="form-control" name="category_name" id="category_name"  placeholder="Category Name" ng-model="selectedCategory.category.category_name">
                        </div>
                        <div class="form-group">
                            <label for="">Description</label>
                            <input type="text" class="form-control"  name="description" id="description" placeholder="Description" ng-model="selectedCategory.category.description">
                        </div>
                        <button id='submit_button' type="submit" name="submit" class="btn btn-primary" value="{{selectedCategory.operation}}">{{selectedCategory.operation}}</button>
                        <button id='submit_button' type="button"  class="btn btn-warning" ng-click="cencel()">Cancel</button>

                    </form>
                </div>
            </div>
        </div>
        <!--end of add category-->

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

    HASALE.controller('category_controller', function ($scope, $http, $filter, $timeout) {
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
            var catlist = objdata.parents;

            $scope.resetData();

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
                $("#parent_id").val(objdata.id);
                $scope.selectedCategory.category_string = catsst.join("->")
            }, 100)
        })

        //edit data
        $scope.editData = function () {
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


    })


</script>