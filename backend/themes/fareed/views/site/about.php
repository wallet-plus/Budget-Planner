<?php

/** @var yii\web\View $this */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;
?>
<!-- <div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        This is the About page. You may modify the following file to customize its content:
    </p>

    <code><?= __FILE__ ?></code>
</div> -->


<section class="w3l-breadcrumb">
    <div class="container">
        <ul class="breadcrumbs-custom-path">
            <li><a href="#url">Home</a></li>
            <li class="active"><span class="fa fa-arrow-right mx-2" aria-hidden="true"></span> About</li>
        </ul>
    </div>
</section>
<section class="w3l-features py-5" id="features">
    <div class="call-w3 py-lg-5 py-md-4">
        <div class="container">
            <div class="row main-cont-wthree-2">
                <div class="col-lg-6 feature-grid-left">
                    <h3 class="title-big mb-4">Looking for a reliable and easy-to-use platform to manage your finances?</h3>
                    <p class="text-para"> Look no further than WalletPlus.in! Our innovative platform is designed to help you add income, track expenses, and save money, all in one convenient place.</p>

                    <p>With WalletPlus.in, you can easily create multiple categories to organize your finances and track your spending. Whether you want to keep tabs on your food expenses, travel costs, or entertainment spending, our platform makes it easy to see where your money is going.</p>
                </div>
                <div class="col-lg-6 feature-grid-right mt-lg-0 mt-5">
                    <img src="<?php echo Url::base('http')?>/images/about.png" alt="" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
</section>
<section class="w3l-features1 py-5" id="features">
    <div class="call-w3 py-lg-5 py-md-4">
        <div class="container">
            <div class="row main-cont-wthree-2">
                <div class="col-lg-6 feature-grid-right mb-lg-0 mb-5">
                    <img src="<?php echo Url::base('http')?>/images/about1.png" alt="" class="img-fluid">
                </div>
                <div class="col-lg-6 feature-grid-left">
                    <h3 class="title-big mb-4">Work faster with powerful filters with this app</h3>
                    <p class="text-para">But that's not all! WalletPlus.in also offers a variety of features to help you stay on top of your finances. With our reminder options, you'll never forget an important payment again. Simply set a reminder for your upcoming bills and payments, and we'll send you a notification when it's time to pay.</p>

                    <p>
                    And if you're looking to save money, WalletPlus.in has you covered there too. Our platform makes it easy to set savings goals and track your progress, so you can stay on track and reach your financial goals faster.
                    </p>

                   
                    <!-- <a href="#download" class="btn btn-primary btn-style mt-md-5 mt-4 mr-2">Get started</a>
                    <a href="#download" class="btn btn-outline-primary btn-style mt-md-5 mt-4">Contact Us</a> -->
                </div>
            </div>
        </div>
    </div>
</section>

<!-- <section class="w3l-specification-6 py-5">
    <div class="specification-6-mian py-lg-5 py-md-4">
        <div class="container">
            <h5 class="title-small text-center">So why wait?</h5>
            <h3 class="title-big mb-5 text-center">We have some Easy steps</h3>
            <div class="align-counter-6-inf-cols row">
                <div class="counter-6-inf-left col-lg-6 text-center align-self">
                    <img src="<?php echo Url::base('http')?>/images/steps.png" alt="" class="mg-fluid radius-image">
                </div>
                <div class="counter-6-inf-right col-lg-6">
                    <div class="specification">
                        <div class="specification-icon">
                            <span class="fa color-orange fa-cloud-download"></span>
                        </div>
                        <div class="specification-info">
                            <h6><a href="blog-single.html">Download the app</a></h6>
                            <p>Sign up for WalletPlus.in today and start taking control of your finances like never before!</p>
                        </div>

                    </div>
                    <div class="specification">
                        <div class="specification-icon">
                            <span class="fa color-green fa-sign-in"></span>
                        </div>
                        <div class="specification-info">
                            <h6><a href="blog-single.html"> Build Your Budget</a></h6>
                            <p> Add your expenses, set savings targets, and share your budget with loved ones.</p>
                        </div>

                    </div>
                    <div class="specification">
                        <div class="specification-icon">
                            <span class="fa color-blue fa-gift"></span>
                        </div>
                        <div class="specification-info">
                            <h6><a href="blog-single.html">Enjoy the App!</a></h6>
                            <p>Start feeling confident, Satisfied, and secure in your financial life. You might even sleep better.</p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section> -->
<!-- //specification-6-->

<!-- <section class="w3l-technologies">
    <div class="midd-w3 py-5">
        <div class="container py-lg-5 py-md-3">
            <div class="row">
                <div class="col-lg-6 about-right-faq align-self mb-lg-0 mb-md-5 mb-4">
                    <h5 class="title-small mb-2">our Technologies</h5>
                    <h3 class="title-big">Designed & Worked
                        by the Latest Integration
                    </h3>
                    <p class="mt-4">We have built the app with the latest technology and integration
                         so that the app is safe, secure and fast.</p>
                </div>
                <div class="col-lg-6 technologies-left pr-lg-5">
                    <div class="row">
                        <div class="col-sm-5 col-4 text-right">
                            <div class="icon1">
                                <span class="fa fa-css3" aria-hidden="true" title="css3"></span>
                            </div>
                            <div class="icon2 mt-3">
                                <span class="fa fa-html5" aria-hidden="true" title="html5"></span>
                            </div>
                        </div>
                        <div class="col-sm-3 col-4 ">
                            <div class="icon4 mt-3">
                            <span class="fa fa-js" aria-hidden="true" title="javascript"></span>
                            </div>
                            <div class="icon3 mt-3">
                                <span class="fa fa-github" aria-hidden="true" title="github"></span>
                            </div>
                        </div>
                        <div class="col-4 ">
                            <div class="icon5 mt-3">
                                <span class="fa fa-wordpress" aria-hidden="true" title="wordpress"></span>
                            </div>
                            <div class="icon6 mt-3">
                                <span class="fa fa-database" aria-hidden="true" title="database"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
</section> -->

<section class="w3l-download-main">
    <!--/download-->
    <div class="download-content text-center py-5">
        <div class="container py-lg-4">
            <h5 class="title-small mb-2">So why wait?</h5>
            <h3 class="title-big">Sign up for <span>WalletPlus.in</span> today </h3>
            <h6>and start taking control of your finances like never before!</h6>
            <div class="banner-button">
            <a href="<?= Url::to(['/site/login']);?>" class="btn btn-style btn-primary">Sign up Now</a>
            </div>
        </div>
    </div>
    </div>
    <!--//download-->
</section>

  <!-- forms -->
  <!-- <section class="container">
    <div class="w3l-forms-9 px-4" id="newsletter">
      <div class="main-w3 py-4">
        <div class="container-fluid py-lg-3 py-2">
          <div class="row align-items-center">
            <div class="main-midd col-lg-6">
              <h4 class="title-head">Subscribe our newsletter</h4>
              <p>We’re a team of non-cynics who truly care for our work.</p>
            </div>
            <div class="main-midd-2 col-lg-6 mt-lg-0 mt-4">
              <form action="#url" method="GET" class="rightside-form">
                <input type="email" class="form-control" name="email" placeholder="Enter your email">
                <button class="btn" type="submit">Subscribe</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section> -->
  <!-- //forms -->