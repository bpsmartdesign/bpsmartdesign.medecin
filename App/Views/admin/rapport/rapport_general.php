<?php
  $initial_date = isset($_POST['initial_date']) ? $_POST['initial_date'] : '0000-00-00';
  $final_date = isset($_POST['final_date']) ? $_POST['final_date'] : '0000-00-00';
?>
<?php if(isset($success)) : ?>
  <div class="alert alert-success alert-dismissible fade in">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <?= $success; ?>
  </div>
<?php endif; ?>

<div class="col-md-12 col-sm-12 col-xs-12">
  <div class="x_panel">
    <div class="x_title">
      <h2>Rapport des Entrées et Sorties pour le Bar</h2>
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
      <form class="form-horizontal form-label-left input_mask special_form" method="post" action="">
          <div class="col-md-3 col-md-offset-2"><?= $form->input('initial_date', 'calendar', 'date', '', '', $initial_date, 'From'); ?></div>
          <div class="col-md-3"><?= $form->input('final_date', 'calendar', 'date', '', '', $final_date, 'From'); ?></div>
          <div class="col-md-1"><?= $form->submit('submit', 'Show', 'btn-info', 'submit'); ?></div>
          <div class="col-md-1"><button id='printButton' value="print" class="btn btn-warning"><i class="fa fa-print"></i> Print</button> </div>
      </form>
      <table id="datatable" class="table table-striped table-bordered">
        <thead>
          <tr>
            <th>Date</th>
            <th>Heure</th>
            <th>Description</th>
            <th>Auteur</th>
            <th>Qté * P. Unitaire</th>
            <th>Revenu</th>
            <th>Dépense</th>
            <th>Balance</th>
          </tr>
        </thead>

        <tbody>
          <?php $balance = 0; ?>
          <?php foreach($logs as $v) : ?>
            <?php $auteur = $this->loadModel('user')->find($v->id_auteur); ?>
            <?php if($v->date >= $initial_date AND $v->date <= $final_date) : ?>
              <tr>
                <td><?= $v->date; ?></td>
                <td><?= $v->heure; ?></td>
                <td><?= $v->nom; ?> (<?= ucfirst($v->elt) ?>)</td>
                <td><?= $auteur->nom_complet; ?> (<?= $auteur->username; ?>)</td>
                <td><?= $v->qte; ?> * <?= $v->prix ?></td>
                <?php if($v->action == 'vente') : ?>
                  <td><?= $v->prix * $v->qte; ?> Frs</td>
                  <td>/////</td>
                  <?php $balance += $v->prix * $v->qte; ?>
                <?php elseif($v->action == 'achat') : ?>
                  <td>/////</td>
                  <td><?= $v->prix * $v->qte; ?> Frs</td>
                  <?php $balance -= $v->prix * $v->qte; ?>
                <?php endif; ?>
                <td><?= $balance; ?></td>
              </tr>
            <?php else : ?>
            <?php endif; ?>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<script type="text/javascript">
  var button = document.querySelector('#printButton');
  button.addEventListener('click', function(e) {
    e.preventDefault();
    e.stopPropagation();
    window.print();
  });
</script>