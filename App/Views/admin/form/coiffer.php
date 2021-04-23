<div class="row">
  <div class="col-md-10 col-md-offset-1 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>COIFFER <small>Formulaire relatif à l'exécution d'une Coiffure</small></h2>
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

          <input type="hidden" name="url" value="<?= $_SERVER['HTTP_REFERER']; ?>">
          <?php if(isset($type)) : ?>
            <input type="hidden" name="type" value="<?= $type; ?>">
          <?php endif; ?>
          <input type="hidden" name="table" value="coiffure">
          <input type="hidden" name="action" value="action">
          <input type="hidden" name="nbr_coiffeur" value="<?= $coiffure->nbr_coiffeur; ?>">

          <?php
            $name = [];
            for($i = 0; $i<$coiffure->nbr_coiffeur; $i++) {
              $name[$i] = 'coiffeur_'.$i;
            }
          ?>

          <div class="col-md-8 col-sm-8 col-xs-8 form-group has-feedback"><?= $form->input('nom', 'cut', 'text', '', '', $coiffure->nom, "Nom de la Coiffure", '', '', 'readonly'); ?></div>
          <div class="col-md-4 col-sm-4 col-xs-4 form-group has-feedback"><?= $form->input('prix', 'money', 'text', '', '', $coiffure->prix, "", '', '', 'readonly'); ?></div>
          <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback"><?= $form->input('description', 'pencil', 'text', '', '', $coiffure->description, "", '', '', 'readonly'); ?></div>
          <?php for($i = 0; $i < $coiffure->nbr_coiffeur; $i ++) : ?>
            <div class="col-md-<?= floor(12 / $coiffure->nbr_coiffeur); ?> col-sm-6 col-xs-6 form-group has-feedback">
              <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                <span class ='form-control-feedback left fa fa-user'></span>
                <select name="<?= $name[$i] ?>" class="form-control" style="padding: 0 42px">
                  <?php foreach($personnels as $v) : ?>
                    <option value="<?= $v->id; ?>"><?= ucfirst($v->nom_complet); ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
          <?php endfor; ?>
          <?php for($i = 1; $i < $coiffure->nbr_produit + 1; $i ++) : ?>
            <?php if($coiffure->nbr_produit > 6) : ?>
              <div class="col-md-3 col-sm-6 col-xs-6 form-group has-feedback">
            <?php else : ?>
              <div class="col-md-<?= floor(12 / $coiffure->nbr_produit); ?> col-sm-6 col-xs-6 form-group has-feedback">
            <?php endif; ?>
              <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                <span class ='form-control-feedback left fa fa-recycle'></span>
                <select name="<?='produit_'.$i ?>" class="form-control" style="padding: 0 42px">
                  <?php foreach($produits as $v) : ?>
                    <option value="<?= $v->id; ?>"><?= ucfirst($v->nom); ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
          <?php endfor; ?>
          <div class="col-md-6 col-sm-6 col-xs-6 form-group has-feedback">
            <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
              <span class ='form-control-feedback left fa fa-users'></span>
              <select name="id_client" class="form-control" style="padding: 0 42px">
                <?php foreach($clients as $v) : ?>
                  <option value="<?= $v->id; ?>"><?= ucfirst($v->nom_complet); ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
          <div class="col-md-3 col-sm-3 col-xs-3 form-group has-feedback"><?= $form->input('avance', 'money', 'number', '', '', '', 'Avance du Client'); ?></div>
          <div class="col-md-3 col-sm-3 col-xs-3 form-group has-feedback"><?= $form->input('reste', 'money', 'number', '', '', '', 'Reste à payer'); ?></div>
          
          <div class="ln_solid"></div>
          <div class="form-group">
            <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
              <?= $form->submit('reset', 'Reset', 'btn-default', 'reset'); ?>
              <?= $form->submit('coiffer', 'Coiffer', 'btn-success'); ?>
            </div>
          </div>

        </form>
      </div>
    </div>
</div>