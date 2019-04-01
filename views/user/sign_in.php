<?php
/* @model LoginForm */
/* @modelUser User */
use yii\widgets\ActiveForm;
use yii\helpers\Html;
?>
<div class="container">
<div class="login-wrap">
    <div class="login-html">
        <input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Авторизация</label>
        <input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab">Регистрация</label>
        <div class="login-form">
            <div class="sign-in-htm">
                <?php $form = ActiveForm::begin([
                    'action' => ['/user/login'],
                    'method' => 'post'
                ]); ?>

                <div class="group">
                    <?= $form->field($model, 'login', [
                        'labelOptions' => [ 'class' => 'label' ]])->textInput(['class' => 'input'])->label('Логин')?>
                </div>
                <div class="group">
                    <?= $form->field($model, 'password', [
                        'labelOptions' => [ 'class' => 'label' ]])->textInput(['class' => 'input'])->label('Пароль')?>
                </div>
                <div class="group">
                    <?= $form->field($model, 'rememberMe')->checkbox([
                            'label' => 'Запомнить меня',
                            'labelOptions' => [
                                'class' => 'check'
                            ],
                        ]);?>
                </div>
                <div class="group">
                    <?= Html::submitButton('Войти', [
                        'class' => 'button',
                    ]) ?>
                </div>

                <div class="group">
                    <input id="check" type="checkbox" class="check" checked>
                    <label for="check"><span class="icon"></span> Keep me Signed in</label>
                </div>
                <?php ActiveForm::end(); ?>
                <div class="hr"></div>
                <div class="foot-lnk">
                    <a href="#forgot">Forgot Password?</a>
                </div>
            </div>
            <div class="sign-up-htm">
                <?php $form = ActiveForm::begin([
                    'action' => ['/user/sign-in'],
                    'method' => 'post'
                ]); ?>

                <div class="group">
                    <?= $form->field($modelUser, 'login', [
                    'labelOptions' => [ 'class' => 'label' ]])->textInput(['class' => 'input'])->label('Логин')?>
                </div>
                <div class="group">
                    <?= $form->field($modelUser, 'user_name', [
                        'labelOptions' => [ 'class' => 'label' ]])->textInput(['class' => 'input'])->label('Имя')?>
                </div>
                <div class="group">
                    <?= $form->field($modelUser, 'user_second_name', [
                        'labelOptions' => [ 'class' => 'label' ]])->textInput(['class' => 'input'])->label('Фамилия')?>
                </div>
                <div class="group">
                    <?= $form->field($modelUser, 'address', [
                        'labelOptions' => [ 'class' => 'label' ]])->textInput(['class' => 'input'])->label('Адрес')?>
                </div>
                <div class="group">
                    <?= $form->field($modelUser, 'email', [
                        'labelOptions' => [ 'class' => 'label' ]])->textInput(['class' => 'input'])->label('e-mail')?>
                </div>
                <div class="group">
                    <?= $form->field($modelUser, 'phone_number', [
                        'labelOptions' => [ 'class' => 'label' ]])->textInput(['class' => 'input'])->label('Телефон')?>
                </div>
                <div class="group">
                    <?= $form->field($modelUser, 'password', [
                        'labelOptions' => [ 'class' => 'label' ]])->textInput(['class' => 'input'])->label('Пароль')?>
                </div>
                <div class="group">
                    <?= Html::submitButton('Регистрация', [
                        'class' => 'button',
                    ]) ?>
                </div>

                <?php ActiveForm::end(); ?>

                <div class="hr"></div>
            </div>
        </div>
    </div>
</div>
</div>
