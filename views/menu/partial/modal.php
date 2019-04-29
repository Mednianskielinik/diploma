<?php
/* @var $this yii\web\View */

/* @var $model \app\models\Menu */

use macgyer\yii2materializecss\widgets\form\ActiveForm;
use macgyer\yii2materializecss\widgets\Modal;
use yii\helpers\Html;
use yii\widgets\Pjax;
use macgyer\yii2materializecss\widgets\form\Select;
use app\models\Sales;
use kartik\color\ColorInput;
use rmrevin\yii\fontawesome\FAS;

$icon = FAS::icon('edit', ['class' => 'fa-fw', ]);
if ($model->isNewRecord) {
    $action = 'create';
    $class_btn = 'success';
    $button = 'Save';
    $label = '+';
} else {
    $action = 'update-menu';
    $class_btn = 'primary';
    $button = 'Update';
    $label = Html::a( $icon,
        [
            'menu/update-menu',
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
    'id' => 'modalMenu',
    'closeButtonPosition' => \macgyer\yii2materializecss\widgets\Modal::CLOSE_BUTTON_POSITION_AFTER_CONTENT,
    'closeButton' => false,
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

    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-xs-12">
                <?= $form->field($model, 'name')->textInput(['placeholder' => 'Название'])->label(false); ?>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <?= $form->field($model, 'category')->widget(Select::class, [
                    'items' => $model->categories,
                    'options' => [
                        'multiple' => false,
                        'placeholder' => 'Категория',
                    ],
                ])->label(false) ?>
            </div>
            <div class="col-lg-12 col-md-12 col-xs-12">
                <?= $form->field($model, 'components')->textInput(['placeholder' => 'Состав'])->label(false); ?>
            </div>
            <div class="col-lg-12 col-md-12 col-xs-12">
                <?= $form->field($model, 'cost')->textInput(['placeholder' => 'Стоимость'])->label(false); ?>
            </div>
            <div class="col-lg-12 col-md-12 col-xs-12">
                <?= $form->field($model, 'weight')->textInput(['placeholder' => 'Вес'])->label(false); ?>
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
        </div>
    </div>
        <?= Html::submitInput('Сохранить', [
            'class' => 'btn btn-'.$class_btn,
        ]) ?>
    <div class="light-grey btn btn-flat blue lighten-4 modal-close">Закрыть</div>

<?php ActiveForm::end(); ?>
<?php Pjax::end() ?>
<?php Modal::end();