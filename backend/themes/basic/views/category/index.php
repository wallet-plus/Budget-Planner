<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Categories');
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
              [
                'attribute' => 'image',
                'format' => 'html',
                'value' => function ($data) {
                    return (!!$data->category_image)?Html::img(Yii::$app->request->baseUrl.'/category/'.$data->category_image,
                        ['width' => '60px', 'height' => '60px']): false;
                },
              ],
              'category_name',
              // 'category_image',
              'status',
              [
                'class' => ActionColumn::className(),
                'template' => '{update} {delete}', // Remove the '{view}' button
                'urlCreator' => function ($action, app\models\ExpenseCategory $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id_category' => $model->id_category]);
                },
            ],
            ],
            ]); ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>