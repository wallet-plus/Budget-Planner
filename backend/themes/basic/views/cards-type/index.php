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
    </div>
  </div>
</div>

