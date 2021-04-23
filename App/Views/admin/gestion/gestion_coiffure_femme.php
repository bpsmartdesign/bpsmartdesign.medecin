<div class="col-md-12 col-sm-12 col-xs-12">
  <div class="x_panel">
    <div class="x_title">
      <h2>Gestion Coiffure des Hommes</h2>
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
        <input type="hidden" name="table" value="coiffure">
        <input type="hidden" name="type" value="homme">
        <input type="submit" name="newCoiffure" class="btn btn-success pull-right" value="+ Coiffure">
      </form>
      <table id="datatable" class="table table-striped table-bordered">
        <thead>
          <tr>
            <th>Nom Coiffure</th>
            <th>Prix </th>
            <th>Description</th>
            <th>Nbr Coiffeurs</th>
            <th>Actions</th>
          </tr>
        </thead>

        <tbody>
          <?php foreach($coiffures as $v) : ?>
            <?php if($v->type == 'femme') : ?>
              <tr>
                <td><?= $v->nom ?></td>
                <td><?= $v->prix; ?></td>
                <td><?= $v->description; ?></td>
                <td><?= $v->nbr_coiffeur; ?></td>
                <td class="noDisturb">
                  <?php if($_SESSION['ç_exphairauthorizationsdioamkpàaç_rsslnf'] == 99) : ?>
                    <form class="inline" method="post" action="modElement">
                      <input type="hidden" name="table" value="coiffure" />
                      <input type="hidden" name="id" value="<?= $v->id; ?>" />
                      <button type="submit" id="mod" class="act" name="modCoiffure"><span class="fa fa-edit"></span> Modifier</button>
                    </form>
                    <form class="inline" method="post" action="delElement">
                      <input type="hidden" name="table" value="coiffure" />
                      <input type="hidden" name="id" value="<?= $v->id; ?>" />
                      <button type="submit" id="supp" class="act" name="delCoiffure"><span class="fa fa-times"></span> Supprimer</button>
                    </form>
                  <?php endif; ?>
                  <?php if($_SESSION['ç_exphairauthorizationsdioamkpàaç_rsslnf'] == 1) : ?>
                    <form class="inline" method="post" action="coiffer">
                      <input type="hidden" name="table" value="coiffure" />
                      <input type="hidden" name="id" value="<?= $v->id; ?>" />
                      <input type="hidden" name="nbr_coiffeur" value="<?= $v->nbr_coiffeur; ?>" />
                      <input type="hidden" name="nbr_produit" value="<?= $v->nbr_produit; ?>" />
                      <input type="hidden" name="type" value="<?= $v->type; ?>" />
                      <button type="submit" id="sell" class="act" name="sellCoiffure"><span class="fa fa-forward"></span> Coiffer</button>
                    </form>
                  <?php endif; ?>
                </td>
              </tr>
            <?php endif; ?>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>