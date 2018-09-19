<?php
require_once 'controller/core.php';
//include_once 'models/dashboard.php';
include_once 'includes/head.php';
include_once 'includes/navbar.php';
?>

<div id="wrapper">

    <?php include_once 'includes/sidebar.php'; ?>

    <div id="content-wrapper">

        <div class="container-fluid">
            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="dashboard.php">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Products</li>
            </ol>
            <br>
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="row">
                            <div class="col-md-6">
                                <h3><i class="fas fa-fw fa-list-alt"></i> Manage Products</h3>
                            </div>
                            <div class="col-md-6" >
                                <button class="btn btn-primary float-right button1" data-toggle="modal" id="addProductModalBtn" data-target="#addProductModal"> <i class="fas fa-plus-circle"></i> Add Product </button>
                            </div>
                        </div> <!-- row -->

                        <p><br /></p>

                        <div class="panel-body">
                            <div class="remove-messages"></div>

                            <table class="table table table-sm" id="manageProductTable">
                                <thead class="thead-light">
                                <tr>
                                    <th style="width:10%;">Photo</th>
                                    <th>Product Name</th>
                                    <th>Price</th>
                                    <th>Qt.</th>
                                    <th>Producer</th>
                                    <th>Category</th>
                                    <th>Status</th>
                                    <th style="width:15%;">Actions</th>
                                </tr>
                                </thead>
                            </table>
                            <!-- /table -->

                        </div> <!-- /panel-body -->
                    </div> <!-- /panel -->
                </div> <!-- /col-md-12 -->
            </div> <!-- /row -->
            <p><br /></p>
        </div>
        <!-- /.container-fluid -->

        <!-- Sticky Footer -->
        <footer class="sticky-footer">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright © <?php echo date('Y'); ?> </span><span class="text-primary">Sales Management System</span>
                </div>
            </div>
        </footer>

    </div>
    <!-- /.content-wrapper -->

</div>
<!-- /#wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="logoutModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><i class="fa fa-sign-out-alt"></i> Ready to leave?</h4>
            </div>
            <div class="modal-body">Select "Logout" below if you will end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal"><i class="fa fa-times-circle"></i> Cancel</button>
                <a class="btn btn-primary" href="logout.php"><i class="fa fa-sign-out-alt"></i> Logout</a>
            </div>
        </div>
    </div>
</div>


