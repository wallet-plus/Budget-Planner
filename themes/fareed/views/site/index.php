<?php
use yii\bootstrap4\Html;
?>
<!-- banner -->
<section class="banner w3pvt-banner" id="home">
    <div class="container py-5">
        <div class="banner-text py-md-4">
            <div class="row banner-info">
                <div class="col-lg-7 w3pvt-logo align-self">
                    <h2><?php echo Yii::$app->name; ?> </h2>
                    <p class="mt-3"><?php echo Yii::$app->name; ?> is Free Financial Planner App helps you in Budget planning, Expense tracking for your Personal Financial Discipline, And the only app that gets your money into shape.</p>
                    
                    <form action="https://walletplus.in/walletplus-android-app-v1.apk" method="post" class="">
                        <input type="email" name="Email" placeholder="Enter your email...">
                        <button type="submit"  class="btn">Download</button>
                    </form>
                    <p class="mt-2 link">*Subscribe Now to get <?php echo Yii::$app->name; ?>App Updates In Email</p>
                </div>
                <div class="col-lg-5 col-md-7 mt-lg-0 mt-4">
                    <img src="images/screenshot.png" alt="" class="img-fluid" />
                </div>
            </div>
        </div>
    </div>
</section>
<!-- //banner -->

<!-- /bottom-grids-->
	<section class="w3l-bottom-grids-6 py-5">
		<div class="container py-lg-5 py-md-4">
			<div class="grids-area-hny main-cont-wthree-fea row">
				<div class="col-lg-3 col-md-6 grids-feature">
					<div class="area-box">
						<span class="fa fa-cubes"></span>
						<h4><a href="#feature" class="title-head">Safe & Secure</a></h4>
						<p>100% Guaranteed to be legitimate, trustworthy, and secure.</p>
					</div>
				</div>
				<div class="col-lg-3 col-md-6 grids-feature mt-md-0 mt-4">
					<div class="area-box">
						<span class="fa fa-chain-broken"></span>
                        <h4><a href="#feature" class="title-head">E2EE Encrypted</a></h4>
						<p>No service providers or intermediaries, can access the content.</p>
						<!-- <h4><a href="#feature" class="title-head">Easy to use</a></h4>
						<p>The app is free and easy to use for budgeters of all levels</p> -->
					</div>
				</div>
				<div class="col-lg-3 col-md-6 grids-feature mt-lg-0 mt-4">
					<div class="area-box">
						<span class="fa fa-inr"></span>
						<h4><a href="#feature" class="title-head"><?php echo Yii::$app->name; ?> is free</a></h4>
						<p><?php echo Yii::$app->name; ?> offers a free version that allows one account per user.</p>
					</div>
				</div>
				<div class="col-lg-3 col-md-6 grids-feature mt-lg-0 mt-4">
					<div class="area-box">
						<span class="fa fa-thumbs-o-up"></span>
						<h4><a href="#feature" class="title-head">Easy to use</a></h4>
						<p><?php echo Yii::$app->name; ?> is free and easy to use for budgeters of all levels.</p>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- //bottom-grids-->

