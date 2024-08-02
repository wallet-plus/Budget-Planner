<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use app\components\CustomLinkPager;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Customers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customer-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Customer', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'summary' => false,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'id_customer_type',
            'firstname',
            'lastname',
            'username',
            //'email:email',
            //'password',
            //'otp',
            //'phone',
            //'email_verification_code:email',
            //'email_verified:email',
            //'mobile_verification_code',
            //'mobile_verified',
            //'authKey',
            //'date_created',
            //'date_updated',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Customer $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
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
