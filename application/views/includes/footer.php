
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2014-2021 <a href="<?php echo base_url();?>/Dashboard">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.2.0
    </div>
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="<?php echo base_url();?>assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="<?php echo base_url();?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?php echo base_url();?>assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url();?>assets/dist/js/adminlte.js"></script>

<!-- SweetAlert2 -->
<script src="<?php echo base_url();?>assets/plugins/sweetalert2/sweetalert2.min.js"></script>

<!-- Setup JS base_url -->
<script type="text/javascript">
	const base_url = "<?= base_url(); ?>";
</script>

<?php if (isset($page_info['scripts_path']) && !empty($page_info['scripts_path'])) : ?>
  <?php foreach ($page_info['scripts_path'] as $value) : ?>
  <script src="<?= base_url() ?><?= $value . '.js' ?>"></script>
  <?php endforeach; ?>
<?php endif; ?>

<!-- Setup JS for the side nav of themes -->
<script src="<?php echo base_url();?>assets/dist/js/demo.js"></script>

<!-- Setup JS for logout -->
<script src="<?php echo base_url();?>assets/js/pages/logout.js"></script>
</body>
</html>
