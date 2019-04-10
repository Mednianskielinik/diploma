<?php
/* @var $this yii\web\View */

/* @var $model \app\models\Menu */

use yii\bootstrap\ActiveForm;
use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\widgets\Pjax;
use app\models\Sales;
use kartik\color\ColorInput;

if ($model->isNewRecord) {
    $action = 'create';
    $class_btn = 'success';
    $button = 'Save';
} else {
    $action = 'update-menu';
    $class_btn = 'primary';
    $button = 'Update';
}

Modal::begin([
    'header' => 'Добавить блюдо',
    'id' => 'modalMenu',
    'size' => Modal::SIZE_LARGE,
    'options' => [
        'tabindex' => false
    ]
]);
?>

<?php Pjax::begin([
    'timeout' => 7000,
    'enableReplaceState' => false,
    'enablePushState' => false,
    'id' => 'formMenu'
]); ?>

<?php $form = ActiveForm::begin([
    'id' => 'formMenu',
    'action' => [
        'menu/'.$action,
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
                <?= $form->field($model, 'components')->textInput(); ?>
            </div>
            <div class="col-lg-12 col-md-12 col-xs-12">
                <?= $form->field($model, 'cost')->textInput(); ?>
            </div>
            <div class="col-lg-12 col-md-12 col-xs-12">
                <?= $form->field($model, 'weight')->textInput(); ?>
            </div>
            <div class="col-lg-12 col-md-12 col-xs-12">
                <?= $form->field($model, 'imageFile')->fileInput() ?>
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