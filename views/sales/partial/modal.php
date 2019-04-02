<?php
/* @var $this yii\web\View */

/* @var $model \app\models\Sales */

use yii\bootstrap\ActiveForm;
use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\widgets\Pjax;
use app\models\Sales;
use kartik\color\ColorInput;

if ($model->isNewRecord) {
    $action = 'create-sales';
    $class_btn = 'success';
    $button = 'Save';
} else {
    $action = 'update-sales';
    $class_btn = 'primary';
    $button = 'Update';
}

Modal::begin([
    'header' => 'Скидки',
    'id' => 'modalSales',
    'size' => Modal::SIZE_LARGE,
    'options' => [
        'tabindex' => false
    ]
]); ?>

<?php Pjax::begin([
    'timeout' => 7000,
    'enableReplaceState' => false,
    'enablePushState' => false,
    'id' => 'formSales'
]); ?>

<?php $form = ActiveForm::begin([
    'id' => 'form_sales',
    'action' => [
        'sales/'.$action,
        'id' => $model->id
    ],
    'method' => 'post',
    'enableClientValidation' => true,
    'options' => [
        'data-pjax' => 1
    ]
]);
?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-xs-12">
                <?= $form->field($model, 'name')->textInput(); ?>
            </div>
            <div class="col-lg-12 col-md-12 col-xs-12">
                <?= $form->field($model, 'count_of_purchase')->textInput(); ?>
            </div>
            <div class="col-lg-12 col-md-12 col-xs-12">
                <?= $form->field($model, 'sale')->textInput(); ?>
            </div>
            <div class="col-lg-12 col-md-12 col-xs-12">
                <?php $model->isNewRecord ? $model->color = '#000000' : $model->color;?>
                <?= $form->field($model, 'color')->widget(ColorInput::class, [
                    'options' => ['placeholder' => 'Выберите цвет ...'],
                ]); ?>
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
        </div>
    </div>
    <div class="modal-footer sick-days-modal-footer">
        <?= Html::submitInput($button, [
            'class' => 'btn btn-'.$class_btn,
        ]) ?>
        <a href="#" class="btn btn-default" data-dismiss="modal">Close</a>
    </div>

<?php ActiveForm::end(); ?>
<?php Pjax::end() ?>
<?php Modal::end();