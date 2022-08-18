  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><?php echo $_SESSION['system_web_section']; ?></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url();?>system_web_section"><?php echo $_SESSION['system_web_section']; ?></a></li>
              <li class="breadcrumb-item active">Edit</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">   
            <!-- jquery validation -->
            <div class="card card-warning">
              <div class="card-header">
                <h3 class="card-title">Edit</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form id="form">
                <div class="card-body">
                    <?php $this->load->view('pages/system_web_section/_form.php') ?>  
                </div>
                <!-- /.card-body -->
                <div class="card-footer" style="text-align: center;">
                    <div class="text-center">
                        <button type="submit" class="btn btn-sm btn-warning">Submit</button>
                        &nbsp;
                        <a href="<?php echo base_url();?>system_web_section" class="btn btn-sm btn-danger">Cancel</a>
                    </div>
                  
                </div>
              </form>
            </div>
            <!-- /.card -->
            </div>
          <!--/.col (left) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>