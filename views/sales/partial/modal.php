<?php
/* @var $this yii\web\View */

/* @var $model \app\models\Sales */

use macgyer\yii2materializecss\widgets\form\ActiveForm;
use macgyer\yii2materializecss\widgets\Modal;
use yii\helpers\Html;
use yii\widgets\Pjax;
use app\models\Sales;
use rmrevin\yii\fontawesome\FAS;
use kartik\color\ColorInput;

$icon = FAS::icon('edit', ['class' => 'fa-fw',]);
if ($model->isNewRecord) {
    $action = 'create-sales';
    $class_btn = 'success';
    $button = 'Save';
    $label = '+';
} else {
    $action = 'update-sales';
    $class_btn = 'primary';
    $button = 'Update';
    $label = Html::a($icon . ' Edit',
        [
            'sales/update-sales',
            'id' => $model->id,
        ],
        [
            'data-pjax' => 0,
            'class' => 'update',
        ]
    );
}

Modal::begin([
    'toggleButton' => [
        'label' => $label,
        'class' => 'modal-trigger btn button_add_menu'
    ],
    'closeButtonPosition' => \macgyer\yii2materializecss\widgets\Modal::CLOSE_BUTTON_POSITION_AFTER_CONTENT,
    'closeButton' => false,
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
        'sales/' . $action,
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
                <?php $model->isNewRecord ? $model->color = '#000000' : $model->color; ?>
                <?= $form->field($model, 'color')->widget(ColorInput::class, [
                    'options' => ['placeholder' => 'Выберите цвет ...'],
                ])->label(false); ?>
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
        <?= Html::submitInput('Сохранить' , [
            'class' => 'btn btn-' . $class_btn,
        ]) ?>
        <div class="light-grey btn btn-flat blue lighten-4 modal-close">Закрыть</div>
    </div>

<?php ActiveForm::end(); ?>
<?php Pjax::end() ?>
<?php Modal::end(); ?>