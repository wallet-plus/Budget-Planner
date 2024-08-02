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
                        for="basic-default-company"><?= Html::label('Category Name', null, []); ?></label>
                    <div class="col-sm-10">
                        <?php echo Html::activeTextInput($model, 'category_name', ['class' => 'form-control']); ?>
                        <?php echo Html::error($model, 'category_name'); ?>
                    </div>
                </div>


                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label"
                        for="basic-default-name"><?= Html::label('Type', null, []); ?></label>
                    <div class="col-sm-10">
                        <?= Html::activeDropDownList($model, 'id_type', $types,
                        array( 'prompt' => '--Select Category--','class'=>'form-control')
                        ) ?>
                        <?php echo Html::error($model, 'id_type'); ?>
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label"
                        for="basic-default-email"><?= Html::label('Parent Category', null, []); ?></label>
                    <div class="col-sm-10">
                        <div class="input-group input-group-merge">
                            <?= Html::activeDropDownList($model, 'parent', $catagories,
                            array( 'prompt' => '--Select Category--','class'=>'form-control')
                            ) ?>
                            <?php echo Html::error($model, 'parent') ?>
                        </div>
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



                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label"
                        for="basic-default-company"><?= Html::label('Image', null, []); ?></label>
                    <div class="col-sm-10">
                        <?php if($model->category_image) { ?> 
                            <?= Html::a(
                                Html::img('@web/expenses/' . $model->category_image, [
                                    'width' => '100',
                                    'height' => '100',
                                    'class' => 'd-block rounded',
                                    'id' => 'uploadedAvatar',
                                    'alt' => 'user-avatar'
                                ]), 
                                ['site/download-image', 'filename' => $model->category_image]
                            ) ?>
                        <?php } ?>
                    
                        <?= $form->field($model, 'imageFile')->fileInput(['accept' => 'image/*'])->label(false) ?>
                        <?php echo Html::error($model, 'category_image'); ?>
                    </div>
                </div>



                <div class="row justify-content-end">
                    <div class="col-sm-10">
                        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-primary']) ?>
                        <?= Html::a('Cancel', ['/category/index'], ['class' => 'btn btn-primary']) ?>
                    </div>
                </div>
                <<?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
