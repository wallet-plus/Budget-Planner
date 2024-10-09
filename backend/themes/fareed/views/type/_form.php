<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Category;
/* @var $this yii\web\View */
/* @var $model app\models\Category */
/* @var $form yii\widgets\ActiveForm */
?>
<style>
    .field-expense-description{ width : 100%; }
</style>
<div class="category-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'category_name')->textInput(['maxlength' => true]) ?>

    <!-- <?= $form->field($model, 'status')->textInput() ?> -->

   
    <div>
        <?= Html::label('Parent Category', null, ['class' => 'inline checkbox']);?>
        <?= Html::activeDropDownList($model, 'parent',
        $catagories,
        array('class'=>'form-control')
        ) ?>
    </div>

    <div>
        <?= Html::label('Status', null, ['class' => 'inline checkbox']);?>
        <?= Html::activeDropDownList($model, 'status',
        array('1' => 'Active', '0' => 'Deactive'),
        array('class'=>'form-control')        
        ) ?>
    </div>

    <br />
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
