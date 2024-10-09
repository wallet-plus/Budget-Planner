<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Expense */

$this->title = Yii::t('app', 'Update Reminders: {name}', [
    'name' => $model->name,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Reminders'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id_reminder' => $model->id_reminder]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="container-scroller">
  <!-- partial:../../partials/_navbar.html -->
  <div class="content-wrapper">
    <div class="row">
      <div class="col-12 grid-margin">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title"><?= Html::encode($this->title) ?></h4>

            <?= $this->render('_form', [
            'model' => $model
            ]) ?>
            
          </div>
        </div>
      </div>


    </div>
    <!-- main-panel ends -->
  </div>
  <!-- page-body-wrapper ends -->
</div>

