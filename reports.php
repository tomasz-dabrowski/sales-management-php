<?php
require_once 'controller/core.php';
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
                <li class="breadcrumb-item active">Reports</li>
            </ol>
            <br>
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="row">
                            <div class="col-md-6">
                                <h3><i class="fas fa-fw fa-chart-bar"></i> Generate Report</h3>
                            </div>
                            <div class="col-md-6" >
                                <button class="btn btn-primary float-right button1" data-toggle="modal" id="addCustomersModalBtn" data-target="#addCustomersModal"> <i class="fas fa-plus-circle"></i> Add Customer </button>
                            </div>
                        </div> <!-- row -->

                        <p><br /></p>

                        <div class="panel-body">

                            <form class="form-horizontal" action="controller/getOrderReport.php" method="post" id="getOrderReportForm">

                                <div class="row">
                                    <div class="col-md-6">
                                <div class="form-group">
                                    <label for="startDate" class="col-sm-2 control-label">Start Date</label>
                                    <div class="col-sm-10">
                                        <input type="date" class="form-control" id="startDate" name="startDate" placeholder="Start Date" />
                                    </div>
                                </div>
                                    </div>

                                    <div class="col-md-6">
                                <div class="form-group">
                                    <label for="endDate" class="col-sm-2 control-label">End Date</label>
                                    <div class="col-sm-10">
                                        <input type="date" class="form-control" id="endDate" name="endDate" placeholder="End Date" />
                                    </div>
                                </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" class="btn btn-success" id="generateReportBtn"> <i class="glyphicon glyphicon-ok-sign"></i> Generate Report</button>
                                    </div>
                                </div>
                            </form>

                        </div>

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

<?php include_once 'includes/footer.php' ;?>

<script src="custom/js/reports.js"></script>

</body>
</html>
