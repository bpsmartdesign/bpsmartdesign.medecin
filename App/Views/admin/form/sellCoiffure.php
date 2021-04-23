<div class="row">
  <div class="col-md-8 col-md-offset-2 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>VENDRE TELEPHONE<small>Formulaire relatif à la vente d'un Téléphone</small></h2>
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
        <form class="form-horizontal form-label-left input_mask" method="post" action="__sell">

          <?php $nom = $elt->nom; ?>
          <?php $prix_achat = $elt->prix_achat; ?>
          <?php $prix_vente = $elt->prix_vente; ?>
          <?php $qte_dispo = $elt->qte; ?>
          <?php $id = $elt->id; ?>

          <input type="hidden" name="table" value="telephone">
          <input type="hidden" name="id" value="<?= $id; ?>">

          <?= $form->input('nom', 'user', 'text', '', '', $nom, "Nom du Téléphone", '', '', 'readonly'); ?>
          <?= $form->input('prix_achat', 'money', 'number', '', '', $prix_achat, 'Prix d Achat', '', '', 'readonly'); ?>
          <?= $form->input('prix_vente', 'money', 'number', '', '', $prix_vente, 'Prix de Vente', '', '', 'readonly'); ?>
          <?= $form->input('qte_dispo', 'sort', 'number', '', '', $qte_dispo, 'Quantité disponible', '', '', 'readonly'); ?>
          <?= $form->input('prix_vendu', 'money', 'number', '', '', '', 'Prix Vendu', $prix_achat); ?>
          <?= $form->input('qte_vendu', 'sort', 'number', '', '', '', 'Quantité Vendu', '1', $qte_dispo); ?>
          
          <div class="ln_solid"></div>
          <div class="form-group">
            <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
              <?= $form->submit('sellElement', 'Vendre', 'btn-success'); ?>
            </div>
          </div>

        </form>
      </div>
    </div>
</div>