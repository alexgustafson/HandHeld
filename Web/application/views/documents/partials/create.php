<?php if (sizeof($documents) == 0) : ?>

<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header" data-original-title>
            <h2><i class="icon-edit"></i><span class="break"></span>Create Document</h2>

            <div class="box-icon">
                <a href="#" class="btn-setting"><i class="icon-wrench"></i></a>
                <a href="#" class="btn-minimize"><i class="icon-chevron-up"></i></a>
                <a href="#" class="btn-close"><i class="icon-remove"></i></a>
            </div>
        </div>
        <div class="box-content">

          <?php echo form_open('documents/create', array('class' => 'form-horizontal', 'id' => 'myform')); ?>
            <fieldset>
                <div class="control-group">
                    <label class="control-label" for="typeahead">Name</label>

                    <div class="controls">
                        <input type="text" class="span6 typeahead" id="typeahead" name="document_name"'>
                    </div>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Create</button>
                    <button type="reset" class="btn">Cancel</button>
                </div>
            </fieldset>
            </form>

        </div>
    </div>
    <!--/span-->

</div><!--/row-->

<?php elseif(sizeof($documents) > 0) : ?>
  <?php foreach($documents as $document): ?>

    <div class="row-fluid sortable">
        <div class="box span12">
            <div class="box-header" data-original-title>
                <h2><i class="icon-edit"></i><span class="break"></span>Edit Document</h2>

                <div class="box-icon">
                    <a href="#" class="btn-setting"><i class="icon-wrench"></i></a>
                    <a href="#" class="btn-minimize"><i class="icon-chevron-up"></i></a>
                    <a href="#" class="btn-close"><i class="icon-remove"></i></a>
                </div>
            </div>
            <div class="box-content">

              <?php echo form_open('documents/edit', array('class' => 'form-horizontal', 'id' => 'myform')); ?>
                <fieldset>
                    <div class="control-group">
                        <label class="control-label" for="typeahead">Name</label>

                        <div class="controls">
                            <input type="text" class="span6 typeahead" id="typeahead" name="document_name" value="<?php echo $document->name ?>">
                        </div>
                    </div>
                  <div class="control-group">
                    <label class="control-label" for="typeahead">Version</label>

                    <div class="controls">
                      <input type="text" class="span6 typeahead" id="typeahead" name="version" value="<?php echo $document->version ?>">
                    </div>
                  </div>
                    <div class="form-actions">
                        <input type="hidden" name="document_id" value="<?php echo $document->id ?>">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="cancel"><input type="button" class="btn" name="cancel" value="Cancel" /></a>
                    </div>
                </fieldset>
                </form>

            </div>
        </div>
        <!--/span-->

    </div><!--/row-->
  <?php endforeach ?>
<?php endif ?>