
<?php
    $id      =    isset($document[0]->id) && $document[0]->id ? $document[0]->id : 0;

    $code            =    isset($document[0]->code) && $document[0]->code ? $document[0]->code : '';
    $title            =    isset($document[0]->title) && $document[0]->title ? $document[0]->title : '';
    $rgv_document_type_id            =    isset($document[0]->rgv_document_type_id) && $document[0]->rgv_document_type_id ? $document[0]->rgv_document_type_id : 0;
    $rgv_document_tlp_code_id            =    isset($document[0]->rgv_document_tlp_code_id) && $document[0]->rgv_document_tlp_code_id ? $document[0]->rgv_document_tlp_code_id : 0;
    $rgv_document_tlp_code_id            =    isset($document[0]->rgv_document_status_id) && $document[0]->rgv_document_status_id ? $document[0]->rgv_document_status_id : 0;
    $document_date            =    isset($document[0]->document_date) && $document[0]->document_date ? new DATE($document[0]->document_date) : NULL;
    $remarks            =    isset($document[0]->remarks) && $document[0]->remarks ? $document[0]->remarks : '';
    
?>

<input type="text" id="id" name="id" class="form-control"  placeholder="ID" value='<?php echo $id;?>' hidden>
<div class="row">
    <div class="col-md-3">
        <div class="form-group">    
            <label for="name">Name<code> *</code></label>
            <input type="text" id="name" name="name" class="form-control" value='<?php echo $name;?>' placeholder="Enter name">
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label for="code">Code<code> *</code></label>
            <input type="text" id="code" name="code" class="form-control" value='<?php echo $code;?>' placeholder="Enter code">
        </div>
    </div>
    <div class="col-md-7">
        <div class="form-group">
            <label for="description">Description</label>
            <input type="text" id="description" name="description" class="form-control" value='<?php echo $description;?>' placeholder="Enter description">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label for="link">Link</label>
            <input type="text" id="link" name="link" class="form-control" value='<?php echo $link;?>' placeholder="Enter link">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="icon">Icon</label>
            <input type="text" id="icon" name="icon" class="form-control" value='<?php echo $icon;?>' placeholder="Enter icon">
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label for="ctr">Sequence</label>
            <input type="number" id="ctr" name="ctr" class="form-control" value='<?php echo $ctr;?>' placeholder="Enter sequence">
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label for="is_active">Is Active?</label>
            <select id="is_active" name="is_active" class="form-control">
                <option value="1" <?php echo ($is_active == 1) ? ' selected' : '';?> >Yes</option>
                <option value="0" <?php echo ($is_active == 0) ? ' selected' : '';?>>No</option>
            </select>
        </div>
    </div>
</div>