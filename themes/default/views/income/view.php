<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Expense */

$this->title = $model->id_expense;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Expenses'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div id="page-wrapper">
<div class="main-page">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id_expense' => $model->id_expense], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id_expense' => $model->id_expense], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_expense',
            'id_type',
            'id_category',
            'id_customer',
            'expense_name',
            'description:ntext',
            'image',
            'amount',
            'date_of_transaction',
            'deleted',
            'created_by',
            'date_created',
            'updated_by',
            'date_updated',
        ],
    ]) ?>

</div>
    </div?>
