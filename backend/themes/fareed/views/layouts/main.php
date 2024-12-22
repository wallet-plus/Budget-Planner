<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap4\Breadcrumbs;
use yii\bootstrap4\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
AppAsset::register($this);

use yii\helpers\Url;
?>
<!doctype html>
<html lang="en">
  <head>
    <link rel="icon" type="image/x-icon" href="<?php echo Url::base()?>/images/walletplus-icon.png">
    <title><?= Html::encode($this->title) ?></title>
    <meta name="description" content="WalletPlus is a free financial planner app that helps you track your expenses, create budgets, and achieve your financial goals. With features like bill reminders, income and expense tracking, and custom savings goals, WalletPlus is the only app you need to get your money in shape. Download WalletPlus now and take control of your personal finances today.">
    <meta name="keywords" content="Personal Finance, Expense Tracker, Budgeting App, Expense Management, Financial Planner">
    <meta name="robots" content="index, follow">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="language" content="English">
    <meta name="revisit-after" content="2 days">
    <meta name="author" content="Mohammad Fareed">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo Url::base()?>/css/style-starter.css">

    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-3364764390236729"
     crossorigin="anonymous"></script>
     
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-B09KR6R78F"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'G-B09KR6R78F');
    </script>

  </head>
  <body>
<!-- header -->
<header id="site-header" class="fixed-top">
  <div class="container">
      <nav class="navbar navbar-expand-lg stroke">
        
          <a class="navbar-brand" href="<?php echo Url::base('')?>">
              <!--<span class="fa fa-cube"></span>--> 
              <img src="<?php echo Url::base()?>/images/walletplus-icon.png" height="40px;" alt="<?php echo Yii::$app->name; ?>"/>
                  <?php echo Yii::$app->name; ?>
          </a>
          <button class="navbar-toggler  collapsed bg-gradient" type="button" data-toggle="collapse"
              data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false"
              aria-label="Toggle navigation">
              <span class="navbar-toggler-icon fa icon-expand fa-bars"></span>
              <span class="navbar-toggler-icon fa icon-close fa-times"></span>
              </span>
          </button>

          <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
              <ul class="navbar-nav ml-auto">
                
                  <li class="nav-item <?php echo ($this->context->route == '/')?'active':''; ?>">
                      <!-- <a class="nav-link" href="<?php echo Url::base()?>">Home <span class="sr-only">(current)</span></a> -->
                      <?php echo Html::a('Home', ['/'], ['class'=>'nav-link']);?>
                  </li>
                  
                  <li class="nav-item <?php echo ($this->context->route == 'site/about')?'active':''; ?>">
                      <?php echo Html::a('About', ['/site/about'], ['class'=>'nav-link']);?>
                  </li>

                  <li class="nav-item <?php echo ($this->context->route == 'site/register')?'active':''; ?>">
                    <?php echo Html::a('Register', ['/site/register'], ['class' => 'nav-link']); ?>
                  </li>

                  <li class="nav-item <?php echo ($this->context->route == 'site/login')?'active':''; ?>">
                    <?php echo Html::a('Login', ['/site/login'], ['class' => 'nav-link']); ?>
                  </li>
              </ul>
          </div>
          <!-- toggle switch for light and dark theme -->
          <div class="mobile-position">
              <nav class="navigation">
                  <div class="theme-switch-wrapper">
                      <label class="theme-switch" for="checkbox">
                          <input type="checkbox" id="checkbox">
                          <div class="mode-container">
                              <i class="gg-sun"></i>
                              <i class="gg-moon"></i>
                          </div>
                      </label>
                  </div>
              </nav>
          </div>
          <!-- //toggle switch for light and dark theme -->
      </nav>
  </div>
</header>
<!-- //header -->

