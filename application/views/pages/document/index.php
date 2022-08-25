  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><?php echo $_SESSION['system_web_module']; ?></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url();?>document"><?php echo $_SESSION['system_web_module']; ?></a></li>
              <li class="breadcrumb-item active">Index</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <!-- card -->
            <div class="card card-primary">
                <!-- header -->
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                      <h4>DataTable</h4>
                      <a class="btn btn-success" href="<?php echo base_url();?>document/create"><i class="fas fa-plus"></i>&nbsp;&nbsp;Create</a>
                    </div>  
                </div>
                <!-- /.card-header -->
                <!-- body -->
                <div class="card-body" style="overflow: auto;">
                    <table id="table" class="table table-bordered table-striped" width="100%">
                        <thead>
                            <tr>
                                <th style="width:5%;">#</th>
                                <th>ID</th>
                                <th style="width:10%;">Date</th>
                                <th style="width:10%;">Reference Number</th>
                                <th>Title</th>
                                <th style="width:10%;">Document Type</th>
                                <th style="width:10%;">Status</th>
                                <th style="width:15%;">Actions</th>
                                <th>Remarks</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->

          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->