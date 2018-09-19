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
                <li class="breadcrumb-item active">Customers</li>
            </ol>
            <br>
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="row">
                            <div class="col-md-6">
                                <h3><i class="fas fa-fw fa-user-friends"></i> Manage Customers</h3>
                            </div>
                            <div class="col-md-6" >
                                <button class="btn btn-primary float-right button1" data-toggle="modal" id="addCustomersModalBtn" data-target="#addCustomersModal"> <i class="fas fa-plus-circle"></i> Add Customer </button>
                            </div>
                        </div> <!-- row -->

                        <p><br /></p>

                        <div class="panel-body">
                            <div class="remove-messages"></div>

                            <table class="table table-sm" id="manageCustomersTable">
                                <thead class="thead-light">
                                <tr>
                                    <th>Name</th>
                                    <th>Contact</th>
                                    <th>Address</th>
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


<!-- Add Customers modal -->
<div class="modal fade" id="addCustomersModal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">

            <form class="form-horizontal" id="submitCustomersForm" action="controller/createCustomers.php" method="post">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fa fa-plus-circle"></i> Add Customer</h4>
                </div>

                <div class="modal-body">

                    <div id="add-customers-messages"></div> <!-- for error/success messages -->

                    <div class="form-group"> <!-- first name -->
                        <div class="row">
                            <div class="col-sm-4">
                                <label for="customersFirstName" class="control-label">First Name: </label>
                            </div>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="customersFirstName" placeholder="First Name" name="customersFirstName" autocomplete="off">
                            </div>
                        </div>
                    </div> <!-- /form-group-->

                    <div class="form-group"> <!-- last name -->
                        <div class="row">
                            <div class="col-sm-4">
                                <label for="customersLastName" class="control-label">Last Name: </label>
                            </div>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="customersLastName" placeholder="Last Name" name="customersLastName" autocomplete="off">
                            </div>
                        </div>
                    </div> <!-- /form-group-->

                    <div class="form-group"> <!-- company -->
                        <div class="row">
                            <div class="col-sm-4">
                                <label for="customersCompany" class="control-label">Company: </label>
                            </div>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="customersCompany" placeholder="Company" name="customersCompany" autocomplete="off">
                            </div>
                        </div>
                    </div> <!-- /form-group-->

                    <div class="form-group"> <!-- email -->
                        <div class="row">
                            <div class="col-sm-4">
                                <label for="customersEmail" class="control-label">Email: </label>
                            </div>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="customersEmail" placeholder="Email" name="customersEmail" autocomplete="off">
                            </div>
                        </div>
                    </div> <!-- /form-group-->

                    <div class="form-group"> <!-- phone -->
                        <div class="row">
                            <div class="col-sm-4">
                                <label for="customersPhone" class="control-label">Phone number: </label>
                            </div>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="customersPhone" placeholder="Phone number" name="customersPhone" autocomplete="off">
                            </div>
                        </div>
                    </div> <!-- /form-group-->

                    <div class="form-group"> <!-- address street / number -->
                        <div class="row">
                            <div class="col-sm-4">
                                <label for="customersAddressStreet" class="control-label">Street / number: </label>
                            </div>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" id="customersAddressStreet" placeholder="Street name" name="customersAddressStreet" autocomplete="off">
                            </div>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" id="customersAddressNumber" placeholder="Number" name="customersAddressNumber" autocomplete="off">
                            </div>
                        </div>
                    </div> <!-- /form-group-->

                    <div class="form-group"> <!-- post number / city -->
                        <div class="row">
                            <div class="col-sm-4">
                                <label for="customersAddressStreet" class="control-label">Post no / city: </label>
                            </div>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" id="customersAddressPost" placeholder="Post No." name="customersAddressPost" autocomplete="off">
                            </div>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" id="customersAddressCity" placeholder="City" name="customersAddressCity" autocomplete="off">
                            </div>
                        </div>
                    </div> <!-- /form-group-->
                </div> <!-- /modal-body -->

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"> Close</button>
                    <button type="submit" class="btn btn-success" id="createCustomersBtn" data-loading-text="Loading..." autocomplete="off"> <i class="fa fa-save"></i> Save </button>
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

