<?php
/* @var $this yii\web\View */

/* @var $model \app\models\Menu */

use macgyer\yii2materializecss\widgets\form\ActiveForm;
use yii\helpers\Html;
use macgyer\yii2materializecss\widgets\form\Select;


$action = 'update-menu';
$class_btn = 'primary';
$button = 'Update';

$form = ActiveForm::begin([
    'id' => 'formMenu',
    'action' => [
        'menu/update-menu',
        'id' => $model->id
    ],
    'method' => 'post',
    'enableClientValidation' => true,
    'options' => [
        'data-pjax' => 1
    ]
]);
?>

    <div class="container">
        <div class="col-lg-12 col-md-12 col-xs-12">
            <?= $form->field($model, 'name')->textInput(); ?>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <?= $form->field($model, 'category')->widget(Select::class, [
                'items' => $model->categories,
                'options' => [
                    'multiple' => false,
                ],
            ])->label(false) ?>
        </div>
        <div class="col-lg-12 col-md-12 col-xs-12">
            <?= $form->field($model, 'components')->textInput(); ?>
        </div>
        <div class="col-lg-12 col-md-12 col-xs-12">
            <?= $form->field($model, 'cost')->textInput(); ?>
        </div>
        <div class="col-lg-12 col-md-12 col-xs-12">
            <?= $form->field($model, 'weight')->textInput(); ?>
        </div>
        <div class="col-lg-12 col-md-12 col-xs-12">
            <?= $form->field($model, 'imageFile')->fileInput()->label(false) ?>
        </div>
        <div class="col-lg-12 col-md-12 col-xs-12 form-group notifications">
            <?php if ($model->hasErrors()): ?>
                <?php $this->registerJs("window.pjaxEndHideSickModalAfterSave = false"); ?>
                <p>Notifications:</p>
                <?php $errorsHtml = $model->renderNotificationErrors(); ?>
                <?= $errorsHtml ? $errorsHtml : $form->errorSummary($model); ?>
            <?php else: ?>
                <?php $this->registerJs("window.pjaxEndHideSickModalAfterSave = true"); ?>
            <?php endif; ?>
        </div>
<?= Html::submitInput('Изменить', [
    'class' => 'btn btn-' . $class_btn,
]) ?>
    </div>
<?php ActiveForm::end(); ?>