<div class="row-fluid sortable">
<div class="box span12">
<div class="box-header" data-original-title>
    <h2><i class="icon-user"></i><span class="break"></span>Members</h2>
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
        <span class="label label-success"><?php echo $document->status ?></span>
    </td>
    <td class="center">
        <a class="btn btn-success" href="#">
            <i class="icon-zoom-in icon-white"></i>
        </a>
        <a class="btn btn-info" href="#">
            <i class="icon-edit icon-white"></i>
        </a>
        <a class="btn btn-danger" href="#">
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
