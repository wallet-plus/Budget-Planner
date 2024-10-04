<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\components\CustomLinkPager;
/* @var $this yii\web\View */
/* @var $searchModel app\models\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Categories');
$this->params['breadcrumbs'][] = $this->title;
?>



<div id="page-wrapper">
<div class="main-page">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Category'), ['create'], ['class' => 'btn btn-success']) ?>          
    </p>

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'summary' => false,
                        'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],

                            // 'id_type',
                            'category_name',
                            'status',
                            [
                                'class' => ActionColumn::className(),
                                'urlCreator' => function ($action, \app\models\Category $model, $key, $index, $column) {
                                    return Url::toRoute([$action, 'id_type' => $model->id_type]);
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

    <?php Pjax::end(); ?>

</div>
</div>