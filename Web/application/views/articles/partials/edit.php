<?php if(sizeof($articles) > 0): ?>
  <?php foreach($articles as $article): ?>

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
            <input type="text" class="span6 typeahead" id="typeahead" name="article_name" value="<?php echo $article->name ?>">
          </div>
        </div>

        <div class="template_panels">

          <?php foreach($template_panels as $panel): ?>
            <?php echo $panel ?>
          <?php endforeach ?>

        </div>
        
        <div class="form-actions">
          <input type="hidden" name="article_id" value="<?php echo $article->id ?>">
          <button type="submit" class="btn btn-primary">Update</button>
          <a href="cancel"><input type="button" class="btn" name="cancel" value="Cancel" /></a>
        </div>
      </fieldset>
      </form>

    </div>
  </div>
  <!--/span-->

</div>
<?php endforeach ?>
<?php endif ?>

<div class="modal-image-selector hide fade" id="myModalSelectFile">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">×</button>
    <h3>Select File</h3>
  </div>


  <fieldset>
    <div class="modal-body">

      <div class="box-content">
        <!-- <div class="masonry-gallery"> -->
          <!-- <div id="image-1" class="masonry-thumb"> -->

        <?php foreach($images as $image): ?>

              <a style="background:url(<?php echo '/uploads/' . $image->filename ?>);max-width: 300px" title="<?php echo $image->filename ?>"><img class="image-select" src="<?php echo base_url("uploads/". $image->filename); ?>" alt="<?php echo $image->filename ?>"></a>

        <?php endforeach ?>

          <!-- </div> -->
        <!-- </div> -->

      </div>


    </div>

    <div class="modal-footer">
      <a href="#" class="btn" data-dismiss="modal">Close</a>
      <button type="submit" class="btn btn-primary">Select</button>
    </div>

  </fieldset>


</div>



