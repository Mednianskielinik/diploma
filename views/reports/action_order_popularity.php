<?php

use kartik\date\DatePicker;
use yii\widgets\ActiveForm;
use yii\widgets\Breadcrumbs;
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

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-xs-12">
            <?= Breadcrumbs::widget(['homeLink' => ['label' => 'Home', 'url' => '/'],
                'links' => [['label' => $this->title],
                ],
            ]) ?>
        </div>
    </div>
</div>
<div class="container">
<div class="row">
    <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 margin-bottom-10">
        <?= DatePicker::widget(['model' => $model,
            'attribute' => 'dateStartSearch',
            'attribute2' => 'dateEndSearch',
            'form' => $form,
            'type' => DatePicker::TYPE_RANGE,
            'removeButton' => ['icon' => 'trash',
            ],
            'options' => ['readonly' => false,
                'placeholder' => 'Start date',
                'data-pjax' => 0,
            ],
            'options2' => ['readonly' => false,
                'placeholder' => 'End date',
                'data-pjax' => 0,
            ],
            'pluginOptions' => ['todayHighlight' => true,
                'todayBtn' => true,
                'calendarWeeks' => true,
                'weekStart' => 1,
                'autoclose' => true,
                'format' => 'yyyy-mm-dd'
            ]
        ]); ?>
    </div>
    <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 margin-bottom-10">
    <?= Html::submitButton('Generate', ['class' => 'btn btn-danger btn_width_95 loading_button',
        'data-loading-text' => "<i class='fa fa-spinner fa-spin '></i> loading..."
    ]) ?>
    </div>
</div>
</div>
<?php ActiveForm::end(); ?>
<?php //if (!empty($model->reportOrderPopularity)): ?>
<!--    <div class="row">-->
<!--        <div class="col-lg-1 col-md-1 col-sm-12 col-xs-12">-->
<!--            --><?//= Html::a('XLS', ['/missed-days/sick-days/excel-sick-days-statistics'],
//                [
//                    'class' => 'btn btn-success btn_width_95',
//                    'data' => [
//                        'method' => 'post',
//                        'params' => [
//                            'SickDays[location]' => [$model->location],
//                            'SickDays[departments]' => [$model->departments],
//                            'SickDays[employees]' => [$model->employees],
//                            'SickDays[year]' => $model->year,
//                            'SickDays[groupByDepartment]' => $model->groupByDepartment,
//                        ],
//                    ],
//                ]); ?>
<!--        </div>-->
<!--    </div>-->
<?php //endif;?>

<table class="report-table">
    <tr>
        <th>Блюдо</th>
        <th>Количество заказов за период</th>
    </tr>
    <?php foreach ($model->reportOrderPopularity as $key => $count): ?>
    <tr>
        <td><?=$key?></td>
        <td><?=$count?></td>
    </tr>
    <?php endforeach;?>
</table>
