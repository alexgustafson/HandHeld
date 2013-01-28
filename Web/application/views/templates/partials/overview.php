<div class="row-fluid">
  <div class="box span12">
    <div class="box-header" data-original-title>
      <h2><i class="icon-briefcase"></i><span class="break"></span>Templates</h2>
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
          <th>Compostie</th>
          <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($templates as $template) : ?>
          <tr>
            <td><?php echo $template->name ?></td>
            <td class="center"><?php echo $template->isComposite ?></td>


            <td class="center">

              <a class="btn btn-info" href="edit/<?php echo $template->id ?>">
                <i class="icon-edit icon-white"></i>
              </a>
              <a class="btn btn-danger" href="delete/<?php echo $template->id ?>">
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
