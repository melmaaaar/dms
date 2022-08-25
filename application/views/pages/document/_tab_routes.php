<?php
    $id      =    isset($document[0]->id) && $document[0]->id ? $document[0]->id : 0;

    $reference_number            =    isset($document[0]->reference_number) && $document[0]->reference_number ? $document[0]->reference_number : '';
    $title            =    isset($document[0]->title) && $document[0]->title ? $document[0]->title : '';
    $rgv_document_type_id            =    isset($document[0]->rgv_document_type_id) && $document[0]->rgv_document_type_id ? $document[0]->rgv_document_type_id : 0;
    $rgv_document_tlp_code_id            =    isset($document[0]->rgv_document_tlp_code_id) && $document[0]->rgv_document_tlp_code_id ? $document[0]->rgv_document_tlp_code_id : 0;
    $rgv_document_status_id            =    isset($document[0]->rgv_document_status_id) && $document[0]->rgv_document_status_id ? $document[0]->rgv_document_status_id : 0;
    $document_date            =    isset($document[0]->document_date) && $document[0]->document_date ? $document[0]->document_date : NULL;
    $document_time            =    isset($document[0]->document_time) && $document[0]->document_time ? $document[0]->document_time : NULL;
    $remarks            =    isset($document[0]->remarks) && $document[0]->remarks ? $document[0]->remarks : '';
    
?>
<div class="card-body">
    <div class="accordion accordion-flush" id="accordionFlushExample">
    <div class="accordion-item">
        <h2 class="accordion-header" id="flush-headingOne">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
            Accordion Item #1
        </button>
        </h2>
        <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample" style="">
        <div class="accordion-body">
            Anim pariatur cliche reprehenderit, enim eiusmod high
            life accusamus terry richardson ad squid. 3 wolf moon
            officia aute, non cupidatat skateboard dolor brunch.
            Food truck quinoa nesciunt laborum eiusmod. Brunch 3
            wolf moon tempor, sunt aliqua put a bird on it squid
            single-origin coffee nulla assumenda shoreditch et.
            Nihil anim keffiyeh helvetica, craft beer labore wes
            anderson cred nesciunt sapiente ea proident. Ad vegan
            excepteur butcher vice lomo. Leggings occaecat craft
            beer farm-to-table, raw denim aesthetic synth nesciunt
            you probably haven't heard of them accusamus labore
            sustainable VHS.
        </div>
        </div>
    </div>
    <div class="accordion-item">
        <h2 class="accordion-header" id="flush-headingTwo">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
            Accordion Item #2
        </button>
        </h2>
        <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
        <div class="accordion-body">
            Anim pariatur cliche reprehenderit, enim eiusmod high
            life accusamus terry richardson ad squid. 3 wolf moon
            officia aute, non cupidatat skateboard dolor brunch.
            Food truck quinoa nesciunt laborum eiusmod. Brunch 3
            wolf moon tempor, sunt aliqua put a bird on it squid
            single-origin coffee nulla assumenda shoreditch et.
            Nihil anim keffiyeh helvetica, craft beer labore wes
            anderson cred nesciunt sapiente ea proident. Ad vegan
            excepteur butcher vice lomo. Leggings occaecat craft
            beer farm-to-table, raw denim aesthetic synth nesciunt
            you probably haven't heard of them accusamus labore
            sustainable VHS.
        </div>
        </div>
    </div>
    <div class="accordion-item">
        <h2 class="accordion-header" id="flush-headingThree">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
            Accordion Item #3
        </button>
        </h2>
        <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
        <div class="accordion-body">
            Anim pariatur cliche reprehenderit, enim eiusmod high
            life accusamus terry richardson ad squid. 3 wolf moon
            officia aute, non cupidatat skateboard dolor brunch.
            Food truck quinoa nesciunt laborum eiusmod. Brunch 3
            wolf moon tempor, sunt aliqua put a bird on it squid
            single-origin coffee nulla assumenda shoreditch et.
            Nihil anim keffiyeh helvetica, craft beer labore wes
            anderson cred nesciunt sapiente ea proident. Ad vegan
            excepteur butcher vice lomo. Leggings occaecat craft
            beer farm-to-table, raw denim aesthetic synth nesciunt
            you probably haven't heard of them accusamus labore
            sustainable VHS.
        </div>
        </div>
    </div>
    </div>
</div>
<script src="<?php echo base_url();?>assets/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/jquery-validation/additional-methods.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<script src="<?php echo base_url();?>assets/js/pages/document/_tab_info.js"></script>