<?= $content ?>


  <!-- footer-28 block -->
  <section class="app-footer">
    <footer class="footer-28">
      <div class="footer-bg-layer">
        <div class="container py-lg-3">
          <div class="row footer-top-28">
            <div class="col-lg-4 footer-list-28 mt-5">
              <h6 class="footer-title-28"><?php echo Yii::$app->name; ?> </h6>
              <p><?php echo Yii::$app->name; ?> is Financial Planner App helps you in Budget planning, Expense tracking for your Personal Financial Discipline.</p>

              <div class="main-social-footer-28 mt-3">
                <ul class="social-icons">
                  <li class="facebook">
                    <a href="https://www.facebook.com/walletplusPage" title="Facebook"  target="_blank">
                      <span class="fa fa-facebook" aria-hidden="true"></span>
                    </a>
                  </li>
                  <li class="twitter">
                    <a href="https://twitter.com/walletpluspage" title="Twitter" target="_blank">
                      <span class="fa fa-twitter" aria-hidden="true"></span>
                    </a>
                  </li>
                  
                  <li class="linkedin">
                    <a href="https://www.linkedin.com/company/walletpluspage/" title="Linkedin"  target="_blank">
                      <span class="fa fa-linkedin" aria-hidden="true"></span>
                    </a>
                  </li>
                  
                  <li class="youtube">
                    <a href="https://www.youtube.com/@WalletPlusOfficial" title="Youtube"  target="_blank">
                      <span class="fa fa-youtube" aria-hidden="true"></span>
                    </a>
                  </li>

                  <li class="github">
                    <a href="https://github.com/orgs/wallet-plus/repositories" title="Github"  target="_blank">
                      <span class="fa fa-github" aria-hidden="true"></span>
                    </a>
                  </li>
                </ul>
              </div>
            </div>
            <div class="col-lg-8">
              <div class="row">
                <div class="col-md-4 col-6 footer-list-28 mt-5">
                  <h6 class="footer-title-28"><?php echo Yii::$app->name; ?></h6>
                  <ul>
                    <li><?php echo Html::a('Expense Tracker', ['/']);?></li>
                    <li><?php echo Html::a('Budgeting App', ['/site/about']);?></li>
                    <li><?php echo Html::a('Personal Finance', ['/site/personal-finance']);?></li>
                    <li><?php echo Html::a('Expense Management', ['/site/login']);?></li>
                  </ul>
                </div>
                <div class="col-md-4 col-6 footer-list-28 mt-5">
                  <h6 class="footer-title-28"><?php echo Html::a('Budget', ['/site/budget-planner']);?></h6>
                  <ul>
                    <li><?php echo Html::a('Budget Tracker', ['/site/budget-planner']);?></li>
                    <li><?php echo Html::a('Budget Planner', ['/site/budget-planner']);?></li>
                    <li><?php echo Html::a('budget maker', ['/site/budget-planner']);?></li>
                    <li><?php echo Html::a('monthly budget', ['/site/budget-planner']);?></li>
                    <li><?php echo Html::a('online budget planner', ['/site/budget-planner']);?></li>
                  </ul>
                </div>

                <div class="col-md-4 col-6 footer-list-28 mt-5">
                  <h6 class="footer-title-28">Product help</h6>
                  <ul>
                    <li><?php echo Html::a('Home', ['/']);?></li>
                    <li><?php echo Html::a('About us', ['/site/about']);?></li>
                    <li><?php echo Html::a('Register', 'https://secure.walletplus.in/signup');?></li>
                    <li><?php echo Html::a('Login', 'https://secure.walletplus.in/signin');?></li>
                  </ul>
                </div>
                <!-- <div class="col-md-4 footer-list-28 mt-5">
                  <h6 class="footer-title-28">Download</h6>
                  <a href="#playstore"><img src="<?php echo Url::base('https')?>/images/googleplay.png" class="img-fluid" alt=""></a>
                  <a href="#appstore"><img src="<?php echo Url::base()?>/images/appstore.png" class="img-fluid mt-md-2" alt=""></a>
                </div> -->
              </div>
            </div>
          </div>
          <div class="midd-footer-28 align-center py-4 mt-5">
            <p class="copy-footer-28 text-center"> &copy; 2023 <?php echo Yii::$app->name; ?>. All Rights Reserved.</p>
          </div>
        </div>


      </div>
    </footer>

    <!-- move top -->
    <button onclick="topFunction()" id="movetop" title="Go to top">
      &#10548;
    </button>
    <script>
      // When the user scrolls down 20px from the top of the document, show the button
      window.onscroll = function () {
        scrollFunction()
      };

      function scrollFunction() {
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
          document.getElementById("movetop").style.display = "block";
        } else {
          document.getElementById("movetop").style.display = "none";
        }
      }

      // When the user clicks on the button, scroll to the top of the document
      function topFunction() {
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
      }
    </script>
    <!-- /move top -->
  </section>
  <!-- //footer-28 block -->

  <!-- all js scripts and files here -->

  <script src="<?php echo Url::base()?>/js/theme-change.js"></script><!-- theme switch js (light and dark)-->

  <script src="<?php echo Url::base()?>/js/jquery-3.3.1.min.js"></script><!-- default jQuery -->

