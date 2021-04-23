<div class="row">
  <div class="col-md-8 col-md-offset-2 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>AJOUT D'UNE NOUVELLE FONCTION <small>Formulaire relatif à l'ajout d'une nouvelle fonction pour le personnel</small></h2>
        <ul class="nav navbar-right panel_toolbox">
          <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
            <ul class="dropdown-menu" role="menu">
              <li><a href="#">Settings 1</a></li>
              <li><a href="#">Settings 2</a></li>
            </ul>
          </li>
          <li><a class="close-link"><i class="fa fa-close"></i></a></li>
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <br />
        <form class="form-horizontal form-label-left input_mask" method="post" action="__controlElement">

          <?php $value = isset($old) ? $old : ''; ?>
          <?php $designation = !empty($value) ? $value->designation : ''; ?>
          <?php $description = !empty($value) ? $value->description : ''; ?>
          <?php $salaire_de_base = !empty($value) ? $value->salaire_de_base : ''; ?>
          <?php $id = !empty($value) ? $value->id : ''; ?>

          <input type="hidden" name="table" value="fonction">
          <input type="hidden" name="oldName" value="<?= $designation; ?>">
          <input type="hidden" name="id" value="<?= $id; ?>">

          <?= $form->input('designation', 'bolt', 'text', '', '', $designation, 'Désignation'); ?>
          <?= $form->input('description', 'pencil', 'text', '', '', $description, 'Description de la fonction'); ?>
          <?= $form->input('salaire_de_base', 'money', 'number', '', '', $salaire_de_base, 'Salaire de Base'); ?>
          
          <div class="ln_solid"></div>
          <div class="form-group">
            <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
              <?php $action = isset($old) ? 'Modifier' : 'Ajouter'; ?>
              <?php $name = isset($old) ? 'modFonction' : 'addFonction'; ?>
              
              <?= $form->submit('reset', 'Reset', 'btn-default', 'reset'); ?>
              <?= $form->submit($name, $action, 'btn-success'); ?>
            </div>
          </div>

        </form>
      </div>
    </div>
</div>