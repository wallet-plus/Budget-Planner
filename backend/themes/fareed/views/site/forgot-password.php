<?php
/** @var yii\web\View $this */
/** @var yii\bootstrap4\ActiveForm $form */

/** @var app\models\LoginForm $model */
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;
use yii\helpers\Url;

$this->title = 'Forgot Password ';
$this->params['breadcrumbs'][] = $this->title;
?>

<link rel="stylesheet" href="<?php echo Yii::$app->view->theme->baseUrl; ?>/fareed/vendor/css/pages/page-auth.css" />
    
<div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
    <div class="authentication-inner py-4">
        <!-- Forgot Password -->
        <div class="card">
        <div class="card-body">
            <!-- Logo -->
            <div class="app-brand justify-content-center">
            <a  class="app-brand-link gap-2">
                <span class="app-brand-logo demo">
                <?= Html::img('@web/images/walletplus-icon.png', [
                  'alt' => 'Image',
                  'class' => 'w-px-40 h-auto',
                  'width' => '25'
                ]) ?>
                </span>
                <span class="app-brand-text demo text-body fw-bold">WalletPlus</span>
            </a>
            </div>

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

            <!-- /Logo -->
            <h4 class="mb-2">Forgot Password? 🔒</h4>
            <p class="mb-4">Enter your email and we'll send you instructions to reset your password</p>
            <?php
            $form = ActiveForm::begin([
                        'id' => 'forgot-form',
                        'layout' => 'horizontal',
                        'options' => ['autocomplete' => 'off', 'class' => 'mb-3'],
                        'fieldConfig' => [
                        // 'template' => "{label}\n{input}\n{error}",
                        // 'labelOptions' => ['class' => 'col-lg-1 col-form-label mr-lg-3'],
                        // 'inputOptions' => ['class' => 'col-lg-3 form-control'],
                        // 'errorOptions' => ['class' => 'col-lg-7 invalid-feedback'],
                        ],
            ]);
            ?>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>

                <?php echo Html::activeTextInput($model, 'email', [
                    'class' => 'form-control',
                    'id' => 'email',
                    'name' => 'email',
                    'placeholder' => 'Enter your email',
                    'autofocus' => true,
                    'autocomplete' => 'nope'
                ]); ?>
                <?php echo Html::error($model, 'email'); ?>
            </div>
            <?= Html::submitButton('Send Reset Link', ['name' => 'login-button', 'id' => 'create-btn', 'class' => "btn btn-primary d-grid w-100"]) ?>

            <?php ActiveForm::end(); ?>
            <div class="text-center">

            <?= Html::a('<i class="bx bx-chevron-left scaleX-n1-rtl bx-sm"></i>Back to login', ['/site/login'], ['class' => 'd-flex align-items-center justify-content-center']) ?>
            </div>
        </div>
        </div>
        <!-- /Forgot Password -->
    </div>
    </div>
</div>

