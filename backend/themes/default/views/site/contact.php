<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap4\ActiveForm $form */
/** @var app\models\ContactForm $model */

use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;
use yii\captcha\Captcha;

$this->title = 'Contact';
$this->params['breadcrumbs'][] = $this->title;
?>

<section class="w3l-breadcrumb">
    <div class="container">
        <ul class="breadcrumbs-custom-path">
            <li><a href="#url">Home</a></li>
            <li class="active"><span class="fa fa-arrow-right mx-2" aria-hidden="true"></span> Contact Us</li>
        </ul>
    </div>
</section>
<!-- contacts-5-grid -->
<div class="w3l-contact-10 py-5" id="contact">
    <div class="form-41-mian pt-lg-4 pt-md-3 pb-4">
        <div class="container">
            <div class="heading text-center mx-auto">
                <h5 class="title-small text-center mb-2">Contact our team</h5>
                <h3 class="title-big mb-2">Get in Touch with Us </h3>
                <p class="mb-5">If you have a question regarding our services, feel free
                    to contact us using the form below.</p>
            </div>
            <div class="row">
                <div class="col-lg-8 form-inner-cont">
                <?php $form = ActiveForm::begin([
                    'options' => [
                        'class' => 'signin-form'
                    ]
                ]); ?>
                        <div class="form-grids">
                            <div class="form-input">
                                <?php echo $form->field($model, 'name')->textInput(['maxlength' => true, 'placeholder' => "Enter Your Name"]) ?>
                            </div>
                            <div class="form-input">
                                <?php echo $form->field($model, 'email')->textInput(['maxlength' => true, 'placeholder' => "Enter Your Email"]) ?>
                            </div>
                        </div>
                        <div class="form-input">
                            <?php echo $form->field($model, 'subject')->textInput(['maxlength' => true, 'placeholder' => "Enter Your Subject"]) ?>
                        </div>
                        <div class="form-input">
                        <?= $form->field($model, 'body')->textarea(['rows' => '3','placeholder' => "Type your query here"])->label(false) ?>
                            <!-- <textarea name="w3lMessage" id="w3lMessage" placeholder="Type your query here"
                                required=""></textarea> -->
                        </div>
                        <div class="text-right">
                            <?= Html::submitButton(Yii::t('app', 'Submit'), ['class' => 'btn btn-style btn-primary']) ?> 
                        </div>
                    
                <?php ActiveForm::end(); ?>
                </div>

                <div class="col-lg-4 contacts-5-grid-main section-gap mt-lg-0 mt-4">
                    <div class="contacts-5-grid">
                        <div class="map-content-5">
                            <section class="tab-content">
                                <div class="contact-type">
                                    <div class="address-grid mb-3">
                                        <h6>Address</h6>
                                        <p><?php echo Yii::$app->params['address'];?></p><span
                                            class="pos-icon">
                                            <span class="fa fa-map"></span>
                                        </span>
                                    </div>
                                    <div class="address-grid mb-3">
                                        <h6>Email</h6>
                                        <a href="mailto:mailone@example.com" class="link1"><?php echo Yii::$app->params['adminEmail'];?></a>
                                        <span class="pos-icon">
                                            <span class="fa fa-envelope">

                                            </span>
                                        </span>
                                    </div>
                                    <div class="address-grid">
                                        <h6>Phone</h6>
                                        <a href="tel:+12 324-016-695" class="link1"><?php echo Yii::$app->params['phone'];?></a><span
                                            class="pos-icon">
                                            <span class="fa fa-headphones"></span>
                                        </span>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- //contacts-5-grid -->
    </div>
</div>

<!-- <div class="contacts-sub-5">
    <iframe
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d387193.305935303!2d-74.25986548248684!3d40.69714941932609!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c24fa5d33f083b%3A0xc80b8f06e177fe62!2sNew+York%2C+NY%2C+USA!5e0!3m2!1sen!2sin!4v1563262564932!5m2!1sen!2sin"
        style="border:0" allowfullscreen></iframe>
</div> -->

<!-- forms -->
<!-- <section class="container">
<div class="w3l-forms-9 px-4" id="newsletter">
    <div class="main-w3 py-4">
    <div class="container-fluid py-lg-3 py-2">
        <div class="row align-items-center">
        <div class="main-midd col-lg-6">
            <h4 class="title-head">Subscribe our newsletter</h4>
            <p>We’re a team of non-cynics who truly care for our work.</p>
        </div>
        <div class="main-midd-2 col-lg-6 mt-lg-0 mt-4">
            <form action="#url" method="GET" class="rightside-form">
            <input type="email" class="form-control" name="email" placeholder="Enter your email">
            <button class="btn" type="submit">Subscribe</button>
            </form>
        </div>
        </div>
    </div>
    </div>
</div>
</section> -->
<!-- //forms -->
 