<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap4\Breadcrumbs;
use yii\bootstrap4\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use yii\helpers\Url;

AppAsset::register($this);

?>


<fuse-vertical-navigation class="dark bg-gray-900 print:hidden ng-tns-c62-4 fuse-vertical-navigation-animations-enabled fuse-vertical-navigation-appearance-default fuse-vertical-navigation-mode-side fuse-vertical-navigation-position-left ng-star-inserted fuse-vertical-navigation-opened" ng-reflect-mode="side"  ng-reflect-navigation="[object Object],[object Object" ng-reflect-opened="true" style="visibility: visible;">
  <div class="fuse-vertical-navigation-wrapper ng-tns-c62-4">
    <div class="fuse-vertical-navigation-header ng-tns-c62-4"></div>
    <div fusescrollbar="" class="fuse-vertical-navigation-content ng-tns-c62-4 ps ps--active-y" ng-reflect-fuse-scrollbar="" ng-reflect-fuse-scrollbar-options="[object Object]">
      <div class="fuse-vertical-navigation-content-header ng-tns-c62-4">
        <div class="flex items-center w-full p-4 pl-6 ng-tns-c62-4">
          <!-- <div class="flex items-center justify-center">
            <img src="<?php echo Url::base()?>/app/images/logo.svg" class="w-8">
          </div> -->
          <!-- Coming Soon -->
          <div class="flex items-center ml-auto">
            <!-- <notifications>
              <button mat-icon-button="" class="mat-focus-indicator mat-icon-button mat-button-base">
                <span class="mat-button-wrapper">
                  <span class="absolute top-0 right-0 left-0 flex items-center justify-center h-3 ng-star-inserted">
                    <span class="flex items-center justify-center flex-shrink-0 min-w-4 h-4 px-1 ml-4 mt-2.5 rounded-full bg-teal-600 text-indigo-50 text-xs font-medium"> 3 </span>
                  </span>
                  <mat-icon role="img" class="mat-icon notranslate mat-icon-no-color" aria-hidden="true" ng-reflect-svg-icon="heroicons_outline:bell" data-mat-icon-type="svg" data-mat-icon-name="bell" data-mat-icon-namespace="heroicons_outline">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" fit="" height="100%" width="100%" preserveAspectRatio="xMidYMid meet" focusable="false">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                    </svg>
                  </mat-icon>
                </span>
                <span matripple="" class="mat-ripple mat-button-ripple mat-button-ripple-round" ng-reflect-disabled="false" ng-reflect-centered="true" ng-reflect-trigger="[object HTMLButtonElement]"></span>
                <span class="mat-button-focus-overlay"></span>
              </button>
            </notifications> -->


            <user ng-reflect-show-avatar="false">
              <button aria-haspopup="true" mat-icon-button="" class="mat-focus-indicator mat-menu-trigger mat-icon-button mat-button-base" ng-reflect-menu="[object Object]">
                <span class="mat-button-wrapper">
                  <span class="relative">
                    <a href="<?= Url::to(['/site/profile']);?>">
                      <mat-icon role="img" class="mat-icon notranslate mat-icon-no-color ng-star-inserted" aria-hidden="true" ng-reflect-svg-icon="heroicons_outline:user-circle" data-mat-icon-type="svg" data-mat-icon-name="user-circle" data-mat-icon-namespace="heroicons_outline">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" fit="" height="100%" width="100%" preserveAspectRatio="xMidYMid meet" focusable="false">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                      </mat-icon>
                      <span class="absolute right-0 bottom-0 w-2 h-2 rounded-full mr-px mb-px bg-green-500" ng-reflect-ng-class="[object Object]"></span>
                    </a>
                  </span>
                </span>
                <span matripple="" class="mat-ripple mat-button-ripple mat-button-ripple-round" ng-reflect-disabled="false" ng-reflect-centered="true" ng-reflect-trigger="[object HTMLButtonElement]"></span>
                <span class="mat-button-focus-overlay"></span>
              </button>
              <mat-menu class="ng-tns-c67-6 ng-star-inserted" ng-reflect-x-position="before"></mat-menu>
              <mat-menu class="ng-star-inserted"></mat-menu>
            </user>
          </div>
        </div>

        
        <div class="flex flex-col items-center w-full p-4 ng-tns-c62-4">
        <?php if(Yii::$app->user->identity) { ?>

          <div class="relative w-24 h-24">
            <!-- <img alt="User avatar" class="w-full h-full rounded-full ng-star-inserted" src="app/images/brian-hughes.jpg"> -->
            <?= Html::img('@web/users/' . Yii::$app->user->identity->image, ['alt' => 'Image', 'class'=>'w-full h-full rounded-full']) ?>
          </div>
          <?php } ?>
          <div class="flex flex-col items-center justify-center w-full mt-6">
            <?php if(Yii::$app->user->identity) { ?>
              <div class="w-full whitespace-nowrap overflow-ellipsis overflow-hidden text-center leading-normal font-medium"> <?php echo Yii::$app->user->identity->firstname;?> <?php echo Yii::$app->user->identity->lastname;?> </div>
              <div class="w-full mt-0.5 whitespace-nowrap overflow-ellipsis overflow-hidden text-center text-md leading-normal font-medium text-secondary"> <?php echo Yii::$app->user->identity->email;?> </div>
            <?php } ?>
          </div>
        </div>
      </div>
      <fuse-vertical-navigation-group-item class="ng-tns-c62-4 ng-star-inserted"   ng-reflect-auto-collapse="true">
        <!-- <div class="fuse-vertical-navigation-item-wrapper fuse-vertical-navigation-item-has-subtitle">
          <div class="fuse-vertical-navigation-item">
            <mat-icon role="img" class="mat-icon notranslate fuse-vertical-navigation-item-icon mat-icon-no-color ng-star-inserted" aria-hidden="true" ng-reflect-svg-icon="heroicons_outline:home" data-mat-icon-type="svg" data-mat-icon-name="home" data-mat-icon-namespace="heroicons_outline">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" fit="" height="100%" width="100%" preserveAspectRatio="xMidYMid meet" focusable="false">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
              </svg>
            </mat-icon>
            <div class="fuse-vertical-navigation-item-title-wrapper">
              <div class="fuse-vertical-navigation-item-title">
                <span> Dashboards </span>
              </div>
              <div class="fuse-vertical-navigation-item-subtitle ng-star-inserted">
                <span> Unique dashboard designs </span>
              </div>
            </div>
          </div>
        </div> -->
        
        <!-- <fuse-vertical-navigation-basic-item   class="ng-star-inserted">
          <div class="fuse-vertical-navigation-item-wrapper">
            <a class="mat-tooltip-trigger fuse-vertical-navigation-item ng-star-inserted fuse-vertical-navigation-item-active">
              <mat-icon role="img" class="mat-icon notranslate fuse-vertical-navigation-item-icon mat-icon-no-color ng-star-inserted" aria-hidden="true" ng-reflect-svg-icon="heroicons_outline:clipboard-ch" data-mat-icon-type="svg" data-mat-icon-name="clipboard-check" data-mat-icon-namespace="heroicons_outline">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" fit="" height="100%" width="100%" preserveAspectRatio="xMidYMid meet" focusable="false">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                </svg>
              </mat-icon>
              <div class="fuse-vertical-navigation-item-title-wrapper ng-star-inserted">
                <div class="fuse-vertical-navigation-item-title">
                  <span> Project </span>
                </div>
              </div>
            </a>
          </div>
        </fuse-vertical-navigation-basic-item> -->

        <fuse-vertical-navigation-basic-item   class="ng-star-inserted">
          <div class="fuse-vertical-navigation-item-wrapper">
            <?php echo Html::a('Dashboard', ['/site/dashboard'], ['class'=>'mat-tooltip-trigger fuse-vertical-navigation-item ng-star-inserted']);?>
          </div>
        </fuse-vertical-navigation-basic-item>

        <!-- <fuse-vertical-navigation-basic-item   class="ng-star-inserted">
          <div class="fuse-vertical-navigation-item-wrapper">
            <?php echo Html::a('Profile', ['/site/profile'], ['class'=>'mat-tooltip-trigger fuse-vertical-navigation-item ng-star-inserted']);?>
          </div>
        </fuse-vertical-navigation-basic-item> -->

        <?php if(Yii::$app->user->identity && Yii::$app->user->identity->id_customer_type == 1) { ?>
        <fuse-vertical-navigation-basic-item   class="ng-star-inserted">
          <div class="fuse-vertical-navigation-item-wrapper">
          <?php echo Html::a('Cards Type', ['/cards-type/index'], ['class'=>'mat-tooltip-trigger fuse-vertical-navigation-item ng-star-inserted']);?>
          </div>
        </fuse-vertical-navigation-basic-item>


        <fuse-vertical-navigation-basic-item   class="ng-star-inserted">
          <div class="fuse-vertical-navigation-item-wrapper">
          <?php echo Html::a('Cards', ['/cards/index'], ['class'=>'mat-tooltip-trigger fuse-vertical-navigation-item ng-star-inserted']);?>
          </div>
        </fuse-vertical-navigation-basic-item>



        <fuse-vertical-navigation-basic-item   class="ng-star-inserted">
          <div class="fuse-vertical-navigation-item-wrapper">
          <?php echo Html::a('Categories', ['/category/index'], ['class'=>'mat-tooltip-trigger fuse-vertical-navigation-item ng-star-inserted']);?>
          </div>
        </fuse-vertical-navigation-basic-item>


        <?php } ?>

        <fuse-vertical-navigation-basic-item   class="ng-star-inserted">
          <div class="fuse-vertical-navigation-item-wrapper">
          <?php echo Html::a('Income', ['/income'], ['class'=>'mat-tooltip-trigger fuse-vertical-navigation-item ng-star-inserted']);?>
          </div>
        </fuse-vertical-navigation-basic-item>

        <fuse-vertical-navigation-basic-item   class="ng-star-inserted">
          <div class="fuse-vertical-navigation-item-wrapper">
          <?php echo Html::a('Expenses', ['/expense'], ['class'=>'mat-tooltip-trigger fuse-vertical-navigation-item ng-star-inserted']);?>
          </div>
        </fuse-vertical-navigation-basic-item>
        
        <?php if(Yii::$app->user->identity && Yii::$app->user->identity->id_customer_type == 1) { ?>
          <fuse-vertical-navigation-basic-item   class="ng-star-inserted">
          <div class="fuse-vertical-navigation-item-wrapper">
          <?php echo Html::a('Email Templates', ['/email-templates'], ['class'=>'mat-tooltip-trigger fuse-vertical-navigation-item ng-star-inserted']);?>
          </div>
          </fuse-vertical-navigation-basic-item>
        <?php } ?>
         

        <?php if(Yii::$app->user->identity && Yii::$app->user->identity->id_customer_type == 1) { ?>
          <fuse-vertical-navigation-basic-item   class="ng-star-inserted">
          <div class="fuse-vertical-navigation-item-wrapper">
          <?php echo Html::a('Emails', ['/email'], ['class'=>'mat-tooltip-trigger fuse-vertical-navigation-item ng-star-inserted']);?>
          </div>
          </fuse-vertical-navigation-basic-item>
        <?php } ?>


        <fuse-vertical-navigation-basic-item   class="ng-star-inserted">
          <div class="fuse-vertical-navigation-item-wrapper">
          <?php echo Html::a('Savings', ['/savings'], ['class'=>'mat-tooltip-trigger fuse-vertical-navigation-item ng-star-inserted']);?>
          </div>
        </fuse-vertical-navigation-basic-item>


        <fuse-vertical-navigation-basic-item   class="ng-star-inserted">
          <div class="fuse-vertical-navigation-item-wrapper">
          <?php echo Html::a('Reminder', ['/reminder'], ['class'=>'mat-tooltip-trigger fuse-vertical-navigation-item ng-star-inserted']);?>
          </div>
        </fuse-vertical-navigation-basic-item>
        
        <fuse-vertical-navigation-basic-item   class="ng-star-inserted">
          <div class="fuse-vertical-navigation-item-wrapper">
            <a class="mat-tooltip-trigger fuse-vertical-navigation-item ng-star-inserted" ng-reflect-ng-class="[object Object]" ng-reflect-router-link="/apps/academy" ng-reflect-router-link-active="fuse-vertical-navigation-item-" ng-reflect-router-link-active-options="[object Object]" ng-reflect-message="" >
            <mat-icon role="img" class="mat-icon notranslate mat-icon-no-color" aria-hidden="true" ng-reflect-svg-icon="heroicons_outline:logout" data-mat-icon-type="svg" data-mat-icon-name="logout" data-mat-icon-namespace="heroicons_outline"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" fit="" height="100%" width="100%" preserveAspectRatio="xMidYMid meet" focusable="false">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
            </svg></mat-icon>
              <div class="fuse-vertical-navigation-item-title-wrapper ng-star-inserted">
                <div class="fuse-vertical-navigation-item-title">
                  <span>  
                    <?php echo Html::beginForm(['/site/logout'], 'post', ['class' => 'treeview'])
                    . Html::submitButton( 'Logout')
                    . Html::endForm()?>
                    
                  <!-- <?php echo Html::a('Logout', ['/site/logout'], ['class'=>'mat-tooltip-trigger fuse-vertical-navigation-item ng-star-inserted']);?> </span> -->
                </div>
              </div>
            </a>
          </div>
        </fuse-vertical-navigation-basic-item>
        
      </fuse-vertical-navigation-group-item>

      <!-- <div class="fuse-vertical-navigation-content-footer ng-tns-c62-4">
        <div class="flex flex-0 items-center justify-center h-16 pr-6 pl-2 mt-2 mb-4 opacity-12 ng-tns-c62-4">
          <img src="<?php echo Url::base()?>/app/images/logo-text-on-dark.svg" class="max-w-36">
        </div>
      </div> -->
      <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
        <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
      </div>
      <div class="ps__rail-y" style="top: 0px; height: 560px; right: 0px;">
        <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 92px;"></div>
      </div>
    </div>
    <div class="fuse-vertical-navigation-footer ng-tns-c62-4"></div>
  </div>
</fuse-vertical-navigation>
        