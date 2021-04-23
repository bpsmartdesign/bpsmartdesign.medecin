<div class="row">
  <div class="col-md-8 col-md-offset-2 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>AJOUT NOUVEL UTILISATEUR <small>Formulaire relatif à l'ajout d'un nouvel utilsateur de la plateforme</small></h2>
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
          <?php $nom_complet = !empty($value) ? $value->nom_complet : ''; ?>
          <?php $username = !empty($value) ? $value->username : ''; ?>
          <?php $password = !empty($value) ? $value->password : ''; ?>
          <?php $localisation = !empty($value) ? $value->localisation : ''; ?>
          <?php $contact = !empty($value) ? $value->contact : ''; ?>
          <?php $niveau = !empty($value) ? $value->niveau : ''; ?>
          <?php $id = !empty($value) ? $value->id : ''; ?>

          <input type="hidden" name="table" value="user">
          <input type="hidden" name="id" value="<?= $id; ?>">
          <input type="hidden" name="oldName" value="<?= $username; ?>">

          <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
            <span class ='form-control-feedback left fa fa-sort'></span>
            <select name="niveau" class="form-control" style="padding: 0 42px">
              <?php if(!empty($value)) : ?>
                <?php if($niveau == 'patron') : ?>
                  <option value="personnel">Accès Limité</option>
                  <option value="patron" selected>Accès Total</option>
                <?php elseif($niveau == 'personnel') : ?>
                  <option value="personnel" selected>Accès Limité</option>
                  <option value="patron">Accès Total</option>
                <?php endif; ?>
              <?php else : ?>
                <option value="personnel">Accès Limité</option>
                <option value="patron">Accès Total</option>
              <?php endif; ?>
            </select>
          </div>

          <?= $form->input('nom_complet', 'user', 'text', '', '', $nom_complet, "Nom Complet de l Utilisateur"); ?>
          <?= $form->input('username', 'user', 'text', '', '', $username, "Pseudo"); ?>
          <?php if(empty($value)) : ?>
            <?= $form->input('password', 'user', 'text', '', '', '', "Mot de Passe"); ?>
          <?php endif; ?>
          <?= $form->input('localisation', 'map-marker', 'text', '', '', $localisation, 'Localisation'); ?>
          <?= $form->input('contact', 'phone', 'text', '', '', $contact, 'Contact'); ?>
          
          <div class="ln_solid"></div>
          <div class="form-group">
            <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
              <?php $action = isset($old) ? 'Modifier' : 'Ajouter'; ?>
              <?php $name = isset($old) ? 'modUser' : 'addUser'; ?>
              
              <?= $form->submit('reset', 'Reset', 'btn-default', 'reset'); ?>
              <?= $form->submit($name, $action, 'btn-success'); ?>
            </div>
          </div>

        </form>
      </div>
    </div>
</div>