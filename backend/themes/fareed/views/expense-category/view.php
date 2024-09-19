<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ExpenseCategory */

$this->title = $model->id_category;
$this->params['breadcrumbs'][] = ['label' => 'Expense Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="expense-category-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id_category' => $model->id_category], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id_category' => $model->id_category], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_category',
            'id_type',
            'id_user',
            'parent',
            'category_name',
            'category_description:ntext',
            'category_image',
            'status',
        ],
    ]) ?>

</div>