<!-- Add Product modal -->
<div class="modal fade" id="addProductModal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">

            <form class="form-horizontal" id="submitProductForm" action="controller/createProduct.php" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fa fa-plus-circle"></i> Add Product</h4>
                </div>

                <div class="modal-body" style="max-height:450px; overflow:auto;">

                    <div id="add-product-messages"></div> <!-- for error/success messages -->

                    <div class="form-group"> <!-- product image -->
                        <div class="row">
                            <div class="col-sm-4">
                                <label for="productImage" class="control-label">Image: </label>
                            </div>
                            <div class="col-sm-8">
                                <input type="file" id="productImage" placeholder="Product Image" name="productImage" class="file" required />
                            </div>
                            <div id="kv-avatar-errors-1" class="center-block"></div>
                        </div> <!-- /row -->
                    </div> <!-- /form-group product image -->

                    <div class="form-group"> <!-- Product Name -->
                        <div class="row">
                            <div class="col-sm-4">
                                <label for="productName" class="control-label">Product Name: </label>
                            </div>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="productName" placeholder="Product Name" name="productName" autocomplete="off">
                            </div>
                        </div>
                    </div> <!-- /form-group Product Name -->

                    <div class="form-group"> <!-- quantity -->
                        <div class="row">
                            <div class="col-sm-4">
                                <label for="quantity" class="control-label">Quantity: </label>
                            </div>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="quantity" placeholder="Quantity" name="quantity" autocomplete="off">
                            </div>
                        </div>
                    </div> <!-- / quantity form-group-->

                    <div class="form-group"> <!-- price -->
                        <div class="row">
                            <div class="col-sm-4">
                                <label for="price" class="control-label">Price: </label>
                            </div>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="price" placeholder="Price" name="price" autocomplete="off">
                            </div>
                        </div>
                    </div> <!-- / quantity form-group-->

                    <div class="form-group"> <!-- producer -->
                        <div class="row">
                            <div class="col-sm-4">
                                <label for="producerName" class="control-label">Producer: </label>
                            </div>
                            <div class="col-sm-8">
                                <select class="form-control" id="producerName" name="producerName">
                                    <option value=""></option>
                                    <?php
                                    $sql = "SELECT producer_id, producer_name, producer_active, producer_status FROM producers WHERE producer_status = 1 AND producer_active = 1";
                                    $result = $connect->query($sql);

                                    while($row = $result->fetch_array()) {
                                        echo "<option value='".$row[0]."'>".$row[1]."</option>";
                                    }

                                    ?>
                                </select>
                            </div>
                        </div>
                    </div> <!-- /form-group-->

                    <div class="form-group"> <!-- category name -->
                        <div class="row">
                            <div class="col-sm-4">
                                <label for="categoryName" class="control-label">Category: </label>
                            </div>
                            <div class="col-sm-8">
                                <select class="form-control" id="categoryName" name="categoryName">
                                    <option value=""></option>
                                    <?php
                                    $sql = "SELECT categories_id, categories_name, categories_active, categories_status FROM categories WHERE categories_status = 1 AND categories_active = 1";
                                    $result = $connect->query($sql);

                                    while($row = $result->fetch_array()) {
                                        echo "<option value='".$row[0]."'>".$row[1]."</option>";
                                    }

                                    ?>
                                </select>
                            </div>
                        </div>
                    </div> <!-- /form-group-->

                    <div class="form-group"> <!-- producer -->
                        <div class="row">
                            <div class="col-sm-4">
                                <label for="productStatus" class="control-label">Status: </label>
                            </div>
                            <div class="col-sm-8">
                                <select class="form-control" id="productStatus" name="productStatus">
                                    <option value="1">Active</option>
                                    <option value="2">Not Active</option>
                                </select>
                            </div>
                        </div>
                    </div> <!-- /form-group-->
                </div> <!-- /modal-body -->

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"> Close</button>
                    <button type="submit" class="btn btn-primary" id="createProductBtn" data-loading-text="Loading..." autocomplete="off"> <i class="fa fa-save"></i> Save </button>
                </div>
                <!-- /modal-footer -->
            </form>
            <!-- /.form -->
        </div>
        <!-- /modal-content -->
    </div>
    <!-- /modal-dailog -->
</div>
<!-- / add category modal -->

<!-- Edit Product modal -->
<div class="modal fade" id="editProductModal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title"><i class="fa fa-plus-circle"></i> Edit Product</h4>
                </div>

                <div class="modal-body" style="max-height:450px; overflow:auto;">

                    <div class="div-loading">
                        <i class="fas fa-spinner fa-pulse fa-3x fa-fw"></i>
                        <span class="sr-only">Loading...</span>
                    </div>

                    <div class="div-result">

                    <form action="controller/editProductImage.php" method="post" id="updateProductImageForm" class="form-horizontal" enctype="multipart/form-data">
                    <br />
                    <div id="edit-productPhoto-messages"></div>

                    <div class="form-group"> <!-- product image preview -->
                        <div class="row">
                            <div class="col-sm-4">
                                <label for="editProductImage" class="control-label">Image: </label>
                            </div>
                            <div class="col-sm-8">
                                <img src="" id="getProductImage" class="thumbnail" style="width:287px;" />
                            </div>
                        </div>
                    </div>


                    <div class="form-group"> <!-- new product image -->
                        <div class="row">
                            <div class="col-sm-4">
                                <label for="editProductImage" class="control-label">New Image: </label>
                            </div>
                            <div class="col-sm-8">
                                <div id="kv-avatar-errors-1" class="center-block"></div>
                                <input type="file" id="editProductImage" placeholder="Product Image" name="editProductImage" class="file" required />
                            </div>
                            <div id="kv-avatar-errors-1" class="center-block"></div>
                        </div> <!-- /row -->
                    </div> <!-- /form-group product image -->

                    <div class="modal-footer editProductPhotoFooter">
