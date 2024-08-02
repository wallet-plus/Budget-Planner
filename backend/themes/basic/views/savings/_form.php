<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use app\models\Category

/* @var $this yii\web\View */
/* @var $model app\models\Expense */
/* @var $form yii\widgets\ActiveForm */
?>


<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
<form class="form-sample">
    <?php
    echo $form->field($model, 'id_type')->hiddenInput(['value' => 1])->label(false);
    ?>
    <p class="card-description">
        Details
    </p>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group row">
                <label class="col-sm-3 col-form-label"><?= Html::label('Name', null, []); ?></mat-label> </label>
                <div class="col-sm-9">
                    <?php echo Html::activeTextInput($model, 'expense_name', ['class' => 'form-control']); ?>

                    <?php echo Html::error($model, 'expense_name', ['class' => 'mat-form-field-infix']); ?>
                </div>
            </div>

        </div>
        <div class="col-md-6">
            <div class="form-group row">
                <label class="col-sm-3 col-form-label"><?= Html::label('Category', null, []); ?></label>
                <div class="col-sm-9">
                    <?= Html::activeDropDownList(
                        $model,
                        'id_category',
                        $catagories,
                        array('prompt' => '--Select Category--', 'class' => 'form-control')
                    ) ?>
                    <?php echo Html::error($model, 'id_category', ['class' => 'mat-form-field-infix']); ?>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group row">
                <label class="col-sm-3 col-form-label"><?= Html::label('Amount', null, []); ?></label>
                <div class="col-sm-9">
                    <?php echo Html::activeTextInput($model, 'amount', ['class' => 'form-control']); ?>
                    <?php echo Html::error($model, 'amount', ['class' => 'help-block']); ?>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group row">
                <label class="col-sm-3 col-form-label"><?= Html::label('Date Of Transaction', null, []); ?></label>
                <div class="col-sm-9">
                    <?= $form->field($model, 'date_of_transaction')->widget(\yii\jui\DatePicker::class, [
                        'dateFormat' => 'php:d/m/Y',
                        'options' => ['class' => 'form-control'],
                    ])->label(false) ?>
                    <?php echo Html::error($model, 'date_of_transaction', ['class' => 'help-block']); ?>
                </div>
            </div>
        </div>
    </div>
    

    <div class="row">
        <div class="col-md-6">
            <div class="form-group row">
                <label class="col-sm-3 col-form-label"><?= Html::label('Description', null, []); ?></label>
                <div class="col-sm-9">
                    <?= $form->field($model, 'description')->textarea(['rows' => '3', 'class' => 'form-control'])->label(false) ?>
                    <?php echo Html::error($model, 'description', ['class' => 'help-block']); ?>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group row">
                <label class="col-sm-3 col-form-label"><?= Html::label('Image', null, []); ?></label>
                <div class="col-sm-9">
                    <?= $form->field($model, 'imageFile')->fileInput(['accept' => 'image/*', ['class' => 'form-control']]) ?>
                    <?php echo Html::error($model, 'image', ['class' => 'help-block']); ?>
                </div>
            </div>
        </div>
    </div>



    <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-primary mr-2']) ?>
    <?= Html::a('Cancel', ['/savings/index'], ['class' => 'btn btn-light']) ?>
</form>


<?php ActiveForm::end(); ?>