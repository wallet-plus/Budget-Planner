<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\components\CustomLinkPager;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Categories');
$this->params['breadcrumbs'][] = $this->title;
?>
 

 

<div class="container-xxl flex-grow-1 container-p-y">
  <div class="d-flex align-items-center justify-content-between mb-4" >
    <h4 class="py-3 mb-0"><span class="text-muted fw-light"><?= Html::a('Home', ['/site/dashboard']) ?> / <?= Html::encode($this->title) ?></span></h4>
    <small class="text-muted float-end">
    <?= Html::a(Yii::t('app', ' <button type="button" class="btn btn-primary">
        <span class="tf-icons bx bx-plus me-1"></span>Add '.Html::encode($this->title).'
      </button>'), ['create'], ['class' => 'btn']) ?>           
    </small>
  </div>


  <!-- Basic Layout & Basic with Icons -->
  <div class="row">
    <!-- Basic Layout -->
    <div class="col-xxl">
      <div class="card mb-4">

      <?php if (Yii::$app->session->hasFlash('success') || Yii::$app->session->hasFlash('error') ) { ?> 
        <div class="card-body">
          <?php if (Yii::$app->session->hasFlash('success')): ?>
              <div class="alert alert-success alert-dismissible" role="alert">
                  <?= Yii::$app->session->getFlash('success') ?>
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
          <?php endif; ?>

          <?php if (Yii::$app->session->hasFlash('error')): ?>
              <div class="alert alert-danger alert-dismissible" role="alert">
                  <?= Yii::$app->session->getFlash('error') ?>
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
          <?php endif; ?>
        </div>
        <?php } ?>



        <div class="card-body">
          <div class="table-responsive text-nowrap">

          <?= GridView::widget([
          'dataProvider' => $dataProvider,
          'summary' => false,
          'columns' => [
              ['class' => 'yii\grid\SerialColumn'],
              [
                'attribute' => 'image',
                'format' => 'raw',
                'value' => function ($data) {
                    if ($data->category_image) {
                        $imageUrl = Yii::$app->request->baseUrl . '/category/' . $data->category_image;
                        return '<img class="d-block rounded" src="' . $imageUrl . '" width="60px" height="60px" alt="Profile Picture">';
                    } else {
                        return ''; // Return an empty string if no image available
                    }
                },
              ],
              'category_name',
              [
                'attribute' => 'status',
                'value' => function ($data) {
                    return $data->status == 1 ? '<span class="badge bg-label-success">Active</span>' : '<span class="badge bg-label-secondary">Inactive</span>';
                },
                'format' => 'html',
              ],
              [
                'class' => ActionColumn::className(),
                'template' => '{update} {delete}', // Remove the '{view}' button
                'urlCreator' => function ($action, app\models\ExpenseCategory $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id_category' => $model->id_category]);
                },
                'buttons' => [
                  'update' => function ($url, $model, $key) {
                      return Html::a('<button class="btn btn-sm btn-icon"><i class="bx bx-edit"></i></button>', $url, [
                          'title' => Yii::t('app', 'Update'),
                          'data-pjax' => '0',
                      ]);
                  },
                  'delete' => function ($url, $model, $key) {
                      return Html::a('<button class="btn btn-sm btn-icon delete-record"><i class="bx bx-trash"></i></button>', $url, [
                          'title' => Yii::t('app', 'Delete'),
                          'data' => [
                              'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                              'method' => 'post',
                          ],
                      ]);
                  },
              ],
            ],
          ],
          'tableOptions' => ['class' => 'table table-hover'],
          'pager' => [
            'class' => \app\components\CustomLinkPager::class,
          ],
          ]); ?>

           
          </div>
        </div>

      </div>
    </div>

  </div>
</div>
