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
<form id="form" class="form-horizontal">
    <input type="text" class="form-control" id="id" name="id" value='<?php echo $id; ?>' hidden>
    <div class="form-group row">
        <label for="rgv_document_tlp_code_id" class="col-sm-3 col-form-label">TLP Code<code> *</code></label>
        <div class="col-sm-4">
            <div class="form-group">  
                <div class="btn-group btn-group-toggle" data-toggle="buttons" data-tooltip="tooltip">
                    <label class="btn bg-red <?php echo ($rgv_document_tlp_code_id==10) ? 'active': ''; ?>">
                        <input type="radio" name="rgv_document_tlp_code_id" id="tlp_red" autocomplete="off" value="10" <?php echo ($rgv_document_tlp_code_id==10) ? ' checked=""': ''; ?>> Red
                    </label>
                    <label class="btn bg-yellow <?php echo ($rgv_document_tlp_code_id==11) ? 'active': ''; ?>">
                        <input type="radio" name="rgv_document_tlp_code_id" id="tlp_amber" autocomplete="off" value="11" <?php echo ($rgv_document_tlp_code_id==11) ? ' checked=""': ''; ?>> Amber
                    </label>
                    <label class="btn bg-green <?php echo ($rgv_document_tlp_code_id==12) ? 'active': ''; ?>">
                        <input type="radio" name="rgv_document_tlp_code_id" id="tlp_green" autocomplete="off" value="12" <?php echo ($rgv_document_tlp_code_id==12) ? ' checked=""': ''; ?>> Green
                    </label>
                    <label class="btn bg-white <?php echo ($rgv_document_tlp_code_id==13) ? 'active': ''; ?>">
                        <input type="radio" name="rgv_document_tlp_code_id" id="tlp_white" autocomplete="off" value="13" <?php echo ($rgv_document_tlp_code_id==13) ? ' checked=""': ''; ?>> White
                    </label>
                </div>
            </div>
        </div>
        <div class="col-sm-5">
            <div class="form-group">
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

    <div class="form-group row">
        <label for="date_time" class="col-sm-3 col-form-label">Date & Time<code> *</code></label>
        <div class="col-sm-2">
            <input type="date" id="document_date" name="document_date" class="form-control" value='<?php echo $document_date; ?>' placeholder="Enter reference number">
        </div>
        <div class="col-sm-2">
            <input type="time" id="document_time" name="document_time" class="form-control" value='<?php echo $document_time; ?>' placeholder="Enter reference number">
        </div>
        
    </div>
    
    <div class="form-group row">
        <label for="reference_number" class="col-sm-3 col-form-label">Reference Number<code> *</code></label>
        <div class="col-sm-9">
            <input type="text" id="reference_number" name="reference_number" class="form-control" value='<?php echo $reference_number; ?>' placeholder="Enter reference number">
        </div>
    </div>

    <div class="form-group row">
        <label for="title" class="col-sm-3 col-form-label">Title<code> *</code></label>
        <div class="col-sm-9">
            <input type="text" id="title" name="title" class="form-control" value='<?php echo $title; ?>' placeholder="Enter reference number">
        </div>
    </div>

    <div class="form-group row">
        <label for="rgv_document_type_id" class="col-sm-3 col-form-label">Document Type<code> *</code></label>
        <div class="col-sm-4">
            <select id="rgv_document_type_id" name="rgv_document_type_id" class="form-control">
                <option value="0" <?php echo ($rgv_document_type_id==0) ? 'selected': ''; ?>>No Selection</option>
                <option value="3" <?php echo ($rgv_document_type_id==3) ? 'selected': ''; ?>>Office Documents</option>
                <option value="4" <?php echo ($rgv_document_type_id==4) ? 'selected': ''; ?>>Incoming Documents</option>
                <option value="5" <?php echo ($rgv_document_type_id==5) ? 'selected': ''; ?>>Outgoing Documents</option>
                <option value="6" <?php echo ($rgv_document_type_id==6) ? 'selected': ''; ?>>Walk-in Documents</option>
            </select>
        </div>
        <div class="col-sm-2 text-center">
            <label for="rgv_document_status_id" class="col-form-label">Status <code> *</code></label>
        </div>
        <div class="col-sm-3">
            <select id="rgv_document_status_id" name="rgv_document_status_id" class="form-control">
                <option value="0" <?php echo ($rgv_document_status_id==0) ? 'selected': ''; ?>>No Selection</option>
                <option value="7" <?php echo ($rgv_document_status_id==7) ? 'selected': ''; ?>>Completed</option>
                <option value="8" <?php echo ($rgv_document_status_id==8) ? 'selected': ''; ?>>Ongoing</option>
                <option value="9" <?php echo ($rgv_document_status_id==9) ? 'selected': ''; ?>>Pending</option>
            </select>
        </div>
    </div>
    <div class="form-group row">
        <label for="remarks" class="col-sm-3 col-form-label">Remarks</label>
        <div class="col-sm-9">
            <textarea id="remarks" name="remarks" class="form-control" placeholder="Enter remarks"><?php echo $remarks;?></textarea>
        </div>
    </div>
    <hr>
    <div class="footer" style="text-align: center;">
        <div class="text-center">
            <button type="submit" class="btn btn-sm btn-success">Submit</button>
            &nbsp;
            <a href="<?php echo base_url();?>document" class="btn btn-sm btn-danger">Cancel</a>
        </div>
    </div>
</form> 
<script src="<?php echo base_url();?>assets/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/jquery-validation/additional-methods.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<script src="<?php echo base_url();?>assets/js/pages/document/_tab_info.js"></script>