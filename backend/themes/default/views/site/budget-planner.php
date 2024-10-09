<?php

/** @var yii\web\View $this */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Budget Planner';

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
            <li class="active"><span class="fa fa-arrow-right mx-2" aria-hidden="true"></span> Budget Planner</li>
        </ul>
    </div>
</section>


<section class="w3l-download-main">
    <div class="download-content text-center py-5">
        <div class="container py-lg-4">


            
            <h3 class="title-big"> <span>Budget Planner</span> </h3>
            <h6>Our free budget calculator will help you to know exactly where your money is being spent, and how much you’ve got coming in. Knowing how to manage a budget – keep track of where every pound is being spent – is a great first step to starting your savings, getting out of debt or preparing for retirement. Our free Budget Planner can help.</h6>

            <h4 class="title-head mt-4">We’ll give you:</h4>
            <p class="mt-1">a place to record all your spending, so you won’t forget anything</p>
            <p class="mt-1">a breakdown of your finances by category</p>
            <p class="mt-1">personalised tips when you’re all finished.</p>

            <h3 class="title-big mt-4">Access your saved  <span>budget plan</span> </h3>
            <h6>Now we’ve moved to WalletPlus you can be sure we’ve kept your information safe.  You can still access your saved budget plan using your Money Advice Service log-in details – on the next screen just choose Access your saved Budget Plan.</h6>
            <div class="banner-button">
            <a href="<?= Url::to(['/site/login']);?>" class="btn btn-style btn-primary">Sign up Now</a>
            </div>
        </div>
    </div>
    </div>
</section>
