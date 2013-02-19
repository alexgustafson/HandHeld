<div class="row-fluid">
<div class="box span12">
<div class="box-header" data-original-title>
    <h2><i class="icon-briefcase"></i><span class="break"></span>Documents</h2>
    <div class="box-icon">
        <a href="#" class="btn-setting"><i class="icon-wrench"></i></a>
        <a href="#" class="btn-minimize"><i class="icon-chevron-up"></i></a>
        <a href="#" class="btn-close"><i class="icon-remove"></i></a>
    </div>
</div>
<div class="box-content">
<table class="table table-striped table-bordered bootstrap-datatable datatable">
<thead>
<tr>
    <th>Name</th>
    <th>Version</th>
    <th>Publication Date</th>
    <th>Status</th>
    <th>Actions</th>
</tr>
</thead>
<tbody>
<?php foreach($documents as $document) : ?>
<tr>
    <td><?php echo $document->name ?></td>
    <td class="center"><?php echo $document->version ?></td>
    <td class="center"><?php echo $document->last_publication_date ?></td>
    <td class="center">
        <?php if($document->status == "Online") : ?>
        <span class="label label-success"><?php echo $document->status ?></span>
        <?php else: ?>
        <span class="label"><?php echo $document->status ?></span>
        <?php endif ?>
    </td>
    <td class="center">
        <a class="btn btn-success" href="publish/<?php echo $document->id ?>">
        <i class="icon-share icon-white"></i>
        </a>
        <a class="btn btn-info" href="build/<?php echo $document->id ?>">
            <i class="icon-zoom-in icon-white"></i>
        </a>
        <a class="btn btn-info" href="edit/<?php echo $document->id ?>">
            <i class="icon-edit icon-white"></i>
        </a>
        <a class="btn btn-danger" href="delete/<?php echo $document->id ?>">
            <i class="icon-trash icon-white"></i>
        </a>
    </td>
</tr>
<?php endforeach ?>
</tbody>
</table>
</div>
</div><!--/span-->

</div><!--/row-->
