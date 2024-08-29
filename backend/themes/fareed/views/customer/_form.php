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
                <h5 class="mb-0">Customer Form</h5>
                <small class="text-muted float-end">Please fill out the form below</small>
            </div>
            <div class="card-body">

                <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

                <!-- <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="customer-id_customer_type"><?= Html::label('Customer Type', null, []); ?></label>
                    <div class="col-sm-10">
                        <?= $form->field($model, 'id_customer_type')->textInput()->label(false) ?>
                    </div>
                </div> -->

                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="customer-firstname"><?= Html::label('First Name', null, []); ?></label>
                    <div class="col-sm-10">
                        <?= $form->field($model, 'firstname')->textInput(['maxlength' => true])->label(false) ?>
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="customer-username"><?= Html::label('Username', null, []); ?></label>
                    <div class="col-sm-10">
                        <?= $form->field($model, 'username')->textInput(['maxlength' => true])->label(false) ?>
                    </div>
                </div>
                
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="customer-phone"><?= Html::label('Phone', null, []); ?></label>
                    <div class="col-sm-10">
                        <?= $form->field($model, 'phone')->textInput(['maxlength' => true])->label(false) ?>
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="customer-lastname"><?= Html::label('Last Name', null, []); ?></label>
                    <div class="col-sm-10">
                        <?= $form->field($model, 'lastname')->textInput(['maxlength' => true])->label(false) ?>
                    </div>
                </div>


                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="customer-email"><?= Html::label('Email', null, []); ?></label>
                    <div class="col-sm-10">
                        <?= $form->field($model, 'email')->textInput(['maxlength' => true])->label(false) ?>
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="customer-password"><?= Html::label('Password', null, []); ?></label>
                    <div class="col-sm-10">
                        <?= $form->field($model, 'password')->passwordInput(['maxlength' => true])->label(false) ?>
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="customer-otp"><?= Html::label('OTP', null, []); ?></label>
                    <div class="col-sm-10">
                        <?= $form->field($model, 'otp')->textInput(['maxlength' => true])->label(false) ?>
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="customer-email_verification_code"><?= Html::label('Email Verification Code', null, []); ?></label>
                    <div class="col-sm-10">
                        <?= $form->field($model, 'email_verification_code')->textInput(['maxlength' => true])->label(false) ?>
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="customer-email_verified"><?= Html::label('Email Verified', null, []); ?></label>
                    <div class="col-sm-10">
                        <?= $form->field($model, 'email_verified')->textInput()->label(false) ?>
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="customer-mobile_verification_code"><?= Html::label('Mobile Verification Code', null, []); ?></label>
                    <div class="col-sm-10">
                        <?= $form->field($model, 'mobile_verification_code')->textInput(['maxlength' => true])->label(false) ?>
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="customer-mobile_verified"><?= Html::label('Mobile Verified', null, []); ?></label>
                    <div class="col-sm-10">
                        <?= $form->field($model, 'mobile_verified')->textInput()->label(false) ?>
                    </div>
                </div>

                <!-- <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="customer-authKey"><?= Html::label('Auth Key', null, []); ?></label>
                    <div class="col-sm-10">
                        <?= $form->field($model, 'authKey')->textInput(['maxlength' => true])->label(false) ?>
                    </div>
                </div> -->

                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="customer-date_created"><?= Html::label('Date Created', null, []); ?></label>
                    <div class="col-sm-10">
                        <?= $form->field($model, 'date_created')->textInput()->label(false) ?>
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="customer-date_updated"><?= Html::label('Date Updated', null, []); ?></label>
                    <div class="col-sm-10">
                        <?= $form->field($model, 'date_updated')->textInput()->label(false) ?>
                    </div>
                </div>

                <div class="row justify-content-end">
                    <div class="col-sm-10">
                        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-primary']) ?>
                        <?= Html::a('Cancel', ['/customer/index'], ['class' => 'btn btn-secondary']) ?>
                    </div>
                </div>

                <?php ActiveForm::end(); ?>

            </div>
        </div>
    </div>
</div>
