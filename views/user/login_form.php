<?php
/* @model LoginForm */

/* @modelUser User */

use yii\widgets\ActiveForm;
use app\assets\UserAssets;
use yii\helpers\Html;
use yii\helpers\Url;

UserAssets::register($this)

?>
<div class="container">
    <div class="login-html">
        <div class="login-form-html">
            <?php $form = ActiveForm::begin([
                'action' => ['/user/login'],
                'method' => 'post'
            ]); ?>

            <div class="group">
                <?= $form->field($model, 'login', [
                    'labelOptions' => ['class' => 'label']])->textInput(['class' => 'input'])->label('Логин') ?>
            </div>
            <div class="group">
                <?= $form->field($model, 'password', [
                    'labelOptions' => ['class' => 'label']])->textInput(['class' => 'input'])->label('Пароль') ?>
            </div>
            <div class="group">
                <?= Html::submitButton('Войти', [
                    'class' => 'btn button',
                ]) ?>
            </div>
            <?php ActiveForm::end(); ?>
            <br>
            <div class="foot-lnk">
                <a href="<?=Url::to(['user/sign-in'])?>">Нет аккаунта?</a>
            </div>
        </div>
    </div>
</div>

