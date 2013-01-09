<div class="controls">
    <select id="" name="startArticleID">
        <option>Select an article</option>
      <?php foreach ($articles as $article) : ?>
      <?php if ($article->id == $document->start_article) : ?>
        <?php $startArticle = $article ?>
            <option value="<?php echo $article->id ?>"
                    selected><?php echo $article->id . ' ' . $article->name ?></option>
        <?php else : ?>
            <option value="<?php echo $article->id ?>"><?php echo $article->id . ' ' . $article->name ?></option>
        <?php endif ?>
      <?php endforeach?>
    </select>
</div>