<?php
/* @model User*/
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\captcha\Captcha;
?>

<?php $form = ActiveForm::begin([
    'action' => ['/user/sign-in'],
    'method' => 'post'
]); ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-xs-12">
                <?= $form->field($model, 'login') ?>
            </div>
            <div class="col-lg-12 col-md-12 col-xs-12">
                <?= $form->field($model, 'user_name') ?>
            </div>
            <div class="col-lg-12 col-md-12 col-xs-12">
                <?= $form->field($model, 'user_second_name') ?>
            </div>
            <div class="col-lg-12 col-md-12 col-xs-12">
                <?= $form->field($model, 'address') ?>
            </div>
            <div class="col-lg-12 col-md-12 col-xs-12">
                <?= $form->field($model, 'email') ?>
            </div>
            <div class="col-lg-12 col-md-12 col-xs-12">
                <?= $form->field($model, 'phone_number') ?>
            </div>
            <div class="col-lg-12 col-md-12 col-xs-12">
                <?= $form->field($model, 'password') ?>
            </div>
            <div class="col-lg-12 col-md-12 col-xs-12">
                <?= $form->field($model, 'verifyCode')->widget(Captcha::class) ?>
            </div>
            <div class="col-lg-12 col-md-12 col-xs-12 ">
                <div class="width_200">
                    <?= Html::submitButton('Регистрация', [
                        'class' => 'btn btn-success',
                    ]) ?>
                </div>
            </div>
        </div>
    </div>

<?php ActiveForm::end(); ?>