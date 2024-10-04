
<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use app\components\CustomLinkPager;
use app\helpers\CurrencyFormatHelper;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Income');
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="container-xxl flex-grow-1 container-p-y ">
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

        <div class="card-header">
          <div class="d-flex justify-content-between align-items-center row py-3 gap-3 gap-md-0">
            <div class="col-md-4 product_status"><select id="ProductStatus" class="form-select text-capitalize"><option value="">Status</option><option value="Scheduled">Scheduled</option><option value="Publish">Publish</option><option value="Inactive">Inactive</option></select></div>
            <div class="col-md-4 product_category"><select id="ProductCategory" class="form-select text-capitalize"><option value="">Category</option><option value="Household">Household</option><option value="Office">Office</option><option value="Electronics">Electronics</option><option value="Shoes">Shoes</option><option value="Accessories">Accessories</option><option value="Game">Game</option></select></div>
            <div class="col-md-4 product_stock"><select id="ProductStock" class="form-select text-capitalize"><option value=""> Stock </option><option value="Out_of_Stock">Out of Stock</option><option value="In_Stock">In Stock</option></select></div>
          </div>
        </div>


        <div class="card-body">
          <div class="table-responsive text-nowrap">

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'summary' => false,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'expense_name',
                    [
                      'attribute' => 'amount',
                      'value' => function ($data) {
                          return CurrencyFormatHelper::formatCurrency($data->amount);
                      },
                    ],
                    'date_of_transaction',
                    [
                        'class' => ActionColumn::className(),
                        'template' => '{update} {delete}',
                        'urlCreator' => function ($action, \app\models\Expense $model, $key, $index, $column) {
                            return Url::toRoute([$action, 'id_expense' => $model->id_expense]);
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