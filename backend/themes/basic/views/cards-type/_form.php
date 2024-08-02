<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use app\models\Category

/* @var $this yii\web\View */
/* @var $model app\models\Expense */
/* @var $form yii\widgets\ActiveForm */
?>
<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

<style>
    .field-expense-description{ width : 100%; }
</style>
<form novalidate="" class="flex flex-col mt-8 p-8 pb-4 bg-card rounded-2xl shadow overflow-hidden ng-untouched ng-pristine ng-valid">
    <div class="flex flex-col gt-xs:flex-row">
        
        
    <mat-form-field class="mat-form-field flex-auto gt-xs:pr-3 mat-primary mat-form-field-type-mat-input mat-form-field-appearance-fill mat-form-field-can-float mat-form-field-has-label mat-form-field-hide-placeholder ng-star-inserted" ng-reflect-ng-class="">
            <div class="mat-form-field-wrapper">
                <div class="mat-form-field-flex">
                <div class="mat-form-field-infix">
                    <?php echo Html::activeTextInput($model, 'name', ['class' => 'mat-form-field-infix']);?>
                    <span class="mat-form-field-label-wrapper">
                        <label class="mat-form-field-label mat-empty mat-form-field-empty ng-star-inserted" ng-reflect-disabled="true" id="mat-form-field-label-5" ng-reflect-ng-switch="true" for="mat-input-2" aria-owns="mat-input-2">
                        <mat-label class=" ng-star-inserted"><?= Html::label('Category Name', null, []);?></mat-label>
                        </label>
                    </span>
                </div>
                </div>
                <div class="mat-form-field-subscript-wrapper" ng-reflect-ng-switch="hint">
                <div class="mat-form-field-hint-wrapper ng-trigger ng-trigger-transitionMessages ng-star-inserted" style="opacity: 1; transform: translateY(0%);">
                    <div class="mat-form-field-hint-spacer">
                        <?php echo Html::error($model,'name', ['class' => 'help-block']);?>
                    </div>
                </div>
                </div>
            </div>        
        </mat-form-field>
    </div>
    <?= Html::a('Cancel', ['/cards-type/index'], ['class'=>'mat-focus-indicator mat-button mat-button-base']) ?>
    <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'mat-focus-indicator px-6 ml-3 mat-flat-button mat-button-base mat-primary']) ?> 
</form>

<?php ActiveForm::end(); ?>