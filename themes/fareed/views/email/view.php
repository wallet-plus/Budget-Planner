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

<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="py-3 mb-4"><span class="text-muted fw-light"><?= Html::a('Home', ['/site/dashboard']) ?> /</span>
    <?= Html::encode($this->title) ?></h4>

    <div class="email-view">

        <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0"><?= Html::encode($this->title) ?></h5>
            <small class="text-muted float-end">
            <?= Html::a('Update', ['update', 'id_email' => $model->id_email], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Delete', ['delete', 'id_email' => $model->id_email], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]) ?>   
            
            
            </small>
        </div>


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
</div>


