<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use app\models\Category;
/* @var $this yii\web\View */
/* @var $model app\models\Expense */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="row">
    <!-- Basic Layout -->
    <div class="col-xxl">
        <div class="card mb-4">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="mb-0">Expense Details</h5>
                <!-- <small class="text-muted float-end">Default label</small> -->
            </div>
            <div class="card-body">


                <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

                <?php
                echo $form->field($model, 'id_type')->hiddenInput(['value' => 2])->label(false);
                ?>

                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label"
                        for="basic-default-company"><?= Html::activeLabel($model, 'expense_name', []); ?>
                        </label>
                    <div class="col-sm-10">
                        <?php echo Html::activeTextInput($model, 'expense_name', ['class' => 'form-control']); ?>
                        <?php echo Html::error($model, 'expense_name'); ?>
                    </div>
                </div>


                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label"
                        for="basic-default-name"><?= Html::activeLabel($model, 'id_category', []); ?></label>
                    <div class="col-sm-10">
                        <?= Html::activeDropDownList(
                            $model,
                            'id_category',
                            $catagories,
                            array('prompt' => '--Select Category--', 'class' => 'form-control')
                        ) ?>
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label"
                        for="basic-default-email"><?= Html::activeLabel($model, 'amount', []); ?></label>
                    <div class="col-sm-10">
                        <div class="input-group input-group-merge">
                            <?php echo Html::activeTextInput($model, 'amount', 
                            ['class' => 'form-control']); ?>
                            <?php echo Html::error($model, 'amount') ?>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label"
                        for="basic-default-phone"><?= Html::activeLabel($model, 'date_of_transaction', []); ?></label>
                    <div class="col-sm-10">

                        <?php echo $model->date_of_transaction?>
                        <?= $form->field($model, 'date_of_transaction')->widget(\yii\jui\DatePicker::class, [
                            'dateFormat' => 'php:d/m/Y',
                            'options' => ['class' => 'form-control', 'type' => 'date'],
                        ])->label(false) ?>

                        <?php echo Html::error($model, 'date_of_transaction'); ?>
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label"
                        for="basic-default-message"><?= Html::activeLabel($model, 'description', []); ?></label>
                    <div class="col-sm-10">

                        <?= $form->field($model, 'description')->textarea(['rows' => '3', 'class' => 'form-control'])->label(false) ?>
                        <?php echo Html::error($model, 'description'); ?>
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label"
                        for="basic-default-name"><?= Html::activeLabel($model, 'id_event', []); ?></label>
                    <div class="col-sm-10">
                        <?= Html::activeDropDownList(
                            $model,
                            'id_event',
                            $events,
                            array('prompt' => '--Select Event--', 'class' => 'form-control')
                        ) ?>
                    </div>
                </div>


                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label"
                        for="basic-default-company"><?= Html::activeLabel($model, 'image', []); ?></label>
                    <div class="col-sm-10">
                        <?php if ($model->image) { ?>
                            <?= Html::a(
                                Html::img('@web/expenses/' . $model->image, [
                                    'width' => '100',
                                    'height' => '100',
                                    'class' => 'd-block rounded',
                                    'id' => 'uploadedAvatar',
                                    'alt' => 'user-avatar'
                                ]),
                                ['expense/download-image', 'filename' => $model->image]
                            ) ?>
                        <?php } ?>

                        <?= $form->field($model, 'imageFile')->fileInput(['accept' => 'image/*'])->label(false) ?>
                        <?php echo Html::error($model, 'image'); ?>
                    </div>
                </div>



                <div class="row justify-content-end">
                    <div class="col-sm-10">
                        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-primary']) ?>
                        <?= Html::a('Cancel', ['/expense/index'], ['class' => 'btn btn-primary']) ?>
                    </div>
                </div>
                <<?php ActiveForm::end(); ?>
                    </div>
            </div>
        </div>
    </div>