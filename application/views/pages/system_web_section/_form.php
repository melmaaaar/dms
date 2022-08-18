
<?php
    $id      =    isset($system_web_section[0]->id) && $system_web_section[0]->id ? $system_web_section[0]->id : 0;

    $web_module_id = isset($system_web_section[0]->web_module_id) && $system_web_section[0]->web_module_id ? $system_web_section[0]->web_module_id : 0;
    $name            =    isset($system_web_section[0]->name) && $system_web_section[0]->name ? $system_web_section[0]->name : '';
    $code            =    isset($system_web_section[0]->code) && $system_web_section[0]->code ? $system_web_section[0]->code : '';
    $description            =    isset($system_web_section[0]->description) && $system_web_section[0]->description ? $system_web_section[0]->description : '';
    $link        =    isset($system_web_section[0]->link) && $system_web_section[0]->link ? $system_web_section[0]->link : '';
    $icon        =    isset($system_web_section[0]->icon) && $system_web_section[0]->icon ? $system_web_section[0]->icon : '';
    $ctr        =    isset($system_web_section[0]->ctr) && $system_web_section[0]->ctr ? $system_web_section[0]->ctr : $this->M_system_web_section->generate_ctr();
    $is_active        =    isset($system_web_section[0]->id) && $system_web_section[0]->id ? $system_web_section[0]->is_active : 1;

    $web_modules = $this->M_system_web_module->get_all();
?>

<input type="text" id="id" name="id" class="form-control"  placeholder="Enter name" value='<?php echo $id;?>' hidden>
<div class="row">
    <div class="col-md-3">
        <div class="form-group">    
            <label for="name">Web Module<code> *</code></label>
            <select id="web_module_id" name="web_module_id" class="form-control">
                <option value="0" >Select Module</option>
                <?php foreach($web_modules as $value) : ?>
                <option value="<?php echo $value->id; ?>" <?php echo ($value->id == $web_module_id) ? ' selected': ''; ?>><?php echo $value->name; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
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
    <div class="col-md-4">
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