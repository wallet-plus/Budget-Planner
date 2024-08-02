<?php
/** @var yii\web\View $this */
/** @var yii\bootstrap4\ActiveForm $form */

/** @var app\models\LoginForm $model */
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;
use yii\helpers\Url;

$this->title = 'Reset Password ';
$this->params['breadcrumbs'][] = $this->title;
?>
<link rel="stylesheet" href="<?php echo Url::base()?>/css/auth-styles.css">

<section class="w3l-download-main registration-section ">
    <div class="download-content text-center py-5">
        <div class="container py-lg-4">
            <h3 class="title-big">Reset Password </h3>
            <!--<h6>Manage your Income & Expenses</h6>-->
        </div>

        <?php
        $form = ActiveForm::begin([
                    'id' => 'reset-form',
                    'layout' => 'horizontal',
                    'options' => ['autocomplete' => 'off'],
                    'fieldConfig' => [
                    // 'template' => "{label}\n{input}\n{error}",
                    // 'labelOptions' => ['class' => 'col-lg-1 col-form-label mr-lg-3'],
                    // 'inputOptions' => ['class' => 'col-lg-3 form-control'],
                    // 'errorOptions' => ['class' => 'col-lg-7 invalid-feedback'],
                    ],
        ]);
        ?>

        <div>
            <?php if (Yii::$app->session->hasFlash('success')): ?>
                <div class="alert alert-success alert-dismissable">
                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                    <!-- <h4><i class="icon fa fa-check"></i>Saved!</h4> -->
                    <i class="icon fa fa-check"></i> <?= Yii::$app->session->getFlash('success') ?>
                </div>
            <?php endif; ?>

            <?php if (Yii::$app->session->hasFlash('error')): ?>
                <div class="alert alert-danger alert-dismissable">
                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                    <!-- <h4><i class="icon fa fa-check"></i>Saved!</h4> -->
                    <i class="icon fa fa-check"></i> <?= Yii::$app->session->getFlash('error') ?>
                </div>
            <?php endif; ?>
        </div>

        <div class="onset">
            <div class="form-label">
                <label for="mId" id="mail-id"><?php echo Html::activeLabel($model, 'password' )?> *</label>
            </div>
            <div class="form-input">
                <?php echo Html::activeTextInput($model, 'password', ['autoComplete' =>'nope']); ?>
                <?php echo Html::error($model, 'password'); ?>
            </div>
        </div>

        <div class="onset">
            <div class="form-label">
                <label for="mId" id="mail-id"><?php echo Html::activeLabel($model, 'confirmpassword' )?> *</label>
            </div>
            <div class="form-input">
                <?php echo Html::activeTextInput($model, 'confirmpassword', ['autoComplete' =>'nope']); ?>
                <?php echo Html::error($model, 'confirmpassword'); ?>
            </div>
        </div>

        
        <div class="onset">
            <div class="form">
                <?= Html::submitButton('Sign in', ['name' => 'login-button', 'id' => 'create-btn', 'class' => "btn btn-style btn-primary"]) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>

</section>