<!-- magnific popup -->
<script src="<?php echo Url::base()?>/js/jquery.magnific-popup.min.js"></script>
<script>
  $(document).ready(function () {
    $('.popup-with-zoom-anim').magnificPopup({
      type: 'inline',

      fixedContentPos: false,
      fixedBgPos: true,

      overflowY: 'auto',

      closeBtnInside: true,
      preloader: false,

      midClick: true,
      removalDelay: 300,
      mainClass: 'my-mfp-zoom-in'
    });

    $('.popup-with-move-anim').magnificPopup({
      type: 'inline',

      fixedContentPos: false,
      fixedBgPos: true,

      overflowY: 'auto',

      closeBtnInside: true,
      preloader: false,

      midClick: true,
      removalDelay: 300,
      mainClass: 'my-mfp-slide-bottom'
    });
  });
</script>
<!-- magnific popup -->


<script src="<?php echo Url::base()?>/js/owl.carousel.js"></script>
<!-- script for tesimonials carousel slider -->
<script>
  $(document).ready(function () {
    $("#owl-demo1").owlCarousel({
      loop: true,
      margin: 0,
      nav: false,
      responsiveClass: true,
      responsive: {
        0: {
          items: 2,
          nav: false
        },
        736: {
          items: 3,
          nav: false
        },
        1000: {
          items: 4,
          nav: false,
          loop: false
        }
      }
    })
  })
</script>
<!-- //script for tesimonials carousel slider -->



  <!-- disable body scroll which navbar is in active -->
  <script>
    $(function () {
      $('.navbar-toggler').click(function () {
        $('body').toggleClass('noscroll');
      })
    });
  </script>
  <!-- disable body scroll which navbar is in active -->

  <!--/MENU-JS-->
  <script>
    $(window).on("scroll", function () {
      var scroll = $(window).scrollTop();

      if (scroll >= 80) {
        $("#site-header").addClass("nav-fixed");
      } else {
        $("#site-header").removeClass("nav-fixed");
      }
    });

    //Main navigation Active Class Add Remove
    $(".navbar-toggler").on("click", function () {
      $("header").toggleClass("active");
    });
    $(document).on("ready", function () {
      if ($(window).width() > 991) {
        $("header").removeClass("active");
      }
      $(window).on("resize", function () {
        if ($(window).width() > 991) {
          $("header").removeClass("active");
        }
      });
    });
  </script>
  <!--//MENU-JS-->

  <!-- bootstrap js -->
  <script src="<?php echo Url::base()?>/js/bootstrap.min.js"></script>
  <!-- stats number counter-->
  <script src="<?php echo Url::base()?>/js/jquery.waypoints.min.js"></script>
  <script src="<?php echo Url::base()?>/js/jquery.countup.js"></script>
  <script>
    $('.counter').countUp();
  </script>
  <!-- //stats number counter -->
  
  </body>

  </html>