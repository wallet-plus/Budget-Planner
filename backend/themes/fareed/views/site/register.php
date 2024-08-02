<?php
/** @var yii\web\View $this */
/** @var yii\bootstrap4\ActiveForm $form */

/** @var app\models\LoginForm $model */
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;
use yii\helpers\Url;

$this->title = 'Register ';
$this->params['breadcrumbs'][] = $this->title;
?>

<link rel="stylesheet" href="<?php echo Yii::$app->view->theme->baseUrl; ?>/fareed/vendor/css/pages/page-auth.css" />


<div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
            <!-- Register Card -->
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
                    <!-- /Logo -->
                    <h4 class="mb-2">Adventure starts here 🚀</h4>
                    <p class="mb-4">Make your app management easy and fun!</p>


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

                    <?php
                    $form = ActiveForm::begin([
                        'id' => 'register-form',
                        'layout' => 'horizontal',
                        'options' => ['autocomplete' => 'off', 'class' => 'mb-3',]
                    ]);
                    ?>


                    <div class="mb-3">
                        <label for="username" class="form-label"><?php echo Html::activeLabel($model, 'firstname') ?>
                        </label>
                        <?php echo Html::activeTextInput($model, 'firstname', ['class' => 'form-control', 'placeholder' => $model->getAttributeLabel('firstname')]); ?>
                        <?php echo Html::error($model, 'firstname'); ?>
                    </div>

                    <div class="mb-3">
                        <label for="username"
                            class="form-label"><?php echo Html::activeLabel($model, 'username') ?></label>
                        <?php echo Html::activeTextInput($model, 'username', ['class' => 'form-control', 'placeholder' => $model->getAttributeLabel('username')]); ?>
                        <?php echo Html::error($model, 'username'); ?>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label"><?php echo Html::activeLabel($model, 'email') ?></label>
                        <?php echo Html::activeTextInput($model, 'email', ['class' => 'form-control', 'placeholder' => $model->getAttributeLabel('email')]); ?>
                        <?php echo Html::error($model, 'email'); ?>
                    </div>
                    <div class="mb-3 form-password-toggle">
                        <label class="form-label"
                            for="password"><?php echo Html::activeLabel($model, 'password') ?></label>
                        <div class="input-group input-group-merge">
                            <?php echo Html::activePasswordInput($model, 'password', ['autoComplete' => 'nope', 'class' => 'form-control', 'placeholder' => $model->getAttributeLabel('password')]); ?>
                            <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                            <?php echo Html::error($model, 'password'); ?>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="terms-conditions" name="terms" />
                            <label class="form-check-label" for="terms-conditions">
                                I agree to
                                <?= Html::a("privacy policy & terms", ['/site/personal-finanace']) ?>
                            </label>
                        </div>
                    </div>
                    <?= Html::submitButton('Sign up', ['name' => 'register-button', 'id' => 'create-btn', 'class' => "btn btn-primary d-grid w-100"]) ?>
                    <?php ActiveForm::end(); ?>

                    <p class="text-center">
                        <span>Already have an account?</span>
                        <?= Html::a(" <span>Sign in instead</span>", ['/site/login']) ?>
                    </p>
                </div>
            </div>
            <!-- Register Card -->
        </div>
    </div>
</div>