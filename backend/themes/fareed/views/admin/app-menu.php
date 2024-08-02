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

<!-- Menu -->

<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
  <div class="app-brand demo">
    <a class="app-brand-link">
      <span class="app-brand-logo demo">
        <?= Html::img('@web/images/walletplus-icon.png', [
          'alt' => 'Image',
          'class' => 'w-px-40 h-auto',
          'width' => '25'
        ]) ?>
      </span>
      <span class="app-brand-text demo menu-text fw-bold ms-2">WalletPlus</span>
    </a>

    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
      <i class="bx bx-chevron-left bx-sm align-middle"></i>
    </a>
  </div>

  <div class="menu-inner-shadow"></div>

  <ul class="menu-inner py-1">
    <!-- Dashboards -->
    <li class="menu-item">
      <?php echo Html::a(
        '<i class="menu-icon tf-icons bx bx-chart"></i> <div data-i18n="Documentation">Dashboard</div>',
        ['/site/dashboard'],
        ['class' => 'menu-link', 'encode' => false]
      ); ?>
    </li>



    <!-- Forms & Tables -->
    <li class="menu-header small text-uppercase"><span class="menu-header-text">Budget </span></li>

    <li class="menu-item">
      <?php echo Html::a(
        '<i class="menu-icon tf-icons bx bx-wallet"></i> <div data-i18n="Documentation">Expenses</div>',
        ['/expense/index'],
        ['class' => 'menu-link', 'encode' => false]
      ); ?>
    </li>

    <li class="menu-item">
      <?php echo Html::a(
        '<i class="menu-icon tf-icons bx bx-wallet"></i> <div data-i18n="Documentation">Income</div>',
        ['/income/index'],
        ['class' => 'menu-link', 'encode' => false]
      ); ?>
    </li>

    <li class="menu-item">
      <?php echo Html::a(
        '<i class="menu-icon tf-icons bx bx-wallet"></i> <div data-i18n="Documentation">Savings</div>',
        ['/savings/index'],
        ['class' => 'menu-link', 'encode' => false]
      ); ?>
    </li>

    <?php if (Yii::$app->user->identity && Yii::$app->user->identity->id_customer_type == 1) { ?>

    <li class="menu-item">
      <?php echo Html::a(
        '<i class="menu-icon tf-icons bx bx-collection"></i> <div data-i18n="Cards">Cards</div>',
        ['/cards/index'],
        ['class' => 'menu-link', 'encode' => false]
      ); ?>
    </li>

    <li class="menu-item">
      <?php echo Html::a(
        '<i class="menu-icon tf-icons bx bx-pie-chart-alt "></i> <div data-i18n="Reminders">Reminders</div>',
        ['/reminder/index'],
        ['class' => 'menu-link', 'encode' => false]
      ); ?>
    </li>


    <?php } ?>

    <?php if (Yii::$app->user->identity && Yii::$app->user->identity->id_customer_type == 1) { ?>

      <li class="menu-header small text-uppercase"><span class="menu-header-text">Admin </span></li>

      <!-- <li class="menu-item">
       <?php echo Html::a(
          '<i class="menu-icon tf-icons bx bx-check-shield"></i> <div data-i18n="Roles & Permissions">Roles & Permissions</div>',
          ['/customer-types/index'],
          ['class' => 'menu-link', 'encode' => false]
        ); ?>
      </li> -->

      <!-- <li class="menu-item">
          <?php echo Html::a(
            '<i class="menu-icon tf-icons bx bx-file"></i> <div data-i18n="Customers">Customers</div>',
            ['/customer/index'],
            ['class' => 'menu-link', 'encode' => false]
          ); ?>
      </li> -->


      <li class="menu-item">
        <?php echo Html::a(
          '<i class="menu-icon tf-icons bx bx-file"></i> <div data-i18n="Documentation">Categories</div>',
          ['/category/index'],
          ['class' => 'menu-link', 'encode' => false]
        ); ?>
      </li>

      <li class="menu-item">
        <?php echo Html::a(
          '<i class="menu-icon tf-icons bx bx-detail"></i> <div data-i18n="Emails">Emails</div>',
          ['/email/index'],
          ['class' => 'menu-link', 'encode' => false]
        ); ?>
      </li>

      <li class="menu-item">
        <?php echo Html::a(
          '<i class="menu-icon tf-icons bx bx-carousel"></i> <div data-i18n="Email Templates">Email Templates</div>',
          ['/email-templates/index'],
          ['class' => 'menu-link', 'encode' => false]
        ); ?>
      </li>



    <?php } ?>






    <!-- Forms & Tables -->
    <!-- <li class="menu-header small text-uppercase"><span class="menu-header-text">Organization </span></li>

            <li class="menu-item">
                <?php echo Html::a(
                  '<i class="menu-icon bx bx-buildings"></i> <div data-i18n="Email Templates">Organization</div>',
                  ['/email-templates/index'],
                  ['class' => 'menu-link', 'encode' => false]
                ); ?>
            </li>-->

    <li class="menu-header small text-uppercase"><span class="menu-header-text">Admin </span></li>

    <li class="menu-item">
      <?php echo Html::a(
        '<i class="menu-icon tf-icons bx bx-support"></i> <div data-i18n="Support">Support</div>',
        ['/site/support'],
        ['class' => 'menu-link', 'encode' => false]
      ); ?>
    </li>



  </ul>
</aside>
<!-- / Menu -->