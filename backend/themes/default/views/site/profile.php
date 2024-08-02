<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Category;

// $this->title = Yii::t('app', 'Update Customer: {name}', [
//     'name' => $model->id,
// ]);
$this->title = Yii::t('app', 'Update Profile');

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Customers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>

<div class="flex flex-col flex-auto min-w-0">
  <div class="flex flex-col sm:flex-row flex-0 sm:items-center sm:justify-between p-6 sm:py-8 sm:px-10 border-b bg-card dark:bg-transparent">
    <div class="flex-1 min-w-0">
      <div class="flex flex-wrap items-center font-medium">
        <div>
        <?= Html::a('Home', ['/site/dashboard'], ['class'=>'mat-focus-indicator mat-button mat-button-base']) ?>
        </div>
        <div class="flex items-center ml-1 whitespace-nowrap">
          <mat-icon role="img" class="mat-icon notranslate icon-size-5 text-secondary mat-icon-no-color" aria-hidden="true" ng-reflect-svg-icon="heroicons_solid:chevron-right" data-mat-icon-type="svg" data-mat-icon-name="chevron-right" data-mat-icon-namespace="heroicons_solid">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" fit="" height="100%" width="100%" preserveAspectRatio="xMidYMid meet" focusable="false">
              <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
            </svg>
          </mat-icon>
          <a class="ml-1 text-primary-500"><?= Html::encode($this->title) ?></a>
        </div>
      </div>
      <div class="mt-2">
        <h2 class="text-3xl md:text-4xl font-extrabold tracking-tight leading-7 sm:leading-10 truncate"> <?= Html::encode($this->title) ?> </h2>
      </div>
    </div>
  </div>
  
  <div class="flex-auto p-6 sm:p-10">
    <div class="max-w-3xl">
      <div class="prose prose-sm max-w-3xl">

      <?php if (Yii::$app->session->hasFlash('success')): ?>
            <div class="alert alert-success alert-dismissable">
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                <h4><i class="icon fa fa-check"></i>Saved!</h4>
                <?= Yii::$app->session->getFlash('success') ?>
            </div>
        <?php endif; ?>

        <?php if (Yii::$app->session->hasFlash('error')): ?>
            <div class="alert alert-danger alert-dismissable">
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                <h4><i class="icon fa fa-check"></i>Saved!</h4>
                <?= Yii::$app->session->getFlash('error') ?>
            </div>
        <?php endif; ?>

        <!-- <p> By default, Fuse changes the default form field appearance to <em>fill</em> and heavily modifies it to provide a more unique and consistent look. We <strong>DO NOT</strong> recommend using any other form field styles as they are not optimized for Fuse. </p> -->
        <!-- <h2>Appearance</h2> -->
        <!-- <p> Here's a very simple form layout to showcase the form fields. </p> -->
      </div>

      



<?php $form = ActiveForm::begin(); ?>

<style>
    .field-expense-description{ width : 100%; }
</style>
<form novalidate="" class="flex flex-col mt-8 p-8 pb-4 bg-card rounded-2xl shadow overflow-hidden ng-untouched ng-pristine ng-valid">
    <div class="flex flex-col gt-xs:flex-row">
        

        <mat-form-field class="mat-form-field flex-auto gt-xs:pr-3 mat-primary mat-form-field-type-mat-input mat-form-field-appearance-fill mat-form-field-can-float mat-form-field-has-label mat-form-field-hide-placeholder ng-star-inserted" >
            <div class="mat-form-field-wrapper">
                <div class="mat-form-field-flex">
                <div class="mat-form-field-infix">
                    <?php echo Html::activeTextInput($model, 'firstname' , ['class' => 'mat-form-field-infix']);?>
                    <span class="mat-form-field-label-wrapper">
                        <label class="mat-form-field-label mat-empty mat-form-field-empty ng-star-inserted" ng-reflect-disabled="true" id="mat-form-field-label-5" ng-reflect-ng-switch="true" for="mat-input-2" aria-owns="mat-input-2">
                        <mat-label class=" ng-star-inserted">
                            <?php echo Html::activeLabel($model, 'firstname' )?></mat-label>
                        </label>
                    </span>
                </div>
                </div>
                <div class="mat-form-field-subscript-wrapper" ng-reflect-ng-switch="hint">
                <div class="mat-form-field-hint-wrapper ng-trigger ng-trigger-transitionMessages ng-star-inserted" style="opacity: 1; transform: translateY(0%);">
                    <div class="mat-form-field-hint-spacer">
                        <?php echo Html::error($model,'firstname', ['class' => 'help-block']);?>
                    </div>
                </div>
                </div>
            </div>        
        </mat-form-field>




        <mat-form-field class="mat-form-field flex-auto gt-xs:pr-3 mat-primary mat-form-field-type-mat-input mat-form-field-appearance-fill mat-form-field-can-float mat-form-field-has-label mat-form-field-hide-placeholder ng-star-inserted" >
            <div class="mat-form-field-wrapper">
                <div class="mat-form-field-flex">
                <div class="mat-form-field-infix">
                    <?php echo Html::activeTextInput($model, 'lastname' , ['class' => 'mat-form-field-infix']);?>
                    <span class="mat-form-field-label-wrapper">
                        <label class="mat-form-field-label mat-empty mat-form-field-empty ng-star-inserted" ng-reflect-disabled="true" id="mat-form-field-label-5" ng-reflect-ng-switch="true" for="mat-input-2" aria-owns="mat-input-2">
                        <mat-label class=" ng-star-inserted"><?php echo Html::activeLabel($model, 'lastname' )?></mat-label>
                        </label>
                    </span>
                </div>
                </div>
                <div class="mat-form-field-subscript-wrapper" ng-reflect-ng-switch="hint">
                <div class="mat-form-field-hint-wrapper ng-trigger ng-trigger-transitionMessages ng-star-inserted" style="opacity: 1; transform: translateY(0%);">
                    <div class="mat-form-field-hint-spacer">
                        <?php echo Html::error($model,'lastname', ['class' => 'help-block']);?>
                    </div>
                </div>
                </div>
            </div>        
        </mat-form-field>




        <mat-form-field class="mat-form-field flex-auto gt-xs:pr-3 mat-primary mat-form-field-type-mat-input mat-form-field-appearance-fill mat-form-field-can-float mat-form-field-has-label mat-form-field-hide-placeholder ng-star-inserted" >
            <div class="mat-form-field-wrapper">
                <div class="mat-form-field-flex">
                <div class="mat-form-field-infix">
                    <?php echo Html::activeTextInput($model, 'username' , ['readOnly' => true, 'class' => 'mat-form-field-infix']);?>
                    <span class="mat-form-field-label-wrapper">
                        <label class="mat-form-field-label mat-empty mat-form-field-empty ng-star-inserted" ng-reflect-disabled="true" id="mat-form-field-label-5" ng-reflect-ng-switch="true" for="mat-input-2" aria-owns="mat-input-2">
                        <mat-label class=" ng-star-inserted"><?php echo Html::activeLabel($model, 'username' )?></mat-label>
                        </label>
                    </span>
                </div>
                </div>
                <div class="mat-form-field-subscript-wrapper" ng-reflect-ng-switch="hint">
                <div class="mat-form-field-hint-wrapper ng-trigger ng-trigger-transitionMessages ng-star-inserted" style="opacity: 1; transform: translateY(0%);">
                    <div class="mat-form-field-hint-spacer">
                        <?php echo Html::error($model,'username', ['class' => 'help-block']);?>
                    </div>
                </div>
                </div>
            </div>        
        </mat-form-field>


        <mat-form-field class="mat-form-field flex-auto gt-xs:pr-3 mat-primary mat-form-field-type-mat-input mat-form-field-appearance-fill mat-form-field-can-float mat-form-field-has-label mat-form-field-hide-placeholder ng-star-inserted" >
            <div class="mat-form-field-wrapper">
                <div class="mat-form-field-flex">
                <div class="mat-form-field-infix">
                    <?php echo Html::activeTextInput($model, 'email' , ['readOnly' => true, 'class' => 'mat-form-field-infix']);?>
                    <span class="mat-form-field-label-wrapper">
                        <label class="mat-form-field-label mat-empty mat-form-field-empty ng-star-inserted" ng-reflect-disabled="true" id="mat-form-field-label-5" ng-reflect-ng-switch="true" for="mat-input-2" aria-owns="mat-input-2">
                        <mat-label class=" ng-star-inserted"><?php echo Html::activeLabel($model, 'email' )?></mat-label>
                        </label>
                    </span>
                </div>
                </div>
                <div class="mat-form-field-subscript-wrapper" ng-reflect-ng-switch="hint">
                <div class="mat-form-field-hint-wrapper ng-trigger ng-trigger-transitionMessages ng-star-inserted" style="opacity: 1; transform: translateY(0%);">
                    <div class="mat-form-field-hint-spacer">
                        <?php echo Html::error($model,'email', ['class' => 'help-block']);?>
                    </div>
                </div>
                </div>
            </div>        
        </mat-form-field>


        <mat-form-field class="mat-form-field flex-auto gt-xs:pr-3 mat-primary mat-form-field-type-mat-input mat-form-field-appearance-fill mat-form-field-can-float mat-form-field-has-label mat-form-field-hide-placeholder ng-star-inserted" >
            <div class="mat-form-field-wrapper">
                <div class="mat-form-field-flex">
                <div class="mat-form-field-infix">
                    <?= $form->field($model, 'imageFile')->fileInput() ?>
                    <span class="mat-form-field-label-wrapper">
                        <label class="mat-form-field-label mat-empty mat-form-field-empty ng-star-inserted" ng-reflect-disabled="true" id="mat-form-field-label-5" ng-reflect-ng-switch="true" for="mat-input-2" aria-owns="mat-input-2">
                        <mat-label class=" ng-star-inserted"><?php echo Html::activeLabel($model, 'image' )?></mat-label>
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
                    <?= Html::img('@web/users/' . $model->image, ['alt' => 'Image', 'width'=>"100px !impotant", 'height'=>"100px"]) ?>
                <?php endif; ?>

            </div>        
        </mat-form-field>


        <!-- <mat-form-field class="mat-form-field flex-auto gt-xs:pr-3 mat-primary mat-form-field-type-mat-input mat-form-field-appearance-fill mat-form-field-can-float mat-form-field-has-label mat-form-field-hide-placeholder ng-star-inserted" >
            <div class="mat-form-field-wrapper">
                <div class="mat-form-field-flex">
                <div class="mat-form-field-infix">
                    <?php echo Html::activeTextInput($model, 'password' , ['class' => 'mat-form-field-infix']);?>
                    <span class="mat-form-field-label-wrapper">
                        <label class="mat-form-field-label mat-empty mat-form-field-empty ng-star-inserted" ng-reflect-disabled="true" id="mat-form-field-label-5" ng-reflect-ng-switch="true" for="mat-input-2" aria-owns="mat-input-2">
                        <mat-label class=" ng-star-inserted"><?php echo Html::activeLabel($model, 'password' )?></mat-label>
                        </label>
                    </span>
                </div>
                </div>
                <div class="mat-form-field-subscript-wrapper" ng-reflect-ng-switch="hint">
                <div class="mat-form-field-hint-wrapper ng-trigger ng-trigger-transitionMessages ng-star-inserted" style="opacity: 1; transform: translateY(0%);">
                    <div class="mat-form-field-hint-spacer">
                        <?php echo Html::error($model,'password', ['class' => 'help-block']);?>
                    </div>
                </div>
                </div>
            </div>        
        </mat-form-field> -->



        <!-- <mat-form-field class="mat-form-field flex-auto gt-xs:pr-3 mat-primary mat-form-field-type-mat-input mat-form-field-appearance-fill mat-form-field-can-float mat-form-field-has-label mat-form-field-hide-placeholder ng-star-inserted" >
            <div class="mat-form-field-wrapper">
                <div class="mat-form-field-flex">
                <div class="mat-form-field-infix">
                    <?php echo Html::activeTextInput($model, 'otp' , ['class' => 'mat-form-field-infix']);?>
                    <span class="mat-form-field-label-wrapper">
                        <label class="mat-form-field-label mat-empty mat-form-field-empty ng-star-inserted" ng-reflect-disabled="true" id="mat-form-field-label-5" ng-reflect-ng-switch="true" for="mat-input-2" aria-owns="mat-input-2">
                        <mat-label class=" ng-star-inserted"><?php echo Html::activeLabel($model, 'otp' )?></mat-label>
                        </label>
                    </span>
                </div>
                </div>
                <div class="mat-form-field-subscript-wrapper" ng-reflect-ng-switch="hint">
                <div class="mat-form-field-hint-wrapper ng-trigger ng-trigger-transitionMessages ng-star-inserted" style="opacity: 1; transform: translateY(0%);">
                    <div class="mat-form-field-hint-spacer">
                        <?php echo Html::error($model,'otp', ['class' => 'help-block']);?>
                    </div>
                </div>
                </div>
            </div>        
        </mat-form-field> -->



        <!-- <mat-form-field class="mat-form-field flex-auto gt-xs:pr-3 mat-primary mat-form-field-type-mat-input mat-form-field-appearance-fill mat-form-field-can-float mat-form-field-has-label mat-form-field-hide-placeholder ng-star-inserted" >
            <div class="mat-form-field-wrapper">
                <div class="mat-form-field-flex">
                <div class="mat-form-field-infix">
                    <?php echo Html::activeTextInput($model, 'email_verification_code' , ['class' => 'mat-form-field-infix']);?>
                    <span class="mat-form-field-label-wrapper">
                        <label class="mat-form-field-label mat-empty mat-form-field-empty ng-star-inserted" ng-reflect-disabled="true" id="mat-form-field-label-5" ng-reflect-ng-switch="true" for="mat-input-2" aria-owns="mat-input-2">
                        <mat-label class=" ng-star-inserted"><?php echo Html::activeLabel($model, 'email_verification_code' )?></mat-label>
                        </label>
                    </span>
                </div>
                </div>
                <div class="mat-form-field-subscript-wrapper" ng-reflect-ng-switch="hint">
                <div class="mat-form-field-hint-wrapper ng-trigger ng-trigger-transitionMessages ng-star-inserted" style="opacity: 1; transform: translateY(0%);">
                    <div class="mat-form-field-hint-spacer">
                        <?php echo Html::error($model,'email_verification_code', ['class' => 'help-block']);?>
                    </div>
                </div>
                </div>
            </div>        
        </mat-form-field> -->


        <!-- <mat-form-field class="mat-form-field flex-auto gt-xs:pr-3 mat-primary mat-form-field-type-mat-input mat-form-field-appearance-fill mat-form-field-can-float mat-form-field-has-label mat-form-field-hide-placeholder ng-star-inserted" >
            <div class="mat-form-field-wrapper">
                <div class="mat-form-field-flex">
                <div class="mat-form-field-infix">
                    <?php echo Html::activeTextInput($model, 'mobile_verification_code' , ['class' => 'mat-form-field-infix']);?>
                    <span class="mat-form-field-label-wrapper">
                        <label class="mat-form-field-label mat-empty mat-form-field-empty ng-star-inserted" ng-reflect-disabled="true" id="mat-form-field-label-5" ng-reflect-ng-switch="true" for="mat-input-2" aria-owns="mat-input-2">
                        <mat-label class=" ng-star-inserted"><?php echo Html::activeLabel($model, 'mobile_verification_code' )?></mat-label>
                        </label>
                    </span>
                </div>
                </div>
                <div class="mat-form-field-subscript-wrapper" ng-reflect-ng-switch="hint">
                <div class="mat-form-field-hint-wrapper ng-trigger ng-trigger-transitionMessages ng-star-inserted" style="opacity: 1; transform: translateY(0%);">
                    <div class="mat-form-field-hint-spacer">
                        <?php echo Html::error($model,'mobile_verification_code', ['class' => 'help-block']);?>
                    </div>
                </div>
                </div>
            </div>        
        </mat-form-field> -->

    </div>
    
    <?= Html::a('Cancel', ['/site/dashboard'], ['class'=>'mat-focus-indicator mat-button mat-button-base']) ?>
    <?= Html::submitButton(Yii::t('app', 'Update Profile'), ['class' => 'mat-focus-indicator px-6 ml-3 mat-flat-button mat-button-base mat-primary']) ?> 
</form>

<?php ActiveForm::end(); ?>


    </div>
  </div>
</div>