<noscript>
    <div class="alert alert-block span10">
        <h4 class="alert-heading">Warning!</h4>
        <p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> enabled to use this site.</p>
    </div>
</noscript>
  <?php if (sizeof($documents) > 0) : ?>
  <?php foreach($documents as $document) : ?>

			<div id="content" class="span10">
          <!-- start: Content -->

          <div>
              <ul class="breadcrumb">
                  <li>
                      <a href="<?php echo base_url() ?>documents/">Documents</a> <span class="divider">/</span>
                  </li>
                  <li>
                      <a href="#"><?php echo $action ?></a> <span class="divider">/</span>
                  </li>
                  <li>
                      <a href="#"><?php echo $document->id ?></a>
                  </li>
              </ul>
          </div>
          <div class="sortable row-fluid">

              <div class="box-small span2">

              </div>

              <div class="box-small span2">

              </div>

              <div class="box-small span2">

              </div>

              <div class="box-small span2">

              </div>

          </div>

          <hr>




          <div class="row-fluid">
              <div class="box span12">
                  <div class="box-header" data-original-title>
                      <h2><i class="icon-edit"></i><span class="break"></span>Start Article</h2>



                      <div class="box-icon">

                      </div>
                  </div>

                  <div class="box-content">

                    <?php echo form_open('documents/create', array('class' => 'form-horizontal', 'id' => 'myform')); ?>
                      <fieldset>
                          <div class="control-group">
                              <label class="control-label" for="selectError">Article</label>
                              <div class="controls">
                                  <select id="selectError" data-rel="chosen">
                                      <option>Select an article</option>
                                      <option>Option 1</option>
                                      <option>Option 2</option>
                                      <option>Option 3</option>
                                      <option>Option 4</option>
                                      <option>Option 5</option>
                                  </select>
                              </div>
                          </div>
                          <div class="form-actions">
                              <button type="submit" class="btn btn-primary">Update</button>
                              <button type="reset" class="btn">Cancel</button>
                          </div>
                      </fieldset>
                      </form>

                  </div>

              </div>
              <!--/span-->

          </div><!--/row-->
        <?php endforeach ?>
      <?php endif ?>