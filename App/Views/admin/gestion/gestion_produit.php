<?php //var_dump(time()); die(); ?>
<div class="col-md-12 col-sm-12 col-xs-12">
  <div class="x_panel">
    <div class="x_title">
      <h2>Gestion des Produits à ExpHair</h2>
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
        <input type="hidden" name="table" value="produit">
        <input type="submit" name="newProduit" class="btn btn-success pull-right" value="+ Produit">
      </form>
      <table id="datatable" class="table table-striped table-bordered">
        <thead>
          <tr>
            <th>Nom</th>
            <th>Description</th>
            <th>Prix d'achat</th>
            <th>Dernier achat</th>
            <th>Statut</th>
            <th>Actions</th>
          </tr>
        </thead>

        <tbody>
          <?php foreach($produits as $v) : ?>
            <tr>
              <td><?= $v->nom ?></td>
              <td><?= $v->description; ?></td>
              <td><?= $v->prix; ?> Frs</td>
              <td><?= $v->date_achat; ?></td>
              <?php if($v->statut == 1) : ?>
                <td>Disponible</td>
              <?php else : ?>
                <td>Fini</td>
              <?php endif; ?>
              <td class="noDisturb">
                <?php if($v->statut != 1) : ?>
                  <form class="inline" method="post" action="buyProduit">
                    <input type="hidden" name="table" value="produit" />
                    <input type="hidden" name="id" value="<?= $v->id; ?>" />
                    <input type="hidden" name="nom" value="<?= $v->nom; ?>" />
                    <input type="hidden" name="prix" value="<?= $v->prix; ?>" />
                    <button type="submit" id="buy" class="act" name="buyProduit"><span class="fa fa-plus"></span> Acheter</button>
                  </form>
                <?php endif; ?>
                <?php if($_SESSION['ç_exphairauthorizationsdioamkpàaç_rsslnf'] == 99) : ?>
                  <form class="inline" method="post" action="modElement">
                    <input type="hidden" name="table" value="produit" />
                    <input type="hidden" name="id" value="<?= $v->id; ?>" />
                    <button type="submit" id="mod" class="act" name="modProduit"><span class="fa fa-edit"></span> Modifier</button>
                  </form>
                  <form class="inline" method="post" action="delElement">
                    <input type="hidden" name="table" value="produit" />
                    <input type="hidden" name="id" value="<?= $v->id; ?>" />
                    <button type="submit" id="supp" class="act" name="delProduit"><span class="fa fa-times"></span> Supprimer</button>
                  </form>
                <?php endif; ?>
                <?php if($_SESSION['ç_exphairauthorizationsdioamkpàaç_rsslnf'] == 1) : ?>
                  <?php if($v->statut == 1) : ?>
                    <form class="inline" method="post" action="finirProduit">
                      <input type="hidden" name="table" value="produit" />
                      <input type="hidden" name="id" value="<?= $v->id; ?>" />
                      <button type="submit" id="sell" class="act" name="finirProduit"><span class="fa fa-forward"></span> Indisponible</button>
                    </form>
                  <?php endif; ?>
                <?php endif; ?>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>