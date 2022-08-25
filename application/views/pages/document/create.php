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
              <form id="form" method='post' action='' enctype="multipart/form-data">
                <div class="card-body">
                  <div class="row">
                      <div class="col-md-2">
                          <div class="form-group">    
                              <label for="document_date">Time<code> *</code></label>
                              <input type="date" id="document_date" name="document_date" class="form-control" value="<?php echo date('Y-m-d'); ?>">
                          </div>
                      </div>
                      <div class="col-md-2">
                          <div class="form-group">    
                              <label for="document_time">Date<code> *</code></label>
                              <input type="time" id="document_time" name="document_time" class="form-control" value="<?php echo date('H:i'); ?>">
                          </div>
                      </div>
                      <div class="col-md-3">
                          <label for="rgv_document_tlp_code_id">Traffic Light Protocol(TLP) Code<code> *</code></label>
                          <div class="form-group">  
                              <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                <label class="btn bg-red">
                                  <input type="radio" name="rgv_document_tlp_code_id" id="tlp_red" autocomplete="off" value="10" checked=""> Red
                                </label>
                                <label class="btn bg-yellow">
                                  <input type="radio" name="rgv_document_tlp_code_id" id="tlp_amber" autocomplete="off" value="11"> Amber
                                </label>
                                <label class="btn bg-green">
                                  <input type="radio" name="rgv_document_tlp_code_id" id="tlp_green" autocomplete="off" value="12"> Green
                                </label>
                                <label class="btn bg-white">
                                  <input type="radio" name="rgv_document_tlp_code_id" id="tlp_white" autocomplete="off" value="13"> White
                                </label>
                              </div>
                          </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-3">
                          <div class="form-group">
                              <label for="reference_number">Reference Number<code> *</code></label>
                              <input type="text" id="reference_number" name="reference_number" class="form-control" placeholder="Enter reference number">
                          </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="attachments" >File Upload</label>
                          <div class="input-group">
                            <div class="custom-file">
                              <input type="file" class="custom-file-input" id="attachments" name="attachments[]" multiple>
                              <label id="lbl_file_upload" class="custom-file-label" for="attachments" >Upload attachments</label>
                            </div>
                            <div class="input-group-append">
                                <span id="attachments_reset" class="input-group-text" onclick="resetFile()">Cancel</span>
                            </div>
                          </div>
                        </div>
                      </div>
                  </div>
                  <div class="row">
                      <div class="col-md-8">
                          <div class="form-group">
                              <label for="title">Title<code> *</code></label>
                              <input type="text" id="title" name="title" class="form-control" placeholder="Enter title">
                          </div>
                      </div>
                      <div class="col-md-2">
                        <div class="form-group">
                            <label for="rgv_document_type_id">Document Type</label>
                            <select id="rgv_document_type_id" name="rgv_document_type_id" class="form-control">
                                <option value="0">No Selection</option>
                                <option value="3">Office Documents</option>
                                <option value="4">Incoming Documents</option>
                                <option value="5">Outgoing Documents</option>
                                <option value="6">Walk-in Documents</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="rgv_document_status_id">Status</label>
                            <select id="rgv_document_status_id" name="rgv_document_status_id" class="form-control">
                                <option value="0">No Selection</option>
                                <option value="7">Completed</option>
                                <option value="8">Ongoing</option>
                                <option value="9">Pending</option>
                            </select>
                        </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="remarks">Remarks</label>
                            <textarea id="remarks" name="remarks" class="form-control" placeholder="Enter remarks"></textarea>
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