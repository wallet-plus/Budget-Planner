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
?> 

<?php $this->beginPage(); ?>
<!DOCTYPE html>
<html lang="en" class="" >
<?= Html::csrfMetaTags() ?>
	<?php echo $this->render('header'); ?>  
  <body data-new-gr-c-s-check-loaded="14.1085.0" data-gr-ext-installed="" class="ng-tns-0-0 fuse-splash-screen-hidden light theme-default" > <?php $this->beginBody(); ?> 
    <app-root _nghost-cmm-c149="" ng-version="12.2.1" fuse-version="13.5.0">
      <router-outlet _ngcontent-cmm-c149=""></router-outlet>
      <layout class="ng-star-inserted">
        <classy-layout class="ng-star-inserted">
          
          <?php echo $this->render('app-menu'); ?>
          <div class="flex flex-col flex-auto w-full min-w-0">
            <div class="relative flex flex-0 items-center w-full h-16 px-4 md:px-6 z-49 shadow dark:shadow-none dark:border-b bg-card dark:bg-transparent print:hidden">
              <button mat-icon-button="" class="menu-navigation mat-focus-indicator mat-icon-button mat-button-base">
                <span class="mat-button-wrapper">
                  <mat-icon role="img" class="mat-icon notranslate mat-icon-no-color" aria-hidden="true" ng-reflect-svg-icon="heroicons_outline:menu" data-mat-icon-type="svg" data-mat-icon-name="menu" data-mat-icon-namespace="heroicons_outline">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" fit="" height="100%" width="100%" preserveAspectRatio="xMidYMid meet" focusable="false">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                  </mat-icon>
                </span>
                <span matripple="" class="mat-ripple mat-button-ripple mat-button-ripple-round" ng-reflect-disabled="false" ng-reflect-centered="true" ng-reflect-trigger="[object HTMLButtonElement]"></span>
                <span class="mat-button-focus-overlay"></span>
              </button>
              <div class="flex items-center pl-2 ml-auto space-x-1 sm:space-x-2">
              </div>
            </div>
            <div class="flex flex-col flex-auto"> <?= $content ?> </div>
          </div>
        </classy-layout>
      </layout>
    </app-root>
  
    <div id="cdk-describedby-message-container" class="cdk-visually-hidden" style="visibility: hidden;">
      <div id="cdk-describedby-message-1" role="tooltip">Automatically sets the scheme based on user's operating system's color scheme preference using 'prefer-color-scheme' media query.</div>
      <div id="cdk-describedby-message-2" role="tooltip">Toggle Fullscreen</div>
    </div>
    <div class="cdk-overlay-container"></div>
    <svg id="SvgjsSvg2833" width="2" height="0" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" style="overflow: hidden; top: -100%; left: -100%; position: absolute; opacity: 0;">
      <defs id="SvgjsDefs2834"></defs>
      <polyline id="SvgjsPolyline2835" points="0,0"></polyline>
      <path id="SvgjsPath2836" d="M-1 150L-1 150L8.418539325842698 150L16.837078651685395 150L25.25561797752809 150L33.67415730337079 150L42.092696629213485 150L50.51123595505618 150L58.92977528089888 150L67.34831460674158 150L75.76685393258427 150L78.57303370786516 150L86.99157303370787 150L95.41011235955057 150L103.82865168539327 150L112.24719101123596 150L120.66573033707866 150L129.08426966292134 150L137.50280898876406 150L145.92134831460675 150L154.33988764044943 150L157.14606741573033 150L165.56460674157304 150L173.98314606741573 150L182.40168539325845 150L190.82022471910113 150L199.23876404494382 150L207.65730337078654 150L216.07584269662922 150L224.4943820224719 150L232.91292134831463 150L255.36235955056182 150L263.7808988764045 150L272.1994382022472 150L280.6179775280899 150L289.0365168539326 150L297.4550561797753 150L305.87359550561797 150L314.29213483146066 150L322.7106741573034 150L331.1292134831461 150L333.935393258427 150L342.35393258426967 150L350.77247191011236 150L359.19101123595505 150L367.6095505617978 150L376.0280898876405 150L384.44662921348316 150L392.86516853932585 150L401.28370786516854 150L409.7022471910112 150L412.5084269662921 150L420.92696629213486 150L429.34550561797755 150L437.76404494382024 150L446.1825842696629 150L454.6011235955056 150L463.01966292134836 150L471.43820224719104 150L479.85674157303373 150L488.2752808988764 150L491.0814606741573 150L499.5 150L507.9185393258427 150L516.3370786516854 150L524.7556179775281 150L533.1741573033707 150L541.5926966292135 150L550.0112359550562 150L558.4297752808989 150L566.8483146067416 150L589.2977528089888 150L597.7162921348315 150L606.1348314606741 150L614.5533707865169 150L622.9719101123595 150L631.3904494382023 150L639.808988764045 150L648.2275280898876 150L656.6460674157304 150L665.064606741573 150L667.870786516854 150L676.2893258426966 150L684.7078651685393 150L693.1264044943821 150L701.5449438202247 150L709.9634831460675 150L718.3820224719101 150L726.8005617977528 150L735.2191011235956 150L743.6376404494382 150L766.0870786516854 150L774.5056179775281 150L782.9241573033709 150L791.3426966292135 150L799.7612359550562 150L808.1797752808989 150L816.5983146067416 150L825.0168539325842 150L833.435393258427 150L841.8539325842697 150L844.6601123595506 150L853.0786516853933 150L861.4971910112359 150L869.9157303370787 150L878.3342696629214 150L886.7528089887641 150L895.1713483146068 150L903.5898876404494 150L912.0084269662922 150L920.4269662921348 150L923.2331460674158 150L931.6516853932585 150L940.0702247191011 150L948.4887640449439 150L956.9073033707865 150L965.3258426966293 150L973.744382022472 150L982.1629213483146 150L990.5814606741574 150L999 150C999 150 999 150 999 150 "></path>
    </svg>
    <div class="cdk-live-announcer-element cdk-visually-hidden" aria-atomic="true" aria-live="polite"></div> <?php $this->endBody(); ?>
  </body>
</html> <?php $this->endPage(); ?>