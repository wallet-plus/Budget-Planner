<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Category */

$this->title = Yii::t('app', 'Update Category: {name}', [
    'name' => $model->id_type,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_type, 'url' => ['view', 'id_type' => $model->id_type]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div id="page-wrapper">
<div class="main-page">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'catagories' =>$catagories
    ]) ?>
</div>
</div>
