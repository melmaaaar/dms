  
<?php
    $id      =    isset($document[0]->id) && $document[0]->id ? $document[0]->id : 0;

    $reference_number            =    isset($document[0]->reference_number) && $document[0]->reference_number ? $document[0]->reference_number : 'N/A';
    $title            =    isset($document[0]->title) && $document[0]->title ? $document[0]->title : 'N/A';
    $rgv_document_type_id            =    isset($document[0]->rgv_document_type_id) && $document[0]->rgv_document_type_id ? $document[0]->rgv_document_type_id : 0;
    $rgv_document_tlp_code_id            =    isset($document[0]->rgv_document_tlp_code_id) && $document[0]->rgv_document_tlp_code_id ? $document[0]->rgv_document_tlp_code_id : 0;
    $rgv_document_status_id            =    isset($document[0]->rgv_document_status_id) && $document[0]->rgv_document_status_id ? $document[0]->rgv_document_status_id : 0;
    $document_date            =    isset($document[0]->document_date) && $document[0]->document_date ? $document[0]->document_date : NULL;
    $document_time            =    isset($document[0]->document_time) && $document[0]->document_time ? $document[0]->document_time : NULL;
    $remarks            =    isset($document[0]->remarks) && $document[0]->remarks ? $document[0]->remarks : 'N/A';
    
?>
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
              <li class="breadcrumb-item active">Edit</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <input type="text" id="id" name="id" class="form-control" value='<?php echo $id; ?>' hidden>
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-3">
              <div id="preview_card">
              </div>
          </div>
          <!--/.col (left) -->
          <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a id="_tab_info" class="nav-link" href="javascript(0);" data-toggle="tab">Info</a></li>
                  <li class="nav-item"><a id="_tab_routes" class="nav-link" href="javascript(0);" data-toggle="tab">Routes</a></li>
                  <li class="nav-item"><a id="_tab_attachments" class="nav-link" href="javascript(0);" data-toggle="tab">Attachments</a></li>
                  <li class="nav-item"><a id="_tab_history" class="nav-link" href="#javascript(0);" data-toggle="tab">History</a></li>  
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div id="tab_content">
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>