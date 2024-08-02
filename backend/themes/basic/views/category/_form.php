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
    echo $form->field($model, 'id_type')->hiddenInput(['value' => 2])->label(false);
    ?>
    <p class="card-description">
        Details
    </p>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group row">
                <label class="col-sm-3 col-form-label"><?= Html::label('Category Name', null, []);?></mat-label> </label>
                <div class="col-sm-9">
                    <?php echo Html::activeTextInput($model, 'category_name', ['class' => 'form-control']); ?>

                    <?php echo Html::error($model, 'category_name', ['class' => 'mat-form-field-infix']); ?>
                </div>
            </div>
        </div>
        <div class="col-md-6">
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label"><?= Html::label('Status', null, []); ?></label>
                    <div class="col-sm-9">
                    <?= Html::activeDropDownList($model, 'status',
                        array('1' => 'Active', '0' => 'Deactive'),
                        array('class' => 'form-control')        
                        ) ?>
                        <?php echo Html::error($model, 'status', ['class' => 'help-block']); ?>
                    </div>
                </div>

            
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group row">
                <label class="col-sm-3 col-form-label"><?= Html::label('Type', null, []); ?></label>
                <div class="col-sm-9">
                     <?= Html::activeDropDownList($model, 'id_type', $types,
                    array( 'prompt' => '--Select Category--','class' => 'form-control')
                    ) ?>
                    <?php echo Html::error($model, 'id_type', ['class' => 'help-block']); ?>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group row">
                <label class="col-sm-3 col-form-label"><?= Html::label('Parent Category', null, []);?></label>
                <div class="col-sm-9">
                <?= Html::activeDropDownList($model, 'parent', $catagories,
                    array( 'prompt' => '--Select Category--','class' => 'form-control')
                    ) ?>
                    <?php echo Html::error($model, 'parent', ['class' => 'help-block']); ?>
                </div>
            </div>
        </div>
    </div>
    

    <div class="row">
        <div class="col-md-6">
            <div class="form-group row">
                <label class="col-sm-3 col-form-label"><?= Html::label('Image', null, []);?></label>
                <div class="col-sm-9">
                    <?= $form->field($model, 'imageFile')->fileInput(['accept' => 'image/*']) ?>
                    <?php echo Html::error($model, 'category_image', ['class' => 'mat-form-field-infix']); ?>
                </div>

                <?php if ($model->category_image): ?>
                    <?= Html::a(Html::img('@web/category/' . $model->category_image, ['width' => '100']), ['site/download-image', 'filename' =>  $model->category_image]) ?>
                <?php endif; ?>
            </div>
        </div>
    </div>


    <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-primary mr-2']) ?>
    <?= Html::a('Cancel', ['/expense/index'], ['class' => 'btn btn-light']) ?>
</form>


<?php ActiveForm::end(); ?>
