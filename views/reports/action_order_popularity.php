<?php

use macgyer\yii2materializecss\widgets\form\DatePicker;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use app\assets\ReportsAsset;

/* @var $model app\models\Order */
$this->title = 'Популярность товаров';

$form = ActiveForm::begin([
    'action' => [
        '/reports/order-popularity',
    ],
    'method' => 'post',
    'enableClientValidation' => true,
    'options' => [
        'data-pjax' => 1
    ]
]);

ReportsAsset::register($this);
?>

<div class="report-container">
    <div class="row">
        <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 margin-bottom-10">
            <?= DatePicker::widget(['model' => $model,
                'attribute' => 'dateStartSearch',
                'options' => ['readonly' => false,
                    'placeholder' => 'Начало периода',
                    'data-pjax' => 0,
                ],
                'clientOptions' => [
                    'format' => 'yyyy-mm-dd'
                ]
            ]); ?>
        </div>
        <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 margin-bottom-10">
            <?= DatePicker::widget(['model' => $model,
                'attribute' => 'dateEndSearch',
                'options' => ['readonly' => false,
                    'placeholder' => 'Конец периода',
                    'data-pjax' => 0,
                ],
                'clientOptions' => [
                    'format' => 'yyyy-mm-dd'
                ]
            ]); ?>
        </div>
        <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 margin-bottom-10">
            <?= Html::submitButton('Построить отчет', ['class' => 'btn btn-danger btn_width_95 loading_button',
                'data-loading-text' => "<i class='fa fa-spinner fa-spin '></i> loading..."
            ]) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
    <?php if (!empty($model->reportOrderPopularity)): ?>
        <table class="report-table">
            <tr>
                <th>Блюдо</th>
                <th>Количество заказов за период</th>
            </tr>
            <?php foreach ($model->reportOrderPopularity as $key => $count): ?>
                <tr>
                    <td><?= $key ?></td>
                    <td><?= $count ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <div class="alert alert-warning text-center" role="alert"><strong>During this period, no data!</strong></div>
    <?php endif; ?>
</div>
