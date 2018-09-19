<?php
require_once 'controller/core.php';
//include_once 'models/dashboard.php';
include_once 'includes/head.php';
include_once 'includes/navbar.php';
?>

<div id="page-top">
<div id="wrapper">

    <?php include_once 'includes/sidebar.php'; ?>

    <div id="content-wrapper">

        <div class="container-fluid">
            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="dashboard.php">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Categories</li>
            </ol>
            <br>
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="row">
                            <div class="col-md-6">
                                <h3><i class="fas fa-fw fa-th-list"></i> Manage Categories</h3>
                            </div>
                            <div class="col-md-6" >
                                <button class="btn btn-primary float-right button1" data-toggle="modal" id="addCategoriesModalBtn" data-target="#addCategoriesModal"> <i class="fas fa-plus-circle"></i> Add Category </button>
                            </div>
                        </div> <!-- row -->

                        <p><br /></p>

                        <div class="panel-body">
                            <div class="remove-messages"></div>

                            <table class="table table-sm" id="manageCategoriesTable">
                                <thead class="thead-light">
                                <tr>
                                    <th style="width: 45%;">Category name</th>
                                    <th style="width: 40%;">Status</th>
                                    <th style="width: 15%;">Actions</th>
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

</div><!-- /#wrapper -->
</div><!-- /#page-top -->

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


<!-- Add Categories modal -->
<div class="modal fade" id="addCategoriesModal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">

            <form class="form-horizontal" id="submitCategoriesForm" action="controller/createCategories.php" method="post">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fa fa-plus-circle"></i> Add Category</h4>
                </div>

                <div class="modal-body">

                    <div id="add-categories-messages"></div> <!-- for error/success messages -->

                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-4">
                                <label for="categoriesName" class="control-label">Category Name: </label>
                            </div>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="categoriesName" placeholder="Category Name" name="categoriesName" autocomplete="off">
                            </div>
                        </div>
                    </div> <!-- /form-group-->
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-4">
                                <label for="categoriesStatus" class="control-label">Status: </label>
                            </div>
                            <div class="col-sm-8">
                                <select class="form-control" id="categoriesStatus" name="categoriesStatus">
                                    <option value=""> </option>
                                    <option value="1">Active</option>
                                    <option value="2">Not Active</option>
                                </select>
                            </div>
                        </div>
                    </div> <!-- /form-group-->

                </div> <!-- /modal-body -->

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"> Close</button>
                    <button type="submit" class="btn btn-success" id="createCategoriesBtn" data-loading-text="Loading..." autocomplete="off"> <i class="fa fa-save"></i> Save </button>
                </div>
                <!-- /modal-footer -->
            </form>
            <!-- /.form -->
        </div>
        <!-- /modal-content -->
    </div>
    <!-- /modal-dailog -->
</div>
<!-- / add modal -->

<!-- Edit categories modal -->
<div class="modal fade" id="editCategoriesModal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">

            <form class="form-horizontal" id="editCategoriesForm" action="controller/editCategories.php" method="post">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fas fa-edit"></i> Edit Category</h4>
                </div>
                <div class="modal-body">
                    <div id="edit-categories-messages"></div> <!-- for error/success messages -->

                    <div class="edit-producer-result">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label for="editCategoriesName" class="control-label">Category Name: </label>
                                </div>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="editCategoriesName" placeholder="Category Name" name="editCategoriesName" autocomplete="off">
                                </div>
                            </div>
                        </div> <!-- /form-group-->
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label for="editCategoriesStatus" class="control-label">Status: </label>
                                </div>
                                <div class="col-sm-8">
                                    <select class="form-control" id="editCategoriesStatus" name="editCategoriesStatus">
                                        <option value="1">Active</option>
                                        <option value="2">Not Active</option>
                                    </select>
                                </div>
                            </div>
                        </div> <!-- /form-group-->
                    </div>
                    <!-- /edit categories result -->

                </div> <!-- /modal-body -->

                <div class="modal-footer editCategoriesFooter">
                    <button type="button" class="btn btn-default" data-dismiss="modal"> Close </button>
                    <button type="submit" class="btn btn-success" id="editCategoriesBtn" data-loading-text="Loading..." autocomplete="off"> <i class="fa fa-save"></i> Save </button>
                </div>
                <!-- /modal-footer -->
            </form>
            <!-- /.form -->
        </div>
        <!-- /modal-content -->
    </div>
    <!-- /modal-dailog -->
</div>
<!-- / add modal -->
<!-- /edit producer -->

<!-- Remove category modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeCategoriesModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><i class="fas fa-trash"></i> Remove Producer </h4>
            </div>
            <div class="modal-body">
                <p>Do you really want to remove ?</p>
            </div>
            <div class="modal-footer removeCategoriesFooter">
                <button type="button" class="btn btn-default" data-dismiss="modal"> Close </button>
                <button type="button" class="btn btn-danger" id="removeCategoriesBtn" data-loading-text="Loading..."> <i class="fas fa-trash"></i> Remove </button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /remove producer -->

<?php include_once 'includes/footer.php' ;?>
<script src="custom/js/categories.js"></script>

</body>
</html>
