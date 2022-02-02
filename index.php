<?php
 session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>PROJECT-NGAS</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page" style="background-color:#d0efff;">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary " >
    <div class="card-header text-center text-light" style="background-color:#03254c;">
    <img src="dist/img/pang.png" alt="Pangasinan Logo"  width="50" height="50" class="d-inline-block" alt="">
    <br>
      <a href="index.php" class="h5">FINANCIAL MANAGEMENT INFORMATION SYSTEM</a>
      <br>
      <a href="index.php" class="h6">PROJECT-NGAS</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Sign in to start your session</p>
      <?php
				if(isset($_SESSION['error'])){
					?>
					<div class="alert alert-danger text-center" style="margin-top:20px;">
						<?php echo $_SESSION['error']; ?>
					</div>
					<?php
					unset($_SESSION['error']);
				}

				if(isset($_SESSION['success'])){
					?>
					<div class="alert alert-success text-center" style="margin-top:20px;">
						<?php echo $_SESSION['success'];
            echo "<script>window.location.href = './pages/dashboard.php'</script>"; ?>
					</div>
					<?php

					unset($_SESSION['success']);
				}
			?>
      <form class="user" role="form" name="login_form" method="POST" action="login.php">
        <div class="input-group mb-3">
          <input type="text" class="form-control" id="username_id" name="username" placeholder="Username">
          <div class="input-group-append ">
            <div class="input-group-text text-light" style="background-color:#03254c;">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" id="password_id" name="password" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text text-light " style="background-color:#03254c;">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" name="login" class="btn btn-default btn-block  text-light" style="background-color:#03254c;">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
      

    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
</body>
</html>
