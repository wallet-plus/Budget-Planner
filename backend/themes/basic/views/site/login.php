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


<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <div class="brand-logo">
                <img src="<?php echo Yii::$app->view->theme->baseUrl; ?>/basic/images/logo.svg" alt="logo">
              </div>
              <h4>Hello! let's get started</h4>
              <h6 class="font-weight-light">Sign in to continue.</h6>
                <?php
                    $form = ActiveForm::begin([
                                'id' => 'login-form',
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

                <div class="form-group">
                  <!-- <input type="email" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Username"> -->
                  <?php echo Html::activeTextInput($model, 'username', ['autoComplete' =>'nope', 'class'=>'form-control form-control-lg', 'placeholder'=>$model->getAttributeLabel('username')]); ?>
                  <?php echo Html::error($model, 'username'); ?>
                </div>
                <div class="form-group">
                  <!-- <input type="password" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Password"> -->
                  <?php echo Html::activePasswordInput($model, 'password', ['autoComplete' =>'nope', 'class'=>'form-control form-control-lg', 'placeholder'=>$model->getAttributeLabel('password')]); ?>
                  <?php echo Html::error($model, 'password'); ?>
                </div>
                <div class="mt-3">
                  <?= Html::submitButton('SIGN IN', ['name' => 'login-button', 'id' => 'create-btn', 'class' => "btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn"]) ?>
                </div>
                <div class="my-2 d-flex justify-content-between align-items-center">
                  <div class="form-check">
                    <label class="form-check-label text-muted">
                      <input type="checkbox" class="form-check-input">
                      <!-- <?= $form->field($model, 'rememberMe')->checkbox() ?> -->
                      Keep me signed in
                    </label>
                  </div>
                  <?= Html::a("Forgot Password", ['/site/forgot-password'], ['class' => 'auth-link text-black']) ?>
                </div>
                <!-- <div class="mb-2">
                  <button type="button" class="btn btn-block btn-facebook auth-form-btn">
                    <i class="ti-facebook mr-2"></i>Connect using facebook
                  </button>
                </div> -->
                <div class="text-center mt-4 font-weight-light">
                  Don't have an account? 
                  <?= Html::a("Create ", ['/site/register'], ['class' => 'text-primary']) ?>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>

