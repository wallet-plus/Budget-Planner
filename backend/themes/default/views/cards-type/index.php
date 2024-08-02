<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Cards Types';
$this->params['breadcrumbs'][] = $this->title;
?>

<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
<div class="flex flex-col flex-auto min-w-0">

      <div class="relative flex flex-col sm:flex-row flex-0 sm:items-center sm:justify-between py-8 px-6 md:px-8 border-b ng-tns-c161-6 bg-card">
        <div class="text-4xl font-extrabold tracking-tight ng-tns-c161-6"><?= Html::encode($this->title) ?></div>
        <div class="flex flex-shrink-0 items-center mt-6 sm:mt-0 sm:ml-4 ng-tns-c161-6">
          
          <button mat-flat-button="" class="mat-focus-indicator ml-4 ng-tns-c161-6 mat-flat-button mat-button-base mat-primary" ng-reflect-color="primary">
            <span class="mat-button-wrapper">
              <mat-icon role="img" class="mat-icon notranslate mat-icon-no-color" aria-hidden="true" ng-reflect-svg-icon="heroicons_outline:plus" data-mat-icon-type="svg" data-mat-icon-name="plus" data-mat-icon-namespace="heroicons_outline">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" fit="" height="100%" width="100%" preserveAspectRatio="xMidYMid meet" focusable="false">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
              </mat-icon>
              <span class="ml-2 mr-1"><?= Html::a(Yii::t('app', 'Add Card Type'), ['create'], ['class' => 'btn ']) ?></span>
            </span>
            <span matripple="" class="mat-ripple mat-button-ripple" ng-reflect-disabled="false" ng-reflect-centered="false" ng-reflect-trigger="[object HTMLButtonElement]"></span>
            <span class="mat-button-focus-overlay"></span>
          </button>
        </div>
      </div>


      <div class="flex-auto p-6 sm:p-10">
        <div class="max-w-3xl">
          <div class="prose prose-sm max-w-3xl">
            <!-- <p> By default, Fuse changes the default form field appearance to <em>fill</em> and heavily modifies it to provide a more unique and consistent look. We <strong>DO NOT</strong> recommend using any other form field styles as they are not optimized for Fuse. </p> -->
            <!-- <h2>Appearance</h2> -->
            <!-- <p> Here's a very simple form layout to showcase the form fields. </p> -->
          </div>
        



          <?php if (Yii::$app->session->hasFlash('success')): ?>
                <div class="alert alert-success alert-dismissable">
                    <!-- <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button> -->
                    <h4><i class="icon fa fa-check"></i>Saved!</h4>
                    <?= Yii::$app->session->getFlash('success') ?>
                </div>
            <?php endif; ?>

            <?php if (Yii::$app->session->hasFlash('error')): ?>
                <div class="alert alert-danger alert-dismissable">
                    <!-- <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button> -->
                    <h4><i class="icon fa fa-check"></i>Error!</h4>
                    <?= Yii::$app->session->getFlash('error') ?>
                </div>
            <?php endif; ?>


        



        <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            
            'id_cards_type',
            'name',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, app\models\CardsType $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id_cards_type' => $model->id_cards_type]);
                 }
            ],
        ],
        ]); ?>

        </div>
      </div>
  </div>