<!-- /mobile section --->
<section class="w3l-mobile-content-6 py-5">
    <div class="mobile-info py-lg-5 py-md-4">
        <!-- /mobile-info-->
        <div class="container">
            <h3 class="title-big mb-5 text-center"><?php echo Yii::$app->name; ?> Awesome Features</h3>
            <div class="row mobile-info-inn mx-lg-0">
                <div class="col-lg-4 mobile-right">
                    <div class="row mobile-right-grids mb-lg-5 mb-4">
                        <div class="col-2 mobile-right-icon">
                            <div class="mobile-icon">
                                <span class="fa fa-tv"></span>
                            </div>
                        </div>
                        <div class="col-10 mobile-right-info">
                            <h6><a >Budgeting and spending tracking</a></h6>
                            <p><?php echo Yii::$app->name; ?> can help you track your spending and create a budget. <?php echo Yii::$app->name; ?> offer features that allow you to monitor your transactions and expenses, giving you greater control over your finances.</p>
                        </div>
                    </div>
                    <div class="row mobile-right-grids mb-lg-5 mb-4">
                        <div class="col-2 mobile-right-icon">
                            <div class="mobile-icon">
                                <span class="fa fa-refresh"></span>
                            </div>
                        </div>
                        <div class="col-10 mobile-right-info">
                            <h6><a>Security</a></h6>
                            <p><?php echo Yii::$app->name; ?> more secure than traditional payment methods because <?php echo Yii::$app->name; ?> use encryption technology to protect your payment information. This means that your sensitive information is not stored on the merchant's server, reducing the risk of fraud and identity theft.</p>
                        </div>
                    </div>
                    <!-- <div class="row mobile-right-grids">
                        <div class="col-2 mobile-right-icon">
                            <div class="mobile-icon">
                                <span class="fa fa-pie-chart"></span>
                            </div>
                        </div>
                        <div class="col-10 mobile-right-info">
                            <h6><a href="#url">Infinite colors</a></h6>
                            <p>We have provided infinite possible colour schemes for you to make it look more colourful.</p>
                        </div>
                    </div> -->
                </div>
                <div class="col-lg-4 mobile-left">
                    <img src="images/features.png" class="img-fluid radius-image" alt="">
                </div>
                <div class="col-lg-4 mobile-right">
                    <div class="row mobile-right-grids mb-lg-5 mb-4">
                        <div class="col-2 mobile-right-icon">
                            <div class="mobile-icon">
                                <span class="fa fa-cogs"></span>
                            </div>
                        </div>
                        <div class="col-10 mobile-right-info">
                            <h6><a>Convenience</a></h6>
                            <p><?php echo Yii::$app->name; ?> allow you to store all your payment information in one place, making it easy to access and use whenever you need. You don't need to carry multiple credit cards or cash, which can be particularly useful when traveling.</p>
                        </div>
                    </div>
                    <div class="row mobile-right-grids mb-lg-5 mb-4">
                        <div class="col-2 mobile-right-icon">
                            <div class="mobile-icon">
                                <span class="fa fa-support"></span>
                            </div>
                        </div>
                        <div class="col-10 mobile-right-info">
                            <h6><a>Loyalty rewards</a></h6>
                            <p><?php echo Yii::$app->name; ?> offer loyalty rewards and cashback programs for using their platform. This can be an added benefit for users who frequently make purchases using their digital wallet.</p>
                        </div>
                    </div>
                    <!-- <div class="row mobile-right-grids">
                        <div class="col-2 mobile-right-icon">
                            <div class="mobile-icon">
                                <span class="fa fa-recycle"></span>
                            </div>
                        </div>
                        <div class="col-10 mobile-right-info">
                            <h6><a href="#url">Built with SASS, Gulp</a></h6>
                            <p>By improving and developing websites which facilitate writing clean and easily by making them look less complex.</p>
                        </div>
                    </div> -->
                </div>

            </div>
        </div>
        <!-- //mobile-info-->
    </div>
</section>
<!-- //mobile section --->


<!-- services page block 2 -->
<section class="w3l-features py-5" id="features">
    <div class="call-w3 py-lg-5 py-md-4">
        <div class="container">
            <div class="row main-cont-wthree-2">
                <div class="col-lg-6 feature-grid-left">
                    <h3 class="title-big mb-4">This App helps to Manage Everything for You</h3>
                    <p class="text-para">We believe that managing finance should be as effortless as shopping online. It should be done anytime, anywhere and in a few clicks.</p>
                    <ol class="w3l-right mt-4 mb-0">
                        <li>Set smart budgets to help you not to overspend in your chosen category.</li>
                        <li>Know how much you can spend daily in order to stick to your budget.</li>
                        <li>Save money for your future dreams.</li>
                        <li>Make your spendings stress free.</li>
                    </ol>
                    <!-- <a href="contact.html" class="btn btn-primary btn-style mt-md-5 mt-4">Register Now Us</a> -->
                </div>
                <div class="col-lg-6 feature-grid-right mt-lg-0 mt-5">
                    <div class="call-grids-w3 d-grid">
                        <div class="grids-1 box-wrap">
                            <a href="#more" class="icon"><span class="fa fa-pencil-square-o"></span></a>
                            <h4><a href="#feature" class="title-head">Easy to edit</a></h4>
                            <p>we have kept our app easy and simple to use.</p>
                        </div>
                        <div class="grids-1 box-wrap">
                            <a href="#more" class="icon"><span class="fa fa-life-ring"></span></a>
                            <h4><a href="#feature" class="title-head">Full protection</a></h4>
                            <p>Without your permission nothing can be accessed.</p>
                        </div>
                        <div class="grids-1 box-wrap">
                            <a href="#more" class="icon"><span class="fa fa-database"></span></a>
                            <h4><a href="#feature" class="title-head">Data secure</a></h4>
                            <p>Our customers data is safe and secure  and we take that responsibility.</p>
                        </div>
                        <div class="grids-1 box-wrap">
                            <a href="#more" class="icon"><span class="fa fa-android"></span></a>
                            <h4><a href="#feature" class="title-head">Hi-speed app</a></h4>
                            <p><?php echo Yii::$app->name; ?> application is a high-speed app without any interruption.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- //services page block 2 -->
<!-- <section class="w3l-index3 bg-grey">
    <div class="midd-w3 py-5">
        <div class="container py-lg-5 py-md-3">
            <div class="row">
                <div class="col-lg-6">
                    <img src="images/image1.jpg" alt="" class="img-fluid radius-image">
                </div>
                <div class="col-lg-6 mt-lg-0 mt-md-5 mt-4 about-right-faq align-self">
                    <h5 class="title-small">Yii is a fast, secure, and efficient PHP framework</h5>
                    <h3 class="title-big"><?php echo Yii::$app->name; ?> is a fast, secure, and efficient App.</h3>
                    <p class="mt-3">Built with Yii2 is an open source, object-oriented, component-based MVC PHP web application framework.</p>
                    <a href="about.html" class="btn btn-style btn-primary mt-4">Know More</a>
                </div>
            </div>
        </div>
    </div>
</section> -->

<!-- middle -->
	<!-- <div class="middle py-5">
		<div class="container py-xl-5 py-lg-3">
			<div class="welcome-left text-center py-md-3">
                <h3 class="mb-4">Be part of the Fintech Revolution!</h3>
                <a href="#url"><img src="images/android-store.png" alt="" width="170px" class="img-fluid"></a>
				<a href="#url"><img src="images/apple-store.png" alt="" width="220px" class="img-fluid"></a>
				<p class="text-italic">* Available on iPhone, iPad and all Android devices</p>
			</div>
		</div>
	</div> -->
	<!-- //middle -->
<!-- stats -->
<!-- <section class="w3l-stats py-5" id="stats">
    <div class="gallery-inner container py-md-5 py-4">
        <div class="row stats-con">
            <div class="col-md-4 col-6 stats_info counter_grid">
                <span class="fa fa-users"></span>
                <p class="counter">2020</p>
                <h3>Customers</h3>
            </div>
            <div class="col-md-4 col-6 stats_info counter_grid1">
                <span class="fa fa-download"></span>
                <p class="counter">120</p>
                <h3>Downloads</h3>
            </div>
            <div class="col-md-4 col-6 stats_info counter_grid mt-md-0 mt-5">
                <span class="fa fa-smile-o"></span>
                <p class="counter">1500</p>
                <h3>Satisfied</h3>
            </div>
        </div>
    </div>
</section> -->
<!-- //stats -->
<!-- <section class="w3l-clients py-5" id="clients">
    <div class="call-w3 py-lg-5 py-md-4">
        <div class="container">
            <h3 class="title-big text-center mb-2">Our Valuable customers</h3>
            <p class="text-head mb-5">Love this. Perfect tool. So excited to have everything in one place and in the palm of my hand.</p>
            <div class="company-logos text-center">
                <div class="row logos mb-md-5">
                    <div class="col-lg-2 col-md-3 col-sm-4 col-6">
                        <img src="images/logo1.png" alt="" class="img-fluid">
                    </div>
                    <div class="col-lg-2 col-md-3 col-sm-4 col-6">
                        <img src="images/logo2.png" alt="" class="img-fluid">
                    </div>
                    <div class="col-lg-2 col-md-3 col-sm-4 col-6 mt-sm-0 mt-4">
                        <img src="images/logo3.png" alt="" class="img-fluid">
                    </div>
                    <div class="col-lg-2 col-md-3 col-sm-4 col-6 mt-md-0 mt-4">
                        <img src="images/logo4.png" alt="" class="img-fluid">
                    </div>
                    <div class="col-lg-2 col-md-3 col-sm-4 col-6 mt-lg-0 mt-4">
                        <img src="images/logo5.png" alt="" class="img-fluid">
                    </div>
                    <div class="col-lg-2 col-md-3 col-sm-4 col-6 mt-lg-0 mt-4">
                        <img src="images/logo1.png" alt="" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> -->
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

<script>
 
    // var test = "this is an ajax test";

    // $.ajax({
    // url: '<?php echo \Yii::$app->getUrlManager()->createUrl('rest/ajax') ?>',
    // type: 'POST',
    //     data: { test: test },
    //     success: function(data) {
    //         alert(data);
    //     }
    // });

</script>