  
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
<div class="card card-<?php if($rgv_document_tlp_code_id==10){ echo 'danger';}elseif($rgv_document_tlp_code_id==11){ echo 'warning';}elseif($rgv_document_tlp_code_id==12){ echo 'success';}else{ echo 'light';} ?>">
    <div class="card-header">
    <h3 class="card-title"><?php echo $reference_number; ?></h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
    <strong><i class="fas fa-book mr-1"></i> Title</strong>

    <p class="text-muted">
        <?php echo $title; ?>
    </p>

    <hr>

    <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>

    <p class="text-muted">Malibu, California</p>

    <hr>

    <strong><i class="far fa-file-alt mr-1"></i> Remarks</strong>

    <p class="text-muted"><?php echo $remarks; ?></p>
    </div>
    <!-- /.card-body -->
</div>