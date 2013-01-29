


<div class="row-fluid">
  <div class="box span12">
    <div class="box-header" data-original-title>
      <h2><i class="icon-edit"></i><span class="break"></span>Edit Template</h2>

      <div class="box-icon">
        <a href="#" class="btn-setting"><i class="icon-plus"></i></a>

      </div>
    </div>
    <div class="box-sortable">

      <?php echo form_open('templates/edit', array('class' => 'form-horizontal', 'id' => 'myform')); ?>
      <fieldset>

        <div class="control-group">
          <label class="control-label" for="typeahead">Name</label>

          <div class="controls">
            <input type="text" class="span6 typeahead" id="typeahead" name="document_name" value="<?php echo $template->name ?>">
          </div>
        </div>

        <div class="row-fluid sortable">
          <?php foreach($sections as $panel): ?>

            <?php echo $panel ?>

          <?php endforeach ?>
        </div>
        
        <div class="form-actions">
          <input type="hidden" name="document_id" value="<?php echo $template->id ?>">
          <button type="submit" class="btn btn-primary">Update</button>
          <a href="cancel"><input type="button" class="btn" name="cancel" value="Cancel" /></a>
        </div>



      </fieldset>
      </form>

    </div>

  </div>
  <!--/span-->



</div>

