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
<!DOCTYPE html>


<html
  lang="en"
  class="light-style layout-menu-fixed layout-compact"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="<?php echo Yii::$app->view->theme->baseUrl; ?>/fareed/"
  data-template="vertical-menu-template-free"></html>

  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title><?= Html::encode($this->title) ?></title>

    <meta name="description" content="" />
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?php echo Yii::$app->request->baseUrl; ?>/images/walletplus-icon.png" /> 

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet" />

    <link rel="stylesheet" href="<?php echo Yii::$app->view->theme->baseUrl; ?>/fareed/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="<?php echo Yii::$app->view->theme->baseUrl; ?>/fareed/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="<?php echo Yii::$app->view->theme->baseUrl; ?>/fareed/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="<?php echo Yii::$app->view->theme->baseUrl; ?>/fareed/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="<?php echo Yii::$app->view->theme->baseUrl; ?>/fareed/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="<?php echo Yii::$app->view->theme->baseUrl; ?>/fareed/vendor/libs/apex-charts/apex-charts.css" />

    <!-- Page CSS -->

   
    <!-- Helpers -->
    <script src="<?php echo Yii::$app->view->theme->baseUrl; ?>/fareed/vendor/js/helpers.js"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="<?php echo Yii::$app->view->theme->baseUrl; ?>/fareed/js/config.js"></script>
  </head>