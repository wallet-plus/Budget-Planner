<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use app\models\Events;
?>




<div class="row">
    <!-- Basic Layout -->
    <div class="col-xxl">
        <div class="card mb-4">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="mb-0">Event Details</h5>
                <!-- <small class="text-muted float-end">Default label</small> -->
            </div>
            <div class="card-body">


                <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label"
                        for="basic-default-company"><?= Html::label('Event Name', null, []); ?></label>
                    <div class="col-sm-10">
                        <?php echo Html::activeTextInput($model, 'event_name', ['class' => 'form-control']); ?>
                        <?php echo Html::error($model, 'event_name'); ?>
                    </div>
                </div>



                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label"
                        for="basic-default-start-date"><?= Html::label('Start Date', null, []); ?></label>
                    <div class="col-sm-10">
                        <?= Html::activeInput('date', $model, 'start_date', ['class' => 'form-control']); ?>
                        <?= Html::error($model, 'start_date'); ?>
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label"
                        for="basic-default-end-date"><?= Html::label('End Date', null, []); ?></label>
                    <div class="col-sm-10">
                        <?= Html::activeInput('date', $model, 'end_date', ['class' => 'form-control']); ?>
                        <?= Html::error($model, 'end_date'); ?>
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label"
                        for="basic-default-phone"><?= Html::label('Status', null, []); ?></label>
                    <div class="col-sm-10">
                        <?= Html::activeDropDownList($model, 'status',
                        array('1' => 'Active', '0' => 'Deactive'),
                        array('class'=>'form-control')        
                        ) ?>
                        <?php echo Html::error($model, 'status'); ?>
                    </div>
                </div>



               


                <div class="row justify-content-end">
                    <div class="col-sm-10">
                        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-primary']) ?>
                        <?= Html::a('Cancel', ['/events/index'], ['class' => 'btn btn-primary']) ?>
                    </div>
                </div>
                <<?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
