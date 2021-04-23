<div class="row">
  <div class="col-md-8 col-md-offset-2 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>AJOUT COIFFURE <small>Formulaire relatif à l'ajout d'une nouvelle Coiffure</small></h2>
        <ul class="nav navbar-right panel_toolbox">
          <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
          </li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
            <ul class="dropdown-menu" role="menu">
              <li><a href="#">Settings 1</a>
              </li>
              <li><a href="#">Settings 2</a>
              </li>
            </ul>
          </li>
          <li><a class="close-link"><i class="fa fa-close"></i></a>
          </li>
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <br />
        <form class="form-horizontal form-label-left input_mask" method="post" action="__controlElement">

          <?php $value = isset($old) ? $old : ''; ?>
          <?php $nom = !empty($value) ? $value->nom : ''; ?>
          <?php $prix = !empty($value) ? $value->prix : ''; ?>
          <?php $description = !empty($value) ? $value->description : ''; ?>
          <?php $nbr_coiffeur = !empty($value) ? $value->nbr_coiffeur : ''; ?>
          <?php $nbr_produit = !empty($value) ? $value->nbr_produit : ''; ?>
          <?php $type = !empty($value) ? $value->type : ''; ?>
          <?php $id = !empty($value) ? $value->id : ''; ?>

          <input type="hidden" name="table" value="coiffure">
          <input type="hidden" name="id" value="<?= $id; ?>">
          <input type="hidden" name="oldName" value="<?= $nom; ?>">

          <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
            <span class ='form-control-feedback left fa fa-user'></span>
            <select name="type" class="form-control" style="padding: 0 42px">
              <?php if(!empty($value)) : ?>
                <?php if($type == 'homme') : ?>
                  <option value="homme" selected>Coiffure Homme</option>
                  <option value="femme">Coiffure Femme</option>
                  <option value="enfant">Coiffure Enfant</option>
                <?php elseif($type == 'femme') : ?>
                  <option value="homme">Coiffure Homme</option>
                  <option value="femme" selected>Coiffure Femme</option>
                  <option value="enfant">Coiffure Enfant</option>
                <?php else : ?>
                  <option value="homme">Coiffure Homme</option>
                  <option value="femme">Coiffure Femme</option>
                  <option value="enfant" selected>Coiffure Enfant</option>
                <?php endif; ?>
              <?php else : ?>
                <option value="homme">Coiffure Homme</option>
                <option value="femme">Coiffure Femme</option>
                <option value="enfant">Coiffure Enfant</option>
              <?php endif; ?>
            </select>
          </div>

          <?= $form->input('nom', 'cut', 'text', '', '', $nom, "Nom de la Coiffure"); ?>
          <?= $form->input('prix', 'money', 'number', '', '', $prix, 'Prix de la Coiffure'); ?>
          <?= $form->input('description', 'pencil', 'text', '', '', $description, 'Description de la Coiffure'); ?>
          <?= $form->input('nbr_coiffeur', 'users', 'number', '', '', $nbr_coiffeur, 'Nombre coiffeurs requis'); ?>
          <?= $form->input('nbr_produit', 'sort', 'number', '', '', $nbr_produit, 'Nombre Produits Necessaires'); ?>
          
          <div class="ln_solid"></div>
          <div class="form-group">
            <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
              <?php $action = isset($old) ? 'Modifier' : 'Ajouter'; ?>
              <?php $name = isset($old) ? 'modCoiffure' : 'addCoiffure'; ?>
              
              <?= $form->submit('reset', 'Reset', 'btn-default', 'reset'); ?>
              <?= $form->submit($name, $action, 'btn-success'); ?>
            </div>
          </div>

        </form>
      </div>
    </div>
</div>