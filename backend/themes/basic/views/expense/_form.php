<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use app\models\Category

/* @var $this yii\web\View */
/* @var $model app\models\Expense */
/* @var $form yii\widgets\ActiveForm */
?>

<link rel="stylesheet" href="<?php echo Yii::$app->view->theme->baseUrl; ?>/basic/vendors/select2/select2.min.css">


<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
<form class="form-sample">
    <?php
    echo $form->field($model, 'id_type')->hiddenInput(['value' => 2])->label(false);
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
                        array('prompt' => '--Select Category--', 'class' => 'form-control js-example-basic-single')
                    ) ?>
                    <?php echo Html::error($model, 'id_category', ['class' => 'help-block']); ?>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group row">
                <label class="col-sm-3 col-form-label"><?= Html::label('Amount', null, []); ?></label>
                <div class="col-sm-9">
                    <?php echo Html::activeTextInput($model, 'amount', ['class' => 'form-control',  'type' => 'number', 'step' => '0.01', 'oninput' => 'validateNumberInput(this)']); ?>
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
                    <?= $form->field($model, 'imageFile')->fileInput(['accept' => 'image/*', ['class' => 'form-control']])->label(false) ?>
                    <?php echo Html::error($model, 'image', ['class' => 'help-block']); ?>
                </div>
            </div>
        </div>
    </div>

 

    <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-primary mr-2']) ?>
    <?= Html::a('Cancel', ['/expense/index'], ['class' => 'btn btn-light']) ?>
</form>


<?php ActiveForm::end(); ?>
<script src="<?php echo Yii::$app->view->theme->baseUrl; ?>/basic/vendors/js/vendor.bundle.base.js"></script>
<script src="<?php echo Yii::$app->view->theme->baseUrl; ?>/basic/vendors/select2/select2.min.js"></script>
<script src="<?php echo Yii::$app->view->theme->baseUrl; ?>/basic/js/select2.js"></script>
<script>
    function validateNumberInput(input) {
        input.value = input.value.replace(/[^\d.]/g, '');
        if (input.value.split('.').length > 2) {
            input.value = input.value.replace(/\.+$/, '');
        }
    }
</script>