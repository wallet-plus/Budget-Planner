<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Expense */

$this->title = Yii::t('app', 'Update Income: {name}', [
    'name' => $model->id_expense,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Expenses'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_expense, 'url' => ['view', 'id_expense' => $model->id_expense]];
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
            'catagories' => $catagories
            ]) ?>
          </div>
        </div>
      </div>
    </div>
    <!-- main-panel ends -->
  </div>
  <!-- page-body-wrapper ends -->
</div>