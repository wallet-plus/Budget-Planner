<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Customer */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="row">
    <!-- Basic Layout -->
    <div class="col-xxl">
        <div class="card mb-4">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="mb-0">Contact Form</h5>
                <small class="text-muted float-end">Please fill out the form below</small>
            </div>
            <div class="card-body">

                <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

                

                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="customer-firstname"><?= Html::label('First Name', null, []); ?></label>
                    <div class="col-sm-10">
                        <?= $form->field($model, 'firstname')->textInput(['maxlength' => true])->label(false) ?>
                    </div>
                </div>

               
                
             
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="customer-lastname"><?= Html::label('Last Name', null, []); ?></label>
                    <div class="col-sm-10">
                        <?= $form->field($model, 'lastname')->textInput(['maxlength' => true])->label(false) ?>
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="customer-phone"><?= Html::label('Phone', null, []); ?></label>
                    <div class="col-sm-10">
                        <?= $form->field($model, 'phone_number')->textInput(['maxlength' => true])->label(false) ?>
                    </div>
                </div>


                <div class="row justify-content-end">
                    <div class="col-sm-10">
                        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-primary']) ?>
                        <?= Html::a('Cancel', ['/member/index'], ['class' => 'btn btn-secondary']) ?>
                    </div>
                </div>

                <?php ActiveForm::end(); ?>

            </div>
        </div>
    </div>
</div>

