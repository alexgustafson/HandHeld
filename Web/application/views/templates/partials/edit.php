
<div class="row-fluid">
  <div class="box span12">
    <div class="box-header" data-original-title>
      <h2><i class="icon-edit"></i><span class="break"></span>Edit Template</h2>

      <div class="box-icon">
        <a href="#" class="btn-add-template"><i class="icon-plus"></i></a>

      </div>
    </div>
    <div class="box-sortable">

      <?php echo form_open('templates/edit', array('class' => 'form-horizontal', 'id' => 'myform')); ?>
      <fieldset>

        <div class="control-group">
          <label class="control-label" for="typeahead">Name</label>

          <div class="controls">
            <input type="text" class="span6 typeahead" name="template_name" value="<?php echo $template->name ?>">
          </div>
        </div>

        <div class="row-fluid sortable">
          <?php foreach($sections as $panel): ?>

            <?php echo $panel ?>

          <?php endforeach ?>
        </div>
        
        <div class="form-actions">
          <input type="hidden" name="template_id" value="<?php echo $template->id ?>">
          <button type="submit" class="btn btn-primary">Update</button>
          <a href="cancel"><input type="button" class="btn" name="cancel" value="Cancel" /></a>
        </div>



      </fieldset>
      </form>

    </div>

  </div>
  <!--/span-->



</div>

<div class="modal hide fade" id="myModalAddTemplate">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">×</button>
    <h3>Add Field or Subtemplate</h3>
  </div>
  <?php echo form_open('templates/addField', array('class' => 'form-horizontal', 'id' => 'addField')); ?>

    <fieldset>
      <div class="modal-body">

        <div class="control-group">
          <label class="control-label" for="typeahead">Name</label>

          <div class="controls">
            <input type="text" class="span6 typeahead" name="name" value="">
          </div>
        </div>

        <div class="control-group">
          <label class="control-label" for="selectError3">Plain Select</label>
          <div class="controls">
            <select id="selectError3" name="field_id">

              <?php foreach ($fields as $field): ?>
                <option value="field|<?php echo $field->id ?>"><?php echo $field->name ?></option>
              <?php endforeach ?>
              <!-- <?php foreach ($templates as $subtemplate): ?>
                <option value="template|<?php echo $subtemplate->id ?>"><?php echo $subtemplate->name ?></option>
              <?php endforeach ?> -->

            </select>
          </div>
        </div>
      </div>

      <div class="modal-footer">
        <a href="#" class="btn" data-dismiss="modal">Close</a>
        <input type="hidden" name="template_id" value="<?php echo $template->id ?>">
        <button type="submit" class="btn btn-primary">Add Field</button>
      </div>

    </fieldset>

  </form>
</div>