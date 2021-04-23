<div class="col-md-12 col-sm-12 col-xs-12">
  <div class="x_panel">
    <div class="x_title">
      <h2>Liste du personnel à ExpHair</h2>
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
      <?php if(isset($err)) : ?>
        <div class="alert alert-danger alert-dismissible fade in">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <?= $err; ?>
        </div>
      <?php endif; ?>
      <?php if(isset($success)) : ?>
        <div class="alert alert-success alert-dismissible fade in">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <?= $success; ?>
        </div>
      <?php endif; ?>
      <form method="post" action="addElement">
        <input type="hidden" name="table" value="personnel">
        <input type="submit" name="newSpending" class="btn btn-success pull-right" value="Nouvel Employé">
      </form>
      <table id="datatable" class="table table-striped table-bordered">
        <thead>
          <tr>
            <th>Fonction</th>
            <th>Nom Complet</th>
            <th>Contact</th>
            <th>Localisation</th>
            <th>Salaire</th>
            <th>Date d'entrée</th>
            <?php if($_SESSION['ç_exphairauthorizationsdioamkpàaç_rsslnf'] == 99) : ?>
              <th>Actions</th>
            <?php endif; ?>
          </tr>
        </thead>

        <tbody>
          <?php foreach($personnels as $v) : ?>
            <?php if($v->statut == 1) : ?>
              <?php $fonction = $this->loadModel('fonction')->find($v->id_fonction_personnel); ?>
              <tr>
                <td><?= $fonction->designation; ?></td>
                <td><?= $v->nom_complet; ?></td>
                <td><?= $v->contact; ?></td>
                <td><?= $v->localisation; ?></td>
                <td><?= $v->salaire; ?></td>
                <td><?= $v->date_entree; ?></td>
                <?php if($_SESSION['ç_exphairauthorizationsdioamkpàaç_rsslnf'] == 99) : ?>
                  <td class="noDisturb">
                    <form class="inline" method="post" action="modElement">
                      <input type="hidden" name="table" value="personnel" />
                      <input type="hidden" name="id" value="<?= $v->id; ?>" />
                      <button type="submit" id="mod" class="act" name="modPersonnel"><span class="fa fa-edit"></span> Modifier</button>
                    </form>
                    <form class="inline" method="post" action="payer">
                      <input type="hidden" name="table" value="personnel" />
                      <input type="hidden" name="id" value="<?= $v->id; ?>" />
                      <button type="submit" id="sell" class="act" name="payerPersonnel"><span class="fa fa-forward"></span> Payer</button>
                    </form>
                    <form class="inline" method="post" action="virer">
                      <input type="hidden" name="table" value="personnel" />
                      <input type="hidden" name="id" value="<?= $v->id; ?>" />
                      <button type="submit" id="supp" class="act" name="virerPersonnel"><span class="fa fa-times"></span> Virer</button>
                    </form>
                  </td>
                <?php endif; ?>
              </tr>
            <?php endif; ?>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
