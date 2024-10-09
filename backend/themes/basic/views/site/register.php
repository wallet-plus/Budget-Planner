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


<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <div class="brand-logo">
                <img src="../../images/logo.svg" alt="logo">
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
                  <?php echo Html::activeTextInput($model, 'firstname', ['autoComplete' =>'nope', 'class'=>'form-control form-control-lg', 'placeholder'=>$model->getAttributeLabel('firstname')]); ?>
                  <?php echo Html::error($model, 'firstname'); ?>
                </div>


                <div class="form-group">
                  <?php echo Html::activeTextInput($model, 'username', ['autoComplete' =>'nope', 'class'=>'form-control form-control-lg', 'placeholder'=>$model->getAttributeLabel('username')]); ?>
                  <?php echo Html::error($model, 'username'); ?>
                </div>


                <div class="form-group">
                  <?php echo Html::activeTextInput($model, 'email', ['autoComplete' =>'nope', 'class'=>'form-control form-control-lg', 'placeholder'=>$model->getAttributeLabel('email')]); ?>
                  <?php echo Html::error($model, 'email'); ?>
                </div>


                <div class="form-group">
                  <?php echo Html::activePasswordInput($model, 'password', ['autoComplete' =>'nope', 'class'=>'form-control form-control-lg', 'placeholder'=>$model->getAttributeLabel('password')]); ?>
                  <?php echo Html::error($model, 'password'); ?>
                </div>


                
                <div class="mt-3">
                  <?= Html::submitButton('SIGN IN', ['name' => 'login-button', 'id' => 'create-btn', 'class' => "btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn"]) ?>
                </div>
                

                <div class="mb-4">
                  <div class="form-check">
                    <label class="form-check-label text-muted">
                      <input type="checkbox" class="form-check-input">
                      I agree to all Terms & Conditions
                    </label>
                  </div>
                </div>

                <div class="text-center mt-4 font-weight-light">
                  Already have an account? <?= Html::a("Login ", ['/site/login'], ['class' => 'text-primary']) ?>
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