<!--                        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="fas fa-close"></i> Close</button>-->
                        <!-- <button type="submit" class="btn btn-success" id="editProductImageBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Save Changes</button> -->
                    </div>
                    </form>
                    <!-- /form -->
                    </div> <!-- /result-->

                    <form class="form-horizontal" id="editProductForm" action="controller/editProduct.php" method="post">
                    <br />
                    <div id="edit-product-messages"></div>

                    <div class="form-group"> <!-- Product Name -->
                        <div class="row">
                            <div class="col-sm-4">
                                <label for="editProductName" class="control-label">Product Name: </label>
                            </div>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="editProductName" placeholder="Product Name" name="editProductName" autocomplete="off">
                            </div>
                        </div>
                    </div> <!-- /form-group Product Name -->

                    <div class="form-group"> <!-- quantity -->
                        <div class="row">
                            <div class="col-sm-4">
                                <label for="editQuantity" class="control-label">Quantity: </label>
                            </div>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="editQuantity" placeholder="Quantity" name="editQuantity" autocomplete="off">
                            </div>
                        </div>
                    </div> <!-- / quantity form-group-->

                    <div class="form-group"> <!-- price -->
                        <div class="row">
                            <div class="col-sm-4">
                                <label for="editPrice" class="control-label">Price: </label>
                            </div>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="editPrice" placeholder="Price" name="editPrice" autocomplete="off">
                            </div>
                        </div>
                    </div> <!-- / quantity form-group-->

                    <div class="form-group"> <!-- producer -->
                        <div class="row">
                            <div class="col-sm-4">
                                <label for="editProducerName" class="control-label">Producer: </label>
                            </div>
                            <div class="col-sm-8">
                                <select class="form-control" id="editProducerName" name="editProducerName">
                                    <option value=""></option>
                                    <?php
                                    $sql = "SELECT producer_id, producer_name, producer_active, producer_status FROM producers WHERE producer_status = 1 AND producer_active = 1";
                                    $result = $connect->query($sql);

                                    while($row = $result->fetch_array()) {
                                        echo "<option value='".$row[0]."'>".$row[1]."</option>";
                                    }

                                    ?>
                                </select>
                            </div>
                        </div>
                    </div> <!-- /form-group-->

                    <div class="form-group"> <!-- category name -->
                        <div class="row">
                            <div class="col-sm-4">
                                <label for="editCategoryName" class="control-label">Category: </label>
                            </div>
                            <div class="col-sm-8">
                                <select class="form-control" id="editCategoryName" name="editCategoryName">
                                    <option value=""></option>
                                    <?php
                                    $sql = "SELECT categories_id, categories_name, categories_active, categories_status FROM categories WHERE categories_status = 1 AND categories_active = 1";
                                    $result = $connect->query($sql);

                                    while($row = $result->fetch_array()) {
                                        echo "<option value='".$row[0]."'>".$row[1]."</option>";
                                    }

                                    ?>
                                </select>
                            </div>
                        </div>
                    </div> <!-- /form-group-->

                    <div class="form-group"> <!-- producer -->
                        <div class="row">
                            <div class="col-sm-4">
                                <label for="editProductStatus" class="control-label">Status: </label>
                            </div>
                            <div class="col-sm-8">
                                <select class="form-control" id="editProductStatus" name="editProductStatus">
                                    <option value="1">Active</option>
                                    <option value="2">Not Active</option>
                                </select>
                            </div>
                        </div>
                    </div> <!-- /form-group-->
                </div> <!-- /modal-body -->

                <div class="modal-footer editProductFooter">
                    <button type="button" class="btn btn-default" data-dismiss="modal"> Close</button>
                    <button type="submit" class="btn btn-primary" id="editProductBtn" data-loading-text="Loading..." autocomplete="off"> <i class="fa fa-save"></i> Save </button>
                </div>
                <!-- /modal-footer -->
            </form>
            <!-- /.form -->
        </div>
        <!-- /modal-content -->
    </div>
    <!-- /modal-dailog -->
</div>
<!-- / edit product modal -->


<!-- Remove product modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeProductModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><i class="fas fa-trash"></i> Remove Product </h4>
            </div>
            <div class="modal-body">
                <div class="removeProductMessages"></div>
                <p>Do you really want to remove ?</p>
            </div>
            <div class="modal-footer removeProductFooter">
                <button type="button" class="btn btn-default" data-dismiss="modal"> Close </button>
                <button type="button" class="btn btn-danger" id="removeProductBtn" data-loading-text="Loading..."> <i class="fas fa-trash"></i> Remove </button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /remove producer -->

<?php
include_once 'includes/footer.php';
include_once 'includes/fileinput.php';
?>

<script src="scripts/lightbox/js/lightbox.js"></script>
<script src="custom/js/products.js"></script>

</body>
</html>