<!-- Edit Customers modal -->
<div class="modal fade" id="editCustomersModal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">

            <form class="form-horizontal" id="editCustomersForm" action="controller/editCustomers.php" method="post">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fa fa-edit"></i> Edit Customer</h4>
                </div>

                <div class="modal-body">
                    <div id="edit-customers-messages"></div> <!-- for error/success messages -->

                    <div class="form-group"> <!-- first name -->
                        <div class="row">
                            <div class="col-sm-4">
                                <label for="editCustomersFirstName" class="control-label">First Name: </label>
                            </div>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="editCustomersFirstName" placeholder="First Name" name="editCustomersFirstName" autocomplete="off">
                            </div>
                        </div>
                    </div> <!-- /form-group-->

                    <div class="form-group"> <!-- last name -->
                        <div class="row">
                            <div class="col-sm-4">
                                <label for="editCustomersLastName" class="control-label">Last Name: </label>
                            </div>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="editCustomersLastName" placeholder="Last Name" name="editCustomersLastName" autocomplete="off">
                            </div>
                        </div>
                    </div> <!-- /form-group-->

                    <div class="form-group"> <!-- company -->
                        <div class="row">
                            <div class="col-sm-4">
                                <label for="editCustomersCompany" class="control-label">Company: </label>
                            </div>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="editCustomersCompany" placeholder="Company" name="editCustomersCompany" autocomplete="off">
                            </div>
                        </div>
                    </div> <!-- /form-group-->

                    <div class="form-group"> <!-- email -->
                        <div class="row">
                            <div class="col-sm-4">
                                <label for="editCustomersEmail" class="control-label">Email: </label>
                            </div>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="editCustomersEmail" placeholder="Email" name="editCustomersEmail" autocomplete="off">
                            </div>
                        </div>
                    </div> <!-- /form-group-->

                    <div class="form-group"> <!-- phone -->
                        <div class="row">
                            <div class="col-sm-4">
                                <label for="editCustomersPhone" class="control-label">Phone number: </label>
                            </div>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="editCustomersPhone" placeholder="Phone number" name="editCustomersPhone" autocomplete="off">
                            </div>
                        </div>
                    </div> <!-- /form-group-->

                    <div class="form-group"> <!-- address street / number -->
                        <div class="row">
                            <div class="col-sm-4">
                                <label for="editCustomersAddressStreet" class="control-label">Street / number: </label>
                            </div>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" id="editCustomersAddressStreet" placeholder="Street name" name="editCustomersAddressStreet" autocomplete="off">
                            </div>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" id="editCustomersAddressNumber" placeholder="Number" name="editCustomersAddressNumber" autocomplete="off">
                            </div>
                        </div>
                    </div> <!-- /form-group-->

                    <div class="form-group"> <!-- post number / city -->
                        <div class="row">
                            <div class="col-sm-4">
                                <label for="editCustomersAddressStreet" class="control-label">Post no / city: </label>
                            </div>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" id="editCustomersAddressPost" placeholder="Post No." name="editCustomersAddressPost" autocomplete="off">
                            </div>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" id="editCustomersAddressCity" placeholder="City" name="editCustomersAddressCity" autocomplete="off">
                            </div>
                        </div>
                    </div> <!-- /form-group-->
                </div> <!-- /modal-body -->

                <div class="modal-footer editCustomersFooter">
                    <button type="button" class="btn btn-default" data-dismiss="modal"> Close</button>
                    <button type="submit" class="btn btn-success" id="editCustomersBtn" data-loading-text="Loading..." autocomplete="off"> <i class="fa fa-save"></i> Save </button>
                </div>
                <!-- /modal-footer -->
            </form>
            <!-- /.form -->
        </div>
        <!-- /modal-content -->
    </div>
    <!-- /modal-dailog -->
</div>
<!-- / edit customers modal -->

<!-- Edit customers modal -->
<div class="modal fade" id="editCustomersModal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">

            <form class="form-horizontal" id="editCustomersForm" action="controller/editCustomers.php" method="post">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fas fa-edit"></i> Edit Category</h4>
                </div>
                <div class="modal-body">
                    <div id="edit-customers-messages"></div> <!-- for error/success messages -->

                    <div class="edit-producer-result">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label for="editCustomersName" class="control-label">Category Name: </label>
                                </div>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="editCustomersName" placeholder="Category Name" name="editCustomersName" autocomplete="off">
                                </div>
                            </div>
                        </div> <!-- /form-group-->
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label for="editCustomersStatus" class="control-label">Status: </label>
                                </div>
                                <div class="col-sm-8">
                                    <select class="form-control" id="editCustomersStatus" name="editCustomersStatus">
                                        <option value="1">Active</option>
                                        <option value="2">Not Active</option>
                                    </select>
                                </div>
                            </div>
                        </div> <!-- /form-group-->
                    </div>
                    <!-- /edit customers result -->

                </div> <!-- /modal-body -->

                <div class="modal-footer editCustomersFooter">
                    <button type="button" class="btn btn-default" data-dismiss="modal"> Close </button>
                    <button type="submit" class="btn btn-success" id="editCustomersBtn" data-loading-text="Loading..." autocomplete="off"> <i class="fa fa-save"></i> Save </button>
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

<!-- Remove customer modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeCustomersModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><i class="fas fa-trash"></i> Remove Customer </h4>
            </div>
            <div class="modal-body">
                <p>Do you really want to remove ?</p>
            </div>
            <div class="modal-footer removeCustomersFooter">
                <button type="button" class="btn btn-default" data-dismiss="modal"> Close </button>
                <button type="button" class="btn btn-danger" id="removeCustomersBtn" data-loading-text="Loading..."> <i class="fas fa-trash"></i> Remove </button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /remove producer -->

<?php include_once 'includes/footer.php' ;?>

<script src="custom/js/customers.js"></script>

</body>
</html>
