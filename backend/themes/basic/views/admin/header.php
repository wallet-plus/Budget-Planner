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
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title><?= Html::encode($this->title) ?></title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="<?php echo Yii::$app->view->theme->baseUrl; ?>/basic/vendors/feather/feather.css">
  <link rel="stylesheet" href="<?php echo Yii::$app->view->theme->baseUrl; ?>/basic/vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="<?php echo Yii::$app->view->theme->baseUrl; ?>/basic/vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="<?php echo Yii::$app->view->theme->baseUrl; ?>/basic/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
  <link rel="stylesheet" href="<?php echo Yii::$app->view->theme->baseUrl; ?>/basic/vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" type="text/css" href="<?php echo Yii::$app->view->theme->baseUrl; ?>/basic/js/select.dataTables.min.css">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="<?php echo Yii::$app->view->theme->baseUrl; ?>/basic/css/vertical-layout-light/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="<?php echo Yii::$app->view->theme->baseUrl; ?>/basic/images/favicon.png" />
</head>
  
  