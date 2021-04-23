<div class="row">
  <div class="col-md-8 col-md-offset-2 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>AJOUT NOUVEL EMPLOYE <small>Formulaire relatif à l'ajout d'un nouvel Employé</small></h2>
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
          <?php $id_fonction_personnel = !empty($value) ? $value->id_fonction_personnel : ''; ?>
          <?php $nom_complet = !empty($value) ? $value->nom_complet : ''; ?>
          <?php $localisation = !empty($value) ? $value->localisation : ''; ?>
          <?php $contact = !empty($value) ? $value->contact : ''; ?>
          <?php $date_entree = !empty($value) ? $value->date_entree : ''; ?>
          <?php $id = !empty($value) ? $value->id : ''; ?>

          <?php $fonctions = $this->loadModel('fonction')->all(); ?>

          <input type="hidden" name="table" value="personnel">
          <input type="hidden" name="id" value="<?= $id; ?>">
          <input type="hidden" name="oldName" value="<?= $nom_complet; ?>">

          <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
            <span class ='form-control-feedback left fa fa-sort'></span>
            <select name="id_fonction_personnel" class="form-control" style="padding: 0 42px">
              <?php foreach($fonctions as $v) : ?>
                <?php if($v->id == $id_fonction_personnel) : ?>
                  <option value="<?= $v->id; ?>" selected><?= ucfirst($v->designation); ?></option>
                <?php else : ?>
                  <option value="<?= $v->id; ?>"><?= ucfirst($v->designation); ?></option>
                <?php endif; ?>
              <?php endforeach; ?>
            </select>
          </div>

          <?= $form->input('nom_complet', 'user', 'text', '', '', $nom_complet, "Nom Complet de l Employé"); ?>
          <?= $form->input('localisation', 'map-marker', 'text', '', '', $localisation, 'Localisation'); ?>
          <?= $form->input('contact', 'phone', 'text', '', '', $contact, 'Contact'); ?>
          <?= $form->input('date_entree', 'calendar', 'date', '', '', $date_entree, 'Date Entrée'); ?>
          
          <div class="ln_solid"></div>
          <div class="form-group">
            <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
              <?php $action = isset($old) ? 'Modifier' : 'Ajouter'; ?>
              <?php $name = isset($old) ? 'modPersonnel' : 'addPersonnel'; ?>
              
              <?= $form->submit('reset', 'Reset', 'btn-default', 'reset'); ?>
              <?= $form->submit($name, $action, 'btn-success'); ?>
            </div>
          </div>

        </form>
      </div>
    </div>
</div>