<?php
require_once 'controller/core.php';
include_once 'includes/head.php';
include_once 'includes/navbar.php';

$user_id = $_SESSION['userId'];
$sql = "SELECT * FROM users WHERE user_id = {$user_id}";
$query = $connect->query($sql);
$result = $query->fetch_assoc();

$connect->close();
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
                <li class="breadcrumb-item active">Setting</li>
            </ol>
            <br>
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="row">
                            <div class="col-md-6">
                                <h3><i class="fas fa-fw fa-cog"></i> Setting</h3>
                            </div>
                        </div> <!-- row -->

                        <p><br /></p>

                        <div class="panel-body">

                            <form action="controller/changeUsername.php" method="post" class="form-horizontal" id="changeUsernameForm">
                                <fieldset>
                                    <legend>Change Username</legend>
                                    <div class="changeUsenrameMessages"></div>

                                    <div class="form-group">
                                        <label for="username" class="control-label">Username</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" id="username" name="username" placeholder="Usename" value="<?php echo $result['username']; ?>"/>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-6">
                                            <input type="hidden" name="user_id" id="user_id" value="<?php echo $result['user_id'] ?>" />
                                            <button type="submit" class="btn btn-primary button1" data-loading-text="Loading..." id="changeUsernameBtn"> <i class="glyphicon glyphicon-ok-sign"></i> Save Changes </button>
                                        </div>
                                    </div>
                                </fieldset>
                            </form>

                            <hr />

                            <form action="controller/changePassword.php" method="post" class="form-horizontal" id="changePasswordForm">
                                <fieldset>
                                    <legend>Change Password</legend>

                                    <div class="changePasswordMessages"></div>

                                    <div class="form-group">
                                        <label for="password" class="col-sm-2 control-label">Current Password</label>
                                        <div class="col-sm-10">
                                            <input type="password" class="form-control" id="password" name="password" placeholder="Current Password">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="npassword" class="col-sm-2 control-label">New password</label>
                                        <div class="col-sm-10">
                                            <input type="password" class="form-control" id="npassword" name="npassword" placeholder="New Password">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="cpassword" class="col-sm-2 control-label">Confirm Password</label>
                                        <div class="col-sm-10">
                                            <input type="password" class="form-control" id="cpassword" name="cpassword" placeholder="Confirm Password">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <input type="hidden" name="user_id" id="user_id" value="<?php echo $result['user_id'] ?>" />
                                            <button type="submit" class="btn btn-primary button1"> <i class="glyphicon glyphicon-ok-sign"></i> Save Changes </button>

                                        </div>
                                    </div>


                                </fieldset>
                            </form>



                        </div> <!-- /panel-body -->

                    </div> <!-- /panel -->
                </div> <!-- /col-md-12 -->
            </div> <!-- /row -->
        <p><br /></p>
        </div>

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

<script src="custom/js/setting.js"></script>

</body>
</html>
