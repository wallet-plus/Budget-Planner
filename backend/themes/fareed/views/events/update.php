<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ExpenseCategory */

$this->title = Yii::t('app', 'Update Event: {name}', [
    'name' => $model->id_event,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_event, 'url' => ['view', 'id_event' => $model->id_event]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="py-3 mb-4">
    <span class="text-muted fw-light"><?= Html::a('Home', ['/site/dashboard']) ?> /</span>
    <span class="text-muted fw-light"><?= Html::a('Events', ['/events/index']) ?> /</span>
    <?= Html::encode($this->title) ?></h4>

  <?= $this->render('_form', [
    'model' => $model
  ]) ?>
</div>