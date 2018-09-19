<?php
require_once 'controller/db_connect.php';
include_once 'models/index.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Stock Management System</title>

    <!-- Bootstrap core CSS-->
    <link href="scripts/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="scripts/sb-admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template-->
    <link href="scripts/sb-admin/css/sb-admin.css" rel="stylesheet">

</head>

<body class="bg-dark">

<div class="container">
    <div class="card card-login mx-auto mt-5">
        <div class="card-header">Login</div>
        <div class="card-body">
            <div class="messages">
                <?php if($errors) {
                    foreach ($errors as $key => $value) {
                        echo '<div class="alert alert-warning" role="alert">
									<i class="glyphicon glyphicon-exclamation-sign"></i>
									'.$value.'</div>';
                    }
                } ?>
            </div>
            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" id="loginForm">
                <div class="form-group">
                    <label for="username" class="small">Username</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Username" autocomplete="off">
                </div>
                <div class="form-group">
                    <label for="password" class="small">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" autocomplete="off" />
                </div>
                <button type="submit" class="btn btn-primary btn-block"> <i class="glyphicon glyphicon-log-in"></i> Login</button>
            </form>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="scripts/jquery/jquery.min.js"></script>
<script src="scripts/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<!--<script src="scripts/sb-admin/vendor/jquery-easing/jquery.easing.min.js"></script>-->

</body>
</html>
