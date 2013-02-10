

<div class="row-fluid sortable">
  <div class="box span12">
    <div class="box-header" data-original-title>
      <h2><i class="icon-edit"></i><span class="break"></span>Edit Article Content</h2>

      <div class="box-icon">
        <a href="#" class="btn-setting"><i class="icon-wrench"></i></a>
        <a href="#" class="btn-minimize"><i class="icon-chevron-up"></i></a>
        <a href="#" class="btn-close"><i class="icon-remove"></i></a>
      </div>
    </div>
    <div class="box-content">

      <?php echo form_open('articles/update', array('class' => 'form-horizontal', 'id' => 'myform')); ?>
      <fieldset>
        <div class="control-group">
          <label class="control-label" for="typeahead">Name</label>

          <div class="controls">
            <input type="text" class="span6 typeahead" id="typeahead" name="article_name" value="">
          </div>
        </div>

        <div class="control-group">
          <label class="control-label">Select a Template</label>

          <div class="controls">

            <select id="selectError3" name="template_id">

              <?php foreach ($templates as $template): ?>
                <option value="<?php echo $template->id ?>"><?php echo $template->name ?></option>
              <?php endforeach ?>

            </select>


          </div>
        </div>


        
        <div class="form-actions">
          <button type="submit" class="btn btn-primary">Update</button>
          <a href="cancel"><input type="button" class="btn" name="cancel" value="Cancel" /></a>
        </div>
      </fieldset>
      </form>

    </div>
  </div>
  <!--/span-->

</div>






