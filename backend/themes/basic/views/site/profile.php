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


<div class="container-scroller">
  <!-- partial:../../partials/_navbar.html -->
  <div class="content-wrapper">
    <div class="row">
      <div class="col-12 grid-margin">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title"><?= Html::encode($this->title) ?></h4>

            
                <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
                <form class="form-sample">
                    <?php
                    echo $form->field($model, 'id_type')->hiddenInput(['value' => 3])->label(false);
                    ?>
                    <p class="card-description">
                        Profile
                    </p>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label"><?php echo Html::activeLabel($model, 'firstname' )?></mat-label> </label>
                                <div class="col-sm-9">
                                    <?php echo Html::activeTextInput($model, 'firstname', ['class' => 'form-control']); ?>
                                    <?php echo Html::error($model, 'firstname', ['class' => 'mat-form-field-infix']); ?>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label"><?php echo Html::activeLabel($model, 'lastname' )?></mat-label> </label>
                                <div class="col-sm-9">
                                    <?php echo Html::activeTextInput($model, 'lastname', ['class' => 'form-control']); ?>
                                    <?php echo Html::error($model, 'lastname', ['class' => 'mat-form-field-infix']); ?>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label"><?php echo Html::activeLabel($model, 'username' )?></mat-label> </label>
                                <div class="col-sm-9">
                                    <?php echo Html::activeTextInput($model, 'username', ['class' => 'form-control']); ?>
                                    <?php echo Html::error($model, 'username', ['class' => 'mat-form-field-infix']); ?>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label"><?php echo Html::activeLabel($model, 'email' )?></mat-label> </label>
                                <div class="col-sm-9">
                                    <?php echo Html::activeTextInput($model, 'email', ['class' => 'form-control']); ?>
                                    <?php echo Html::error($model, 'email', ['class' => 'mat-form-field-infix']); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label"><?php echo Html::activeLabel($model, 'image' )?></mat-label> </label>
                                <div class="col-sm-9">
                                    <?= $form->field($model, 'imageFile')->fileInput() ?>
                                    <?php echo Html::error($model, 'image', ['class' => 'mat-form-field-infix']); ?>
                                </div>
                                <?php if ($model->image): ?>
                                    <?= Html::img('@web/users/' . $model->image, ['alt' => 'Image', 'width'=>"100px !impotant", 'height'=>"100px"]) ?>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="col-md-6">
                            
                        </div>
                    </div>

                
                    <?= Html::a('Cancel', ['/site/dashboard'], ['class'=>'btn btn-light']) ?>
                    <?= Html::submitButton(Yii::t('app', 'Update Profile'), ['class' => 'btn btn-primary mr-2']) ?> 

                </form>


                <?php ActiveForm::end(); ?>
            
          </div>
        </div>
      </div>


    </div>
    <!-- main-panel ends -->
  </div>
  <!-- page-body-wrapper ends -->
</div>

