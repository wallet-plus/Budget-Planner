<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Email */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Emails', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="email-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id_email' => $model->id_email], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id_email' => $model->id_email], [
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
            'id_email:email',
            'name',
            'id_email_template:email',
            'email_content:ntext',
            'from_name',
            'from_email:email',
            'subject',
            'cc_email:email',
            'create_by',
            'created_at',
            'updated_by',
            'updated_at',
        ],
    ]) ?>

</div>
