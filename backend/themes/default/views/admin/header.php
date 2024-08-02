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
    <link rel="icon" type="image/x-icon" href="<?php echo Url::base()?>/images/walletplus-icon.png">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title> <?= Html::encode($this->title) ?></title>
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="<?php echo Yii::$app->view->theme->baseUrl; ?>/default/css/styles.css">
    <link rel="stylesheet" href="<?php echo Yii::$app->view->theme->baseUrl; ?>/default/css/layout.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/jquery-1.12.4.js"></script>
    <link rel="stylesheet" href="<?php echo Yii::$app->view->theme->baseUrl; ?>/default/css/custom-styles.css">
    <meta name="description" content="WalletPlus is a free financial planner app that helps you track your expenses, create budgets, and achieve your financial goals. With features like bill reminders, income and expense tracking, and custom savings goals, WalletPlus is the only app you need to get your money in shape. Download WalletPlus now and take control of your personal finances today.">
    <meta name="keywords" content="Personal Finance, Expense Tracker, Budgeting App, Expense Management, Financial Planner">
    <meta name="robots" content="index, follow">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="language" content="English">
    <meta name="revisit-after" content="2 days">
    <meta name="author" content="Mohammad Fareed">
    <meta charset="utf-8">
    
  </head>
  
  
  <!-- Menu Toggle start -->
    <script>
    $( document ).ready(function() {        
        /** Menu Toggle */
        $(".menu-navigation").click(function(){
            $("fuse-vertical-navigation").toggle();
        });
    });
    </script>
    
    <style>
    @media only screen and (max-width: 600px) {
        fuse-vertical-navigation {
            display: none;
        }
    }
    </style>
  <!-- Menu Toggle End -->