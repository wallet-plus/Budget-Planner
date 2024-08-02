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
<!-- active -->
<!--For User Image <?= Html::img('@web/users/' . Yii::$app->user->identity->image, ['alt' => 'Image', 'class'=>'w-full h-full rounded-full']) ?>
 -->
<nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="<?= Url::to(['/site/dashboard']);?>">
              <i class="icon-grid menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
              <i class="icon-layout menu-icon"></i>
              <span class="menu-title">Budget</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="<?= Url::to(['/expense']);?>">Expenses</a></li>
                <li class="nav-item"> <a class="nav-link" href="<?= Url::to(['/savings']);?>">savings</a></li>
                <li class="nav-item"> <a class="nav-link" href="<?= Url::to(['/income']);?>">Income</a></li>
              </ul>
            </div>
          </li>

          <?php if(Yii::$app->user->identity && Yii::$app->user->identity->id_customer_type == 1) { ?>

          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#form-elements" aria-expanded="false" aria-controls="form-elements">
              <i class="icon-columns menu-icon"></i>
              <span class="menu-title">Admin</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="form-elements">
              <ul class="nav flex-column sub-menu">
              <li class="nav-item"> <a class="nav-link" href="<?= Url::to(['/category/index']);?>">Categories</a></li>
                <li class="nav-item"> <a class="nav-link" href="<?= Url::to(['/cards-type']);?>">Cards Type</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= Url::to(['/email-templates']);?>">Email Templates</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= Url::to(['/email']);?>">Emails</a></li>
              </ul>
            </div>
          </li>
          <?php } ?>

          
          
          <li class="nav-item">
            <a class="nav-link" href="<?= Url::to(['/cards']);?>">
              <i class="icon-paper menu-icon"></i>
              <span class="menu-title">Cards</span>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="<?= Url::to(['/site/profile']);?>">
              <i class="icon-head menu-icon"></i>
              <span class="menu-title">Profile</span>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="<?= Url::to(['/reminder']);?>">
              <i class="icon-paper menu-icon"></i>
              <span class="menu-title">Reminder</span>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="<?= Url::to(['/reminder']);?>">
              <i class="icon-paper menu-icon"></i>
              <!-- <span class="menu-title">Reminder</span> -->
              <?php echo Html::beginForm(['/site/logout'], 'post', ['class' => 'menu-title'])
              . Html::submitButton( 'Logout')
              . Html::endForm()?>

            </a>
          </li>

          
        </ul>
      </nav>
      



        