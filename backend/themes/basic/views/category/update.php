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

<div class="container-scroller">
  <div class="content-wrapper">
    <div class="row">
      <div class="col-12 grid-margin">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title"><?= Html::encode($this->title) ?></h4>
            <?= $this->render('_form', [
            'model' => $model,
            'catagories' => $catagories,
            'types' => $types
            ]) ?>
          </div>
        </div>
      </div>
    </div>
    <!-- main-panel ends -->
  </div>
  <!-- page-body-wrapper ends -->
</div>