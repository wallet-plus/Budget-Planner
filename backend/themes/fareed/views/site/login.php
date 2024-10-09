<?php
/** @var yii\web\View $this */
/** @var yii\bootstrap4\ActiveForm $form */

/** @var app\models\LoginForm $model */
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;
use yii\helpers\Url;

$this->title = 'Login ';
$this->params['breadcrumbs'][] = $this->title;
?>
<link rel="stylesheet" href="<?php echo Yii::$app->view->theme->baseUrl; ?>/fareed/vendor/css/pages/page-auth.css" />


<div class="container-xxl">
  <div class="authentication-wrapper authentication-basic container-p-y">
    <div class="authentication-inner">
      <!-- Register -->
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
          <h4 class="mb-2">Welcome to WalletPlus! 👋</h4>
          <p class="mb-4">Please sign-in to your account and start the adventure</p>




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
            'id' => 'formAuthentication',
            'layout' => 'horizontal',
            'options' => ['autocomplete' => 'off', 'class' => 'mb-3',],

          ]);
          ?>


          <div class="mb-3">
            <label for="email" class="form-label"><?php echo Html::activeLabel($model, 'username') ?></label>
            <?php echo Html::activeTextInput($model, 'username', ['autoComplete' => 'nope', 'class' => 'form-control', 'placeholder' => $model->getAttributeLabel('username')]); ?>
            <?php echo Html::error($model, 'username'); ?>
          </div>
          <div class="mb-3 form-password-toggle">
            <div class="d-flex justify-content-between">
              <label class="form-label" for="password"><?php echo Html::activeLabel($model, 'password') ?></label>
              <?= Html::a("<small>Forgot Password?</small>", ['/site/forgot-password'], ['class' => 'auth-link text-black']) ?>

            </div>
            <div class="input-group input-group-merge">
              <?php echo Html::activePasswordInput($model, 'password', ['autoComplete' => 'nope', 'class' => 'form-control', 'placeholder' => $model->getAttributeLabel('password')]); ?>

              <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
              <?php echo Html::error($model, 'password'); ?>
            </div>
          </div>
          <div class="mb-3">
            <div class="form-check">
              <!-- <?= $form->field($model, 'rememberMe')->checkbox([
                'class' => 'form-check-input'
              ])->label(false) ?> -->
              <input class="form-check-input" type="checkbox" id="remember-me" />
              <label class="form-check-label" for="remember-me"> Remember Me </label>
            </div>
          </div>
          <div class="mb-3">
            <?= Html::submitButton('Sign in', ['name' => 'login-button', 'id' => 'create-btn', 'class' => "btn btn-primary d-grid w-100"]) ?>
          </div>
          <?php ActiveForm::end(); ?>

          <p class="text-center">
            <span>New on our platform?</span>
            <?= Html::a("Create an account ", ['/site/register']) ?>
          </p>
        </div>
      </div>
      <!-- /Register -->
    </div>
  </div>
</div>