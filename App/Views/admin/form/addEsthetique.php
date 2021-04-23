<div class="row">
  <div class="col-md-8 col-md-offset-2 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>AJOUT MODELE ESTHETIQUE <small>Formulaire relatif à l'ajout d'un nouveau modèle esthétique</small></h2>
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
          <?php $id = !empty($value) ? $value->id : ''; ?>

          <input type="hidden" name="table" value="esthetique">
          <input type="hidden" name="id" value="<?= $id; ?>">
          <input type="hidden" name="oldName" value="<?= $nom; ?>">

          <?= $form->input('nom', 'cut', 'text', '', '', $nom, "Nom du Modèle"); ?>
          <?= $form->input('prix', 'money', 'number', '', '', $prix, 'Prix du Modèle'); ?>
          <?= $form->input('description', 'pencil', 'text', '', '', $description, 'Description du Modèle'); ?>
          <?= $form->input('nbr_coiffeur', 'users', 'number', '', '', $nbr_coiffeur, 'Nombre coiffeurs requis'); ?>
          <?= $form->input('nbr_produit', 'sort', 'number', '', '', $nbr_produit, 'Nombre Produits Necessaires'); ?>
          
          <div class="ln_solid"></div>
          <div class="form-group">
            <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
              <?php $action = isset($old) ? 'Modifier' : 'Ajouter'; ?>
              <?php $name = isset($old) ? 'modEsthetique' : 'addEsthetique'; ?>
              
              <?= $form->submit('reset', 'Reset', 'btn-default', 'reset'); ?>
              <?= $form->submit($name, $action, 'btn-success'); ?>
            </div>
          </div>

        </form>
      </div>
    </div>
</div>