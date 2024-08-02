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



  
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light"><?= Html::a('Home', ['/site/dashboard']) ?> /</span>
    <?= Html::encode($this->title) ?></h4>
    <div class="row">
    <div class="col-md-12">
        <!-- <ul class="nav nav-pills flex-column flex-md-row mb-3">
        <li class="nav-item">
            <a class="nav-link active" href="javascript:void(0);"><i class="bx bx-user me-1"></i> Account</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="pages-account-settings-notifications.html"
            ><i class="bx bx-bell me-1"></i> Notifications</a
            >
        </li>
        <li class="nav-item">
            <a class="nav-link" href="pages-account-settings-connections.html"
            ><i class="bx bx-link-alt me-1"></i> Connections</a
            >
        </li>
        </ul> -->
        
        <div class="card mb-4">
        <h5 class="card-header">Profile Details</h5>
        <!-- Account -->
        <?php $form = ActiveForm::begin(); ?>

            <?php if (Yii::$app->session->hasFlash('success') || Yii::$app->session->hasFlash('error') ) { ?> 
                <div class="card-body">
                <?php if (Yii::$app->session->hasFlash('success')): ?>
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <?= Yii::$app->session->getFlash('success') ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <?php if (Yii::$app->session->hasFlash('error')): ?>
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <?= Yii::$app->session->getFlash('error') ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>
                </div>
                
            <?php } ?>
            
            
            
            <div class="card-body">
                <div class="d-flex align-items-start align-items-sm-center gap-4">
                <?= Html::img('@web/users/' . $model->image, ['class'=>'d-block rounded', 'alt' => 'Profile Picture', 'width'=>"100px !impotant", 'height'=>"100px"]) ?>
                
                <div class="button-wrapper">
                    <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                    <!-- <span class="d-none d-sm-block">Upload new photo</span> -->
                    <i class="bx bx-upload d-block d-sm-none"></i>
                    
                    <?= $form->field($model, 'imageFile')->fileInput([
                        'id' => 'upload',
                        'class' => 'account-file-input',
                        'hidden' => true,
                        'accept' => 'image/png, image/jpeg'
                    ]) ?>
                    </label>
                    <!-- <button type="button" class="btn btn-outline-secondary account-image-reset mb-4">
                    <i class="bx bx-reset d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Reset</span>
                    </button> -->

                    <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
                </div>
                </div>
            </div>
            <hr class="my-0" />
            <div class="card-body">
                <div class="row">
                    
                    <div class="mb-3 col-md-6">
                        <label for="firstName" class="form-label"><?php echo Html::activeLabel($model, 'firstname' )?></label>
                        <?php echo Html::activeTextInput($model, 'firstname' , ['class' => 'form-control']);?>
                        <?php echo Html::error($model,'firstname');?>
                    </div>

                    <div class="mb-3 col-md-6">
                        <label for="lastname" class="form-label"><?php echo Html::activeLabel($model, 'lastname' )?></label>
                        <?php echo Html::activeTextInput($model, 'lastname' , [ 'class' => 'form-control']);?>
                        <?php echo Html::error($model,'lastname');?>
                    </div>

                    <div class="mb-3 col-md-6">
                        <label for="username" class="form-label"><?php echo Html::activeLabel($model, 'username' )?></label>
                        <?php echo Html::activeTextInput($model, 'username' , ['readOnly' => true, 'class' => 'form-control']);?>
                        <?php echo Html::error($model,'username');?>
                    </div>

                    <div class="mb-3 col-md-6">
                        <label for="firstName" class="form-label"><?php echo Html::activeLabel($model, 'email' )?></label>
                        <?php echo Html::activeTextInput($model, 'email' , ['readOnly' => true, 'class' => 'form-control']);?>
                        <?php echo Html::error($model,'email');?>
                    </div>

                    <div class="mb-3 col-md-6">
                        <label for="firstName" class="form-label"><?php echo Html::activeLabel($model, 'email' )?></label>
                        <?php echo Html::activeTextInput($model, 'email' , ['readOnly' => true, 'class' => 'form-control']);?>
                        <?php echo Html::error($model,'email');?>
                    </div>

                    <div class="mb-3 col-md-6">
                        <label for="firstName" class="form-label"><?php echo Html::activeLabel($model, 'gender' )?></label>
                        <?= Html::activeDropDownList($model, 'gender',
                        array('1' => 'Male', '0' => 'Female'),
                        array('class' => 'form-control')        
                        ) ?>
                        <?php echo Html::error($model,'gender');?>
                    </div>

                </div>
                <div class="mt-2">

                <?= Html::a('Cancel', ['/site/dashboard'], ['class'=>'btn btn-outline-secondary']) ?>
                <?= Html::submitButton(Yii::t('app', 'Update Profile'), ['class' => 'btn btn-primary me-2']) ?> 

                </div>
            </div>
            <!-- /Account -->
            </div>
            <!-- <div class="card">
            <h5 class="card-header">Delete Account</h5>
            <div class="card-body">
                <div class="mb-3 col-12 mb-0">
                <div class="alert alert-warning">
                    <h6 class="alert-heading mb-1">Are you sure you want to delete your account?</h6>
                    <p class="mb-0">Once you delete your account, there is no going back. Please be certain.</p>
                </div>
                </div>
                <form id="formAccountDeactivation" onsubmit="return false">
                <div class="form-check mb-3">
                    <input
                    class="form-check-input"
                    type="checkbox"
                    name="accountActivation"
                    id="accountActivation" />
                    <label class="form-check-label" for="accountActivation"
                    >I confirm my account deactivation</label
                    >
                </div>
                <button type="submit" class="btn btn-danger deactivate-account">Deactivate Account</button>
                </form>
            </div> -->
        <?php ActiveForm::end(); ?>
        </div>
    </div>
    </div>
</div>
<!-- / Content -->
