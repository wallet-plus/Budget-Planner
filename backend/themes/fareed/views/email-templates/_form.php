<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use app\models\Category

/* @var $this yii\web\View */
/* @var $model app\models\Expense */
/* @var $form yii\widgets\ActiveForm */
?>



<div class="row">
    <!-- Basic Layout -->
    <div class="col-xxl">
        <div class="card mb-4">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="mb-0">Basic Layout</h5>
                <small class="text-muted float-end">Default label</small>
            </div>
            <div class="card-body">


                <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>


                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label"
                        for="basic-default-email"><?= Html::label('title', null, []); ?></label>
                    <div class="col-sm-10">
                        <div class="input-group input-group-merge">
                            <?php echo Html::activeTextInput($model, 'title', ['class' => 'form-control']); ?>
                            <?php echo Html::error($model, 'title') ?>
                        </div>
                    </div>
                </div>



                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label"
                        for="basic-default-message"><?= Html::label('Email Template', null, []); ?></label>
                    <div class="col-sm-10">

                        <?= $form->field($model, 'email_template')->textarea(['rows' => '13', 'class' => 'form-control'])->label(false) ?>
                        <?php echo Html::error($model, 'email_template'); ?>
                    </div>
                </div>

                <div class="row justify-content-end">
                    <div class="col-sm-10">
                        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-primary']) ?>
                        <?= Html::a('Cancel', ['/email-tempaltes/index'], ['class' => 'btn btn-primary']) ?>
                    </div>
                </div>
                <<?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>

