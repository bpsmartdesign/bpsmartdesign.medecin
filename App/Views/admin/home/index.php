<?php if(isset($success)) : ?>
  <div class="alert alert-success alert-dismissible fade in">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <?= $success; ?>
  </div>
<?php endif; ?>

<div class="row tile_count">
  <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
    <span class="count_top"><i class="fa fa-user"></i> Total Clients</span>
    <div class="count">236</div>
    <span class="count_bottom"><i class="green">+9 </i> Cette Semaine</span>
  </div>
  <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
    <span class="count_top"><i class="fa fa-clock-o"></i> Montant Généré</span>
    <div class="count green">248,550</div>
    <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>3% </i> Cette Semaine</span>
  </div>
  <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
    <span class="count_top"><i class="fa fa-user"></i> Montant Depensé</span>
    <div class="count red">2,500</div>
    <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> Cette Semaine</span>
  </div>
  <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
    <span class="count_top"><i class="fa fa-user"></i> Dettes Clients</span>
    <div class="count yellow">4,550</div>
    <span class="count_bottom"><i class="red"><i class="fa fa-sort-desc"></i>12% </i> Cette Semaine</span>
  </div>
  <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
    <span class="count_top"><i class="fa fa-user"></i> Solde En Caisse</span>
    <div class="count blue">220,315</div>
    <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> Cette Semaine</span>
  </div>
  <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
    <span class="count_top"><i class="fa fa-user"></i> Nombre Employés</span>
    <div class="count aero">7</div>
    <span class="count_bottom"><i class="green">+0 </i> Cette Semaine</span>
  </div>
</div>

<div class="row">
  <div class="col-md-12">
    <div class="x_panel elt">
      <div class="x_title">
        <h2>Possible Graphique illustratif <small>Non Opérationnel</small></h2>
        <div class="filter">
          <div id="reportrange" class="pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc">
            <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
            <span>December 30, 2014 - January 28, 2015</span> <b class="caret"></b>
          </div>
        </div>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <div class="col-md-9 col-sm-12 col-xs-12">
          <div class="demo-container" style="height:280px">
            <div id="chart_plot_02" class="demo-placeholder"></div>
          </div>
        </div>

        <div class="col-md-3 col-sm-12 col-xs-12">
          <div>
            <div class="x_title">
              <h2>Top Clients</h2>
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
            <ul class="list-unstyled top_profiles scroll-view">
              <li class="media event">
                <a class="pull-left border-blue profile_thumb">
                  <i class="fa fa-user blue"></i>
                </a>
                <div class="media-body">
                  <a class="title" href="#">Nom Client</a>
                  <p><strong>Coiffure</strong> 20/09/18 </p>
                  <p> <small>32 coiffures au Total</small>
                  </p>
                </div>
              </li>
              <li class="media event">
                <a class="pull-left border-green profile_thumb">
                  <i class="fa fa-user green"></i>
                </a>
                <div class="media-body">
                  <a class="title" href="#">Nom Client</a>
                  <p><strong>Coiffure</strong> 20/09/18 </p>
                  <p> <small>27 coiffures au Total</small>
                  </p>
                </div>
              </li>
              <li class="media event">
                <a class="pull-left border-aero profile_thumb">
                  <i class="fa fa-user aero"></i>
                </a>
                <div class="media-body">
                  <a class="title" href="#">Nom Client</a>
                  <p><strong>Coiffure</strong> 20/09/18 </p>
                  <p> <small>18 coiffures au Total</small>
                  </p>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>