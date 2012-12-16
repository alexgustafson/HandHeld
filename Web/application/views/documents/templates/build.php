<noscript>
    <div class="alert alert-block span10">
        <h4 class="alert-heading">Warning!</h4>

        <p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> enabled to
            use this site.</p>
    </div>
</noscript>
<?php if (sizeof($documents) > 0) : ?>
<?php foreach ($documents as $document) : ?>

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
                    <a href="#"><?php echo $document->name ?></a>
                </li>
            </ul>
        </div>


        <div class="row-fluid">
            <div class="box span12">
                <div class="box-header" data-original-title>
                    <h2>Start Article</h2>


                    <div class="box-icon">
                        <a href="#" class="btn-add"><i class="icon-plus"></i></a>
                    </div>
                </div>

                <div class="box-content">

                  <?php echo form_open('documents/modify', array('class' => 'form-horizontal', 'id' => 'myform')); ?>
                    <fieldset>
                        <div class="control-group">
                            <label class="control-label" for="selectError">Article</label>

                            <div class="controls">
                                <select id="selectError" name="startArticleID">
                                    <option>Select an article</option>
                                  <?php foreach ($articles as $article) : ?>
                                  <?php if($article->id == $document->start_article) : ?>
                                    <option value="<?php echo $article->id ?>" selected><?php echo $article->id . ' ' . $article->name ?></option>
                                    <?php else : ?>
                                    <option value="<?php echo $article->id ?>"><?php echo $article->id . ' ' . $article->name ?></option>
                                    <?php endif ?>
                                  <?php endforeach?>
                                </select>
                            </div>
                        </div>
                        <div class="form-actions">
                            <input type="hidden" name="document_id" value="<?php echo $document->id ?>">
                            <input type="hidden" name="action" value="setStartArticle">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </fieldset>
                  </form>



                </div>

            </div>
            <!--/span-->

        </div><!--/row-->

        <hr>

        <div class="modal hide fade" id="myModalAdd">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h3>Create New Article</h3>
            </div>
          <?php echo form_open('documents/modify', array('class' => 'form-horizontal', 'id' => 'myform')); ?>

            <div class="modal-body">

                <div class="control-group">
                    <label class="control-label" for="article_name">Name</label>
                    <div class="controls">
                        <input type="text" class="span6 article_name" name="article_name">

                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="selectError2">Type</label>
                    <div class="controls">
                        <select id="selectError2" name="article_type">
                            <?php foreach($article_types as $type) : ?>
                              <option value='<?php echo $type->id ?>'><?php echo $type->type ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <input type="hidden" name="action" value="create_and_setStartArticle">
                <input type="hidden" name="document_id" value="<?php echo $document->id ?>">
                <a href="#" class="btn" data-dismiss="modal">Close</a>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
            </form>

        </div>

        <div class="clearfix"></div>
    <?php endforeach ?>
<?php endif ?>

