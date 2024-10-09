<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Savings');
$this->params['breadcrumbs'][] = $this->title;
?>

<!-- Your other HTML content goes here -->
<div class="content-wrapper">
  <div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="col-md-9">
              <h4 class="card-title"><?= Html::encode($this->title) ?></h4>
            </div>
            <div class="col-md-3">
              <button type="button" class="btn btn-primary btn-icon-text">
                <i class="ti-file btn-icon-prepend"></i>
                <?= Html::a(Yii::t('app', 'Add '.Html::encode($this->title)), ['create']) ?>
              </button>
            </div>
          </div>
          <div class="table-responsive">
            <?= GridView::widget([
              'dataProvider' => $dataProvider,
              'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'expense_name',
                'amount',
                'date_of_transaction',
                [
                  'class' => ActionColumn::className(),
                  'contentOptions' => ['class' => 'table-striped'],
                  'template' => '{update} {delete}',
                  'urlCreator' => function ($action, \app\models\Expense $model, $key, $index, $column) {
                      return Url::toRoute([$action, 'id_expense' => $model->id_expense]);
                  }
                ],
              ],
            ]); ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>