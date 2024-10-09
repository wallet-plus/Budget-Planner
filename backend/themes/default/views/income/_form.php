<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use app\models\Category

/* @var $this yii\web\View */
/* @var $model app\models\Expense */
/* @var $form yii\widgets\ActiveForm */
?>

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="//code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="//code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
<style>
    .field-expense-description{ width : 100%; }
</style>
<form novalidate="" class="flex flex-col mt-8 p-8 pb-4 bg-card rounded-2xl shadow overflow-hidden ng-untouched ng-pristine ng-valid">
    <div class="flex flex-col gt-xs:flex-row">
        

    <?php 
        echo $form->field($model, 'id_type')->hiddenInput(['value'=> 3])->label(false);
    ?>

    <mat-form-field class="mat-form-field flex-auto gt-xs:pr-3  mat-primary mat-form-field-type-mat-input mat-form-field-appearance-fill mat-form-field-can-float mat-form-field-has-label mat-form-field-hide-placeholder ng-star-inserted" >
            <div class="mat-form-field-wrapper ">
                <div class="mat-form-field-flex ">
                <div class="mat-form-field-infix ">
                    <?php echo Html::activeTextInput($model, 'expense_name');?>  
                    <span class="mat-form-field-label-wrapper ">
                        <label class="mat-form-field-label  mat-empty mat-form-field-empty ng-star-inserted" ng-reflect-disabled="true" id="mat-form-field-label-5" ng-reflect-ng-switch="true" for="mat-input-2" aria-owns="mat-input-2">
                        <mat-label class=" ng-star-inserted"><?= Html::label('Name', null, []);?></mat-label>
                        </label>
                    </span>
                </div>
                </div>
                <div class="mat-form-field-subscript-wrapper " ng-reflect-ng-switch="hint">
                <div class="mat-form-field-hint-wrapper  ng-trigger ng-trigger-transitionMessages ng-star-inserted" style="opacity: 1; transform: translateY(0%);">
                    <div class="mat-form-field-hint-spacer ">
                        <?php echo Html::error($model,'expense_name', ['class' => 'mat-form-field-infix']);?>
                    </div>
                </div>
                </div>
            </div>        
        </mat-form-field>


        <mat-form-field class="mat-form-field flex-auto gt-xs:pr-3  mat-primary mat-form-field-type-mat-input mat-form-field-appearance-fill mat-form-field-can-float mat-form-field-has-label mat-form-field-hide-placeholder ng-star-inserted" >
            <div class="mat-form-field-wrapper ">
                <div class="mat-form-field-flex ">
                <div class="mat-form-field-infix ">
                    <?= Html::activeDropDownList($model, 'id_category', $catagories,
                    array('prompt' => '--Select Category--','class'=>'mat-input-element mat-form-field-autofill-control  cdk-text-field-autofill-monitored')
                    ) ?>
                    <span class="mat-form-field-label-wrapper ">
                        <label class="mat-form-field-label  mat-empty mat-form-field-empty ng-star-inserted" ng-reflect-disabled="true" id="mat-form-field-label-5" ng-reflect-ng-switch="true" for="mat-input-2" aria-owns="mat-input-2">
                        <mat-label class=" ng-star-inserted"><?= Html::label('Category', null, []);?></mat-label>
                        </label>
                    </span>
                </div>
                
                </div>
                <div class="mat-form-field-subscript-wrapper " ng-reflect-ng-switch="hint">
                <div class="mat-form-field-hint-wrapper  ng-trigger ng-trigger-transitionMessages ng-star-inserted" style="opacity: 1; transform: translateY(0%);">
                    <div class="mat-form-field-hint-spacer ">
                    <?php echo Html::error($model,'id_category', ['class' => 'mat-form-field-infix']);?>
                    </div>
                </div>
                </div>
            </div>        
        </mat-form-field>



        <mat-form-field class="mat-form-field flex-auto gt-xs:pr-3  mat-primary mat-form-field-type-mat-input mat-form-field-appearance-fill mat-form-field-can-float mat-form-field-has-label mat-form-field-hide-placeholder ng-star-inserted" >
            <div class="mat-form-field-wrapper ">
                <div class="mat-form-field-flex ">
                <div class="mat-form-field-infix ">
                <?php echo Html::activeTextInput($model, 'amount', ['class' => 'mat-form-field-infix']);?>
                    <span class="mat-form-field-label-wrapper ">
                        <label class="mat-form-field-label  mat-empty mat-form-field-empty ng-star-inserted" ng-reflect-disabled="true" id="mat-form-field-label-5" ng-reflect-ng-switch="true" for="mat-input-2" aria-owns="mat-input-2">
                        <mat-label class=" ng-star-inserted"><?= Html::label('Amount', null, []);?></mat-label>
                        </label>
                    </span>
                </div>
                
                </div>
                <div class="mat-form-field-subscript-wrapper " ng-reflect-ng-switch="hint">
                <div class="mat-form-field-hint-wrapper  ng-trigger ng-trigger-transitionMessages ng-star-inserted" style="opacity: 1; transform: translateY(0%);">
                    <div class="mat-form-field-hint-spacer ">
                    <?php echo Html::error($model,'amount', ['class' => 'help-block']);?>
                    </div>
                </div>
                </div>
            </div>        
        </mat-form-field>

    </div>
    <div class="flex">
        <mat-form-field class="mat-form-field fuse-mat-textarea flex-auto  mat-primary mat-form-field-type-mat-input mat-form-field-appearance-fill mat-form-field-can-float mat-form-field-has-label mat-form-field-hide-placeholder ng-star-inserted" >
            <div class="mat-form-field-wrapper ">
                <div class="mat-form-field-flex ">
                <div class="mat-form-field-infix ">
                    
                    <?= $form->field($model, 'date_of_transaction')->widget(\yii\jui\DatePicker::class, [
                        'dateFormat' => 'php:d/m/Y',
                        // 'options' => ['class' => 'form-control'],
                    ])->label(false) ?>
                    
                    <span class="mat-form-field-label-wrapper ">
                    <label class="mat-form-field-label  mat-empty mat-form-field-empty ng-star-inserted" ng-reflect-disabled="true" id="mat-form-field-label-9" ng-reflect-ng-switch="true" for="mat-input-4" aria-owns="mat-input-4">
                        <mat-label class=" ng-star-inserted"><?= Html::label('Date Of Transaction', null, []);?></mat-label>
                    </label>
                    </span>
                </div>
                
                </div>
                <div class="mat-form-field-underline  ng-star-inserted">
                <span class="mat-form-field-ripple "></span>
                </div>
                <div class="mat-form-field-subscript-wrapper " ng-reflect-ng-switch="hint">
                <div class="mat-form-field-hint-wrapper  ng-trigger ng-trigger-transitionMessages ng-star-inserted" style="opacity: 1; transform: translateY(0%);">
                    <div class="mat-form-field-hint-spacer "><?php echo Html::error($model,'date_of_transaction', ['class' => 'help-block']);?></div>
                </div>
                </div>
            </div>
        </mat-form-field>

        
    </div>

    <div class="flex">
        <mat-form-field class="mat-form-field flex-auto gt-xs:pr-3 mat-primary mat-form-field-type-mat-input mat-form-field-appearance-fill mat-form-field-can-float mat-form-field-has-label mat-form-field-hide-placeholder ng-star-inserted" >
        <div class="mat-form-field-wrapper">
            <div class="mat-form-field-flex">
            <div class="mat-form-field-infix">
                <?= $form->field($model, 'imageFile')->fileInput(['accept' => 'image/*']) ?>
                <span class="mat-form-field-label-wrapper">
                    <label class="mat-form-field-label mat-empty mat-form-field-empty ng-star-inserted" ng-reflect-disabled="true" id="mat-form-field-label-5" ng-reflect-ng-switch="true" for="mat-input-2" aria-owns="mat-input-2">
                    <mat-label class=" ng-star-inserted"><?= Html::label('Image', null, []);?></mat-label>
                    </label>
                </span>
            </div>
            </div>
            <div class="mat-form-field-subscript-wrapper" ng-reflect-ng-switch="hint">
            <div class="mat-form-field-hint-wrapper ng-trigger ng-trigger-transitionMessages ng-star-inserted" style="opacity: 1; transform: translateY(0%);">
                <div class="mat-form-field-hint-spacer">
                    <?php echo Html::error($model,'image', ['class' => 'help-block']);?>
                </div>
            </div>
            </div>
            
            <?php if ($model->image): ?>
            <?= Html::a(Html::img('@web/expenses/' . $model->image, ['width' => '100']), ['site/download-image', 'filename' =>  $model->image]) ?>
            <?php endif; ?>

        </div>        
        </mat-form-field>

        
    </div>

    
    <div class="flex">
        


        <mat-form-field class="mat-form-field fuse-mat-textarea flex-auto  mat-primary mat-form-field-type-mat-input mat-form-field-appearance-fill mat-form-field-can-float mat-form-field-has-label mat-form-field-hide-placeholder ng-star-inserted" >
            <div class="mat-form-field-wrapper ">
                <div class="mat-form-field-flex ">
                <div class="mat-form-field-infix ">
                    <?= $form->field($model, 'description')->textarea(['rows' => '3', 'class'=>'mat-input-element mat-form-field-autofill-control cdk-textarea-autosize mat-autosize  cdk-text-field-autofill-monitored'])->label(false) ?>
                    <span class="mat-form-field-label-wrapper ">
                    <label class="mat-form-field-label  mat-empty mat-form-field-empty ng-star-inserted" ng-reflect-disabled="true" id="mat-form-field-label-9" ng-reflect-ng-switch="true" for="mat-input-4" aria-owns="mat-input-4">
                        <mat-label class=" ng-star-inserted"><?= Html::label('Description', null, []);?></mat-label>
                    </label>
                    </span>
                </div>
                
                </div>
                <div class="mat-form-field-underline  ng-star-inserted">
                <span class="mat-form-field-ripple "></span>
                </div>
                <div class="mat-form-field-subscript-wrapper " ng-reflect-ng-switch="hint">
                <div class="mat-form-field-hint-wrapper  ng-trigger ng-trigger-transitionMessages ng-star-inserted" style="opacity: 1; transform: translateY(0%);">
                    <div class="mat-form-field-hint-spacer "><?php echo Html::error($model,'description', ['class' => 'help-block']);?></div>
                </div>
                </div>
            </div>
        </mat-form-field>

    </div>


    

    

   

    <?= Html::a('Cancel', ['/income/index'], ['class'=>'mat-focus-indicator mat-button mat-button-base']) ?>
    <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'mat-focus-indicator px-6 ml-3 mat-flat-button mat-button-base mat-primary']) ?> 
</form>

<?php ActiveForm::end(); ?>