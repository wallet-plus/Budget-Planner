<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CardsType */

$this->title = 'Update Cards Type: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Cards Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id_cards_type' => $model->id_cards_type]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="cards-type-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
