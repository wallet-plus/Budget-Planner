<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ExpenseCategory */

$this->title = Yii::t('app', 'Update Category: {name}', [
    'name' => $model->id_category,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_category, 'url' => ['view', 'id_category' => $model->id_category]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>

<div class="flex flex-col flex-auto min-w-0">
  <div class="flex flex-col sm:flex-row flex-0 sm:items-center sm:justify-between p-6 sm:py-8 sm:px-10 border-b bg-card dark:bg-transparent">
    <div class="flex-1 min-w-0">
      <div class="flex flex-wrap items-center font-medium">
        <div>
        <?= Html::a('Home', ['/site/dashboard'], ['class'=>'mat-focus-indicator mat-button mat-button-base']) ?>
        </div>
  

        <div class="flex items-center ml-1 whitespace-nowrap">

        <mat-icon role="img" class="mat-icon notranslate icon-size-5 text-secondary mat-icon-no-color" aria-hidden="true" ng-reflect-svg-icon="heroicons_solid:chevron-right" data-mat-icon-type="svg" data-mat-icon-name="chevron-right" data-mat-icon-namespace="heroicons_solid">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" fit="" height="100%" width="100%" preserveAspectRatio="xMidYMid meet" focusable="false">
              <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
            </svg>
          </mat-icon>

        <?= Html::a('Category', ['/category/index'], ['class'=>'ml-1 text-primary-500']) ?>

          <mat-icon role="img" class="mat-icon notranslate icon-size-5 text-secondary mat-icon-no-color" aria-hidden="true" ng-reflect-svg-icon="heroicons_solid:chevron-right" data-mat-icon-type="svg" data-mat-icon-name="chevron-right" data-mat-icon-namespace="heroicons_solid">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" fit="" height="100%" width="100%" preserveAspectRatio="xMidYMid meet" focusable="false">
              <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
            </svg>
          </mat-icon>
          

          <a class="ml-1 text-primary-500"><?= Html::encode($this->title) ?></a>
        </div>
      </div>
      <div class="mt-2">
        <h2 class="text-3xl md:text-4xl font-extrabold tracking-tight leading-7 sm:leading-10 truncate"> <?= Html::encode($this->title) ?> </h2>
      </div>
    </div>
  </div>
  
  <div class="flex-auto p-6 sm:p-10">
    <div class="max-w-3xl">
      <div class="prose prose-sm max-w-3xl">
        <!-- <p> By default, Fuse changes the default form field appearance to <em>fill</em> and heavily modifies it to provide a more unique and consistent look. We <strong>DO NOT</strong> recommend using any other form field styles as they are not optimized for Fuse. </p> -->
        <!-- <h2>Appearance</h2> -->
        <!-- <p> Here's a very simple form layout to showcase the form fields. </p> -->
      </div>

      <?= $this->render('_form', [
        'model' => $model,
        'catagories' => $catagories,
        'types' => $types
        ]) ?>
    </div>
  </div>
</div>