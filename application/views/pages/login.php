<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>CICC - Login</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/css/adminlte.min.css">

  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">

  <?php if (isset($page_info['styles_path']) && !empty($page_info['styles_path'])) : ?>
    <?php foreach ($page_info['styles_path'] as $value) : ?>
      <link href="<?= base_url() ?><?= $value . '.css' ?>" rel="stylesheet">
    <?php endforeach; ?>
  <?php endif; ?>

</head>
<body class="hold-transition login-page">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <p class="h1"><b>CICC</b> <br/><h6>Document Management System</h6></p>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Sign in to start your documenting</p>
      <form id="form">
        <div class="input-group mb-3">
          <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
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
<script src="<?php echo base_url();?>assets/plugins/jquery/jquery.min.js"></script>

<!-- Bootstrap 4 -->
<script src="<?php echo base_url();?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- jquery-validation -->
<script src="<?php echo base_url();?>assets/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/jquery-validation/additional-methods.min.js"></script>

<!-- AdminLTE App -->
<script src="<?php echo base_url();?>assets/dist/js/adminlte.min.js"></script>

<!-- SweetAlert2 -->
<script src="<?php echo base_url();?>assets/plugins/sweetalert2/sweetalert2.min.js"></script>

<script type="text/javascript">
	const base_url = "<?= base_url(); ?>";
</script>


<?php if (isset($page_info['scripts_path']) && !empty($page_info['scripts_path'])) : ?>
  <?php foreach ($page_info['scripts_path'] as $value) : ?>
  <script src="<?= base_url() ?><?= $value . '.js' ?>"></script>
  <?php endforeach; ?>
<?php endif; ?>

</body>
</html>
