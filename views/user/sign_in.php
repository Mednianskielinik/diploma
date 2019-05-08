<?php
/* @model User */

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use app\assets\UserAssets;

UserAssets::register($this)
?>
<div class="container">
    <div class="login-html">
        <div class="login-form-html">
            <?php $form = ActiveForm::begin([
                'action' => ['/user/sign-in'],
                'method' => 'post'
            ]); ?>

            <div class="group">
                <?= $form->field($model, 'login', [
                    'labelOptions' => ['class' => 'label']])->textInput(['class' => 'input'])->label('Логин') ?>
            </div>
            <div class="group">
                <?= $form->field($model, 'user_name', [
                    'labelOptions' => ['class' => 'label']])->textInput(['class' => 'input'])->label('Имя') ?>
            </div>
            <div class="group">
                <?= $form->field($model, 'user_second_name', [
                    'labelOptions' => ['class' => 'label']])->textInput(['class' => 'input'])->label('Фамилия') ?>
            </div>
            <div class="group">
                <?= $form->field($model, 'address', [
                    'labelOptions' => ['class' => 'label']])->textInput(['class' => 'input'])->label('Адрес') ?>
            </div>
            <div class="group">
                <?= $form->field($model, 'email', [
                    'labelOptions' => ['class' => 'label']])->textInput(['class' => 'input'])->label('e-mail') ?>
            </div>
            <div class="group">
                <?= $form->field($model, 'phone_number', [
                    'labelOptions' => ['class' => 'label']])->textInput(['class' => 'input'])->label('Телефон') ?>
            </div>
            <div class="group">
                <?= $form->field($model, 'password', [
                    'labelOptions' => ['class' => 'label']])->textInput(['class' => 'input'])->label('Пароль') ?>
            </div>
            <div class="group">
                <?= Html::submitButton('Регистрация', [
                    'class' => 'btn button',
                ]) ?>
            </div>

            <?php ActiveForm::end(); ?>

            <div class="hr"></div>
        </div>
    </div>
</div>

