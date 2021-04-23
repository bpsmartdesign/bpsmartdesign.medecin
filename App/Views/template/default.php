<!-- 

Website Name: bpsmartdesign.medecine.test
Version: 1.0.0
Author: bpsmartdesign
Contact: bpsmartdesign@hotmail.com
Follow: ...
License: MIT.

-->

<!DOCTYPE html>
<!--[if lt IE 9 ]><html lang="en" dir="ltr" class="no-js ie-old"> <![endif]-->
<!--[if IE 9 ]><html lang="en" dir="ltr" class="no-js ie9"> <![endif]-->
<!--[if IE 10 ]><html lang="en" dir="ltr" class="no-js ie10"> <![endif]-->
<!--[if (gt IE 10)|!(IE)]><!-->
<html lang="en" dir="ltr" class="no-js">
<!--<![endif]-->
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="author" content="bpsmartdesign" />
  <meta name="robots" content="index, follow">
  <meta name="keywords" content="" />
    
  <title><?= $title; ?></title>
  
  <link rel="icon" href="Data/imgs/logo.ico" /> <!-- Icone de la page -->
  
  <link href="https://fonts.googleapis.com/css?family=Dosis:600,700" rel="stylesheet"> 
  <link href='http://fonts.googleapis.com/css?family=Open+Sans:600,700' rel='stylesheet' type='text/css'>
  
  <link href="/Dist/assets/css/bootstrap.min.css" rel="stylesheet">
  <link href="/Dist/assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="/Dist/assets/vendors/linearicons/css/linearicons.css" rel="stylesheet">
  <link href="/Dist/assets/vendors/webfont-medical-icons/css/wfmi-style.css" rel="stylesheet">
  <link href="/Dist/assets/vendors/owl-carousel/owl.carousel.min.css" rel="stylesheet">
  <link href="/Dist/assets/vendors/owl-carousel/owl.theme.min.css" rel="stylesheet">
  <link href="/Dist/assets/vendors/magnific-popup/css/magnific-popup.css" rel="stylesheet">
  <link href="/Dist/assets/vendors/YTPlayer/css/jquery.mb.YTPlayer.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="/Dist/assets/vendors/bootstrap-datepicker/css/bootstrap.datepicker.css">

  <link href="/Dist/assets/css/base.css" rel="stylesheet">
  <link href="/Dist/assets/css/style.css" rel="stylesheet">
  <link href="/Dist/assets/css/demo.css" rel="stylesheet">

</head>
<body>
  <!-- Preloader -->
  <div id="preloader" class="preloader">
    <div class="loader pos-center">
      <img src="/Dist/assets/images/preloader.gif" alt="">
    </div>
  </div>

  <div id="pageWrapper" class="page-wrapper">
    <!-- –––––––––––––––[ HEADER ]––––––––––––––– -->
    <div class="topbar bg-theme">
      <div class="container">
        <div class="row">
          <div class="col-md-8">
            <ul class="topbar-info list-inline is-hidden-xs t-xs-center t-md-left">
              <li class="prl-10"><i class="fa fa-map-marker mr-10 font-16"></i>Ville, Quartier - N° Rue</li>
              <li class="prl-10"><i class="fa fa-phone mr-10 font-16"></i>123 456 789 </li>
              <li class="prl-10"><i class="fa fa-envelope mr-10 font-16"></i>mail@mail.com</li>
            </ul>
          </div>
          <div class="col-md-4">
            <ul class="social-icons list-inline font-16  t-xs-center t-md-right is-hidden-sm">
              <li class="social-icons__item"><a href="#"><i class="fa fa-facebook"></i></a></li>
              <li class="social-icons__item"><a href="#"><i class="fa fa-twitter"></i></a></li>
              <li class="social-icons__item"><a href="#"><i class="fa fa-linkedin"></i></a></li>
              <li class="social-icons__item"><a href="#"><i class="fa fa-google-plus"></i></a></li>
              <li class="social-icons__item"><a href="#"><i class="fa fa-pinterest"></i></a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>

    <header id="mainHeader" class="main-header">
      <div class="header-menu">
        <div class="container">
          <div class="row">
            <div class="col-md-3">
              <div class="logo">
                <a href="/p/index"><img src="/Dist/assets/images/logo.png" alt=""></a>
              </div>
                <!-- Phone Menu button -->
                <button id="menu" class="menu is-hidden-md-up"></button>
              </div>
              <div class="col-md-9">
                <nav class="navigation">
                  <ul>
                    <li><a href="/p/index">Accueil</a></li>
                    <li><a href="/p/about">A propos</a></li>
                    <li><a href="/p/services">Services</a></li>
                    <li><a href="/p/products">Produits</a></li>
                    <li><a href="/p/testimonies">Témoignages</a></li>
                    <li><a href="/p/faq">FAQ</a></li>
                    <li><a href="/p/contact">Contacts</a></li>
                  </ul>
                </nav>
              </div>
          </div>
        </div>
      </div>
    </header>

    <!-- –––––––––––––––[ PAGE CONTENT ]––––––––––––––– -->
    <main id="mainContent" class="main-content">
      <?= $content; ?>
    </main>

    <!-- –––––––––––––––[ FOOTER ]––––––––––––––– -->
    <footer class="main-footer pt-60">
      <div class="container">
        <div class="footer-widgets">
          <div class="row row-masnory">
            <div class="col-md-3 col-sm-6 pb-50">
              <div class="widget">
                <h2>A propos</h2>
                <p class="mb-10">Lorem ipsum dolor sit amet consectetur adipisicing elit. Corporis est quos, deserunt temporibus numquam officiis ullam in, maiores, veritatis sit ratione minima praesentium autem commodi aperiam natus reiciendis quae quidem.</p>
                <ul class="social-icons list-inline">
                  <li class="social-icons__item pt-10"><a href="#"><i class="fa fa-facebook"></i></a></li>
                  <li class="social-icons__item pt-10"><a href="#"><i class="fa fa-twitter"></i></a></li>
                  <li class="social-icons__item pt-10"><a href="#"><i class="fa fa-linkedin"></i></a></li>
                  <li class="social-icons__item pt-10"><a href="#"><i class="fa fa-google-plus"></i></a></li>
                  <li class="social-icons__item pt-10"><a href="#"><i class="fa fa-pinterest"></i></a></li>
                </ul>
              </div>
            </div>
            <div class="col-md-3 col-sm-6 pb-50">
              <div class="widget">
                <h2>Derniers Tweets</h2>
                <div class="twitter-widget">
                  <div class="single_twitter">
                    <p class="mb-15"><a href="#" class="color-theme">@bpsmartdesign :</a> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus pretium orci sit amet mi ullamcorper egestas. Sed non mattis metus.</p>
                  </div>
                  <div class="single_twitter">
                    <p class="mb-15"><a href="#" class="color-theme">@bpsmartdesign :</a> Integer vel lorem tincidunt, pharetra eros nec, posuere odio. Nullam eget bibendum sem.</p>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-3 col-sm-6 pb-50">
              <div class="widget instagram-widget">
                <h2>Quelques Images</h2>
                <div class="row row-tb-5 row-rl-5">
                  <div class="col-xs-4">
                    <a href="#"><img src="/Dist/assets/images/instagram/1.jpg" alt=""></a>
                  </div>
                  <div class="col-xs-4">
                    <a href="#"><img src="/Dist/assets/images/instagram/2.jpg" alt=""></a>
                  </div>
                  <div class="col-xs-4">
                    <a href="#"><img src="/Dist/assets/images/instagram/3.jpg" alt=""></a>
                  </div>
                  <div class="col-xs-4">
                    <a href="#"><img src="/Dist/assets/images/instagram/4.jpg" alt=""></a>
                  </div>
                  <div class="col-xs-4">
                    <a href="#"><img src="/Dist/assets/images/instagram/5.jpg" alt=""></a>
                  </div>
                  <div class="col-xs-4">
                    <a href="#"><img src="/Dist/assets/images/instagram/6.jpg" alt=""></a>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-3 col-sm-6 pb-50">
              <div class="widget get-in-touch">
                <h2>Heures d'ouverture</h2>
                <ul class="opening-hours">
                  <li>Lundi – Jeudi <span class="float-right">8.00 – 17.00</span></li>
                  <li>Vendredi <span class="float-right">9.30 – 17.30</span></li>
                  <li>Samedi <span class="float-right">9.30 – 15.00</span></li>
                  <li>Dimanche <span class="float-right">Fermé</span></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="sub-footer">
        <div class="container">
          <h6 class="copyright"> Copyright &copy; 2020 <a href="#" class="color-theme">@bpsmartdesign</a>, Tous droits reservés </h6>
        </div>
      </div>
    </footer>
  </div>
  
  <div id="backTop" class="back-top is-hidden-sm-down">
    <i class="fa fa-angle-up" aria-hidden="true"></i>
  </div>

  <script src="/Dist/assets/js/jquery-1.12.3.min.js"></script>
  <script type="text/javascript" src="/Dist/assets/js/bootstrap.min.js"></script>

  <script type="text/javascript" src="/Dist/assets/vendors/owl-carousel/owl.carousel.min.js"></script>
  <script type="text/javascript" src="/Dist/assets/vendors/magnific-popup/js/jquery.magnific-popup.min.js"></script>
  <script type="text/javascript" src="/Dist/assets/vendors/jquery.easing.1.3.min.js"></script>
  <script type="text/javascript" src="/Dist/assets/vendors/jquery.mixitup.js"></script>
  <script type="text/javascript" src="/Dist/assets/vendors/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
  <script type="text/javascript" src="/Dist/assets/vendors/YTPlayer/js/jquery.mb.YTPlayer.min.js"></script>

  <script type="text/javascript" src="/Dist/assets/js/main.js"></script>
  <script type="text/javascript" src="/Dist/assets/js/demo.js"></script>
</body>
</html>
