<noscript>
  <div class="alert alert-block span10">
    <h4 class="alert-heading">Warning!</h4>

    <p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> enabled to
      use this site.</p>
  </div>
</noscript>
<?php if (sizeof($articles) > 0) : ?>
<?php foreach ($articles as $article) : ?>
<?php $startArticle = null ?>

<div id="content" class="span10">
  <!-- start: Content -->

  <div class="row-fluid">
    <div class="box span12">
      <div class="box-header" data-original-title>
        <h2>Article</h2>
      </div>

      <div class="box-content">

        <?php echo form_open('articles/modify', array('class' => 'form-horizontal', 'id' => 'myform')); ?>
        <fieldset>

          <div class="control-group">
            <label class="control-label" for="typeahead">Name</label>
            <div class="controls">
              <input type="text" class="span6" value="<?php echo $article->name ?>">

            </div>
          </div>

          <div class="control-group">
            <label class="control-label" for="selectError">Template</label>

            <div class="controls">
              <select id="selectError" name="articleType">
                <!-- <option>Select an article type</option> -->
                <?php foreach ($templates as $template) : ?>
                  <?php if ($template->id == $article->template_id) : ?>
                    <option value="<?php echo $template->id ?>" selected><?php echo  $template->name ?></option>
                  <?php else : ?>
                    <option value="<?php echo $template->id ?>"><?php echo  $template->name ?></option>
                  <?php endif ?>
                <?php endforeach?>
              </select>
            </div>
          </div>

          <div class="template_panels">

            <?php foreach($template_panels as $panel): ?>
              <?php echo $panel ?>
            <?php endforeach ?>

          </div>

          <div class="form-actions">
            <input type="hidden" name="article_id" value="<?php echo $article->id ?>">
            <input type="hidden" name="action" value="setType">
            <button type="submit" class="btn btn-primary">Update</button>
          </div>
        </fieldset>
        </form>


      </div>

    </div>
    <!--/span-->

  </div><!--/row-->



  <hr>




  <?php endforeach ?>
  <?php endif ?>

