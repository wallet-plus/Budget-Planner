<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Emails');
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
                  'id_email:email',
                  'name',
                  // 'id_email_template:email',
                  // 'email_content:ntext',
                  'from_name',
                  //'from_email:email',
                  'subject',
                  //'cc_email:email',
                  //'create_by',
                  //'created_at',
                  //'updated_by',
                  //'updated_at',
                  [
                      'class' => ActionColumn::className(),
                      'urlCreator' => function ($action, app\models\Email $model, $key, $index, $column) {
                          return Url::toRoute([$action, 'id_email' => $model->id_email]);
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
      