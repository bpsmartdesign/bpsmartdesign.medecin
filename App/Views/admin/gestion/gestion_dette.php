<div class="col-md-12 col-sm-12 col-xs-12">
  <div class="x_panel">
    <div class="x_title">
      <h2>Gestion des Dettes des clients d'ExpHair</h2>
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
      <table id="datatable" class="table table-striped table-bordered">
        <thead>
          <tr>
            <th>id</th>
            <th>Nom du Client</th>
            <th>Date Emprunt</th>
            <th>Montant Dette</th>
            <th>Actions</th>
          </tr>
        </thead>

        <tbody>
          <?php foreach($dettes as $v) : ?>
            <?php $client = $this->loadModel('client')->find($v->id_client); ?>
            <?php $col = $this->loadModel('dette')->findClient($v->id_client); ?>
            <tr>
              <td><?= $v->id; ?></td>
              <td><?= $client->nom_complet; ?></td>
              <td><?= $v->date; ?></td>
              <td><?= $v->montant; ?></td>
              <td class="noDisturb">
                <form class="inline" method="post" action="rembourserDette">
                  <input type="hidden" name="table" value="dette" />
                  <input type="hidden" name="id" value="<?= $v->id; ?>" />
                  <button type="submit" id="sell" class="act" name="moddette"><span class="fa fa-forward"></span> Rembourser</button>
                </form>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
