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
              <li class="breadcrumb-item active">Create</li>
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
            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">Create</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form id="form">
                <div class="card-body">
                  <div class="row">
                      <div class="col-md-2">
                          <div class="form-group">    
                              <label for="document_date">Date<code> *</code></label>
                              <input type="date" id="document_date" name="document_date" class="form-control">
                          </div>
                      </div>
                      <div class="col-md-5">
                          <div class="form-group">
                              <label for="code">Code<code> *</code></label>
                              <input type="text" id="code" name="code" class="form-control" placeholder="Enter code">
                          </div>
                      </div>
                      <div class="col-md-3">
                          <label for="document_date">Traffic Light Protocol(TLP) Code<code> *</code></label>
                          <div class="form-group">  
                              <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                <label class="btn bg-red">
                                  <input type="radio" name="tlp_code" id="tlp_red" autocomplete="off" checked=""> Red
                                </label>
                                <label class="btn bg-yellow">
                                  <input type="radio" name="tlp_code" id="tlp_amber" autocomplete="off"> Amber
                                </label>
                                <label class="btn bg-green">
                                  <input type="radio" name="tlp_code" id="tlp_green" autocomplete="off"> Green
                                </label>
                                <label class="btn bg-white">
                                  <input type="radio" name="tlp_code" id="tlp_white" autocomplete="off"> White
                                </label>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="row">
                      <div class="col-md-2">
                          <div class="form-group">
                              <label for="code">Code<code> *</code></label>
                              <input type="text" id="code" name="code" class="form-control" placeholder="Enter code">
                          </div>
                      </div>
                      <div class="col-md-7">
                          <div class="form-group">
                              <label for="description">Description</label>
                              <input type="text" id="description" name="description" class="form-control" placeholder="Enter description">
                          </div>
                      </div>
                  </div>
                  <div class="row">
                      <div class="col-md-4">
                          <div class="form-group">
                              <label for="link">Link</label>
                              <input type="text" id="link" name="link" class="form-control" placeholder="Enter link">
                          </div>
                      </div>
                      <div class="col-md-4">
                          <div class="form-group">
                              <label for="icon">Icon</label>
                              <input type="text" id="icon" name="icon" class="form-control" placeholder="Enter icon">
                          </div>
                      </div>
                      <div class="col-md-2">
                          <div class="form-group">
                              <label for="ctr">Sequence</label>
                              <input type="number" id="ctr" name="ctr" class="form-control" placeholder="Enter sequence">
                          </div>
                      </div>
                      <div class="col-md-2">
                          <div class="form-group">
                              <label for="is_active">Is Active?</label>
                              <select id="is_active" name="is_active" class="form-control">
                                  <option value="1" >Yes</option>
                                  <option value="0" >No</option>
                              </select>
                          </div>
                      </div>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer" style="text-align: center;">
                    <div class="text-center">
                        <button type="submit" class="btn btn-sm btn-success">Submit</button>
                        &nbsp;
                        <a href="<?php echo base_url();?>document" class="btn btn-sm btn-danger">Cancel</a>
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