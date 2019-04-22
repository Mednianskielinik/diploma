<?php

use kartik\select2\Select2;
use yii\widgets\ActiveForm;
use yii\widgets\Breadcrumbs;
use yii\helpers\Html;
use app\assets\ReportsAsset;
use miloschuman\highcharts\Highcharts;

/* @var $model app\models\Order */
$this->title = 'Статистика заказов';

$form = ActiveForm::begin([
    'action' => [
        '/reports/order-in-month',
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
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 margin-bottom-10">
                <?php echo $form->field($model, 'year')->widget(Select2::class, [
                    'data' => $model->getYears(),
                    'size' => Select2::MEDIUM,
                    'hideSearch' => true,
                    'showToggleAll' => false,
                    'options' => [
                        'multiple' => false,
                        'value' => $model->year,
                        'placeholder' => 'Year',
                    ],
                    'pluginOptions' => [
                        'allowClear' => false,
                    ]
                ])->label('Год') ?>
            </div>
        </div>
        <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 margin-bottom-10">
            <?= Html::submitButton('Generate', ['class' => 'btn btn-danger btn_width_95 loading_button',
                'data-loading-text' => "<i class='fa fa-spinner fa-spin '></i> loading..."
            ]) ?>
        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>
<?php if(!empty($model->orderInMonth)): ?>
    <?php
    echo Highcharts::widget([
        'options' => [
            'title' => ['text' => 'Колличество заказов за '.$model->year.' год'],
            'xAxis' => [
                'categories' => $model::MONTH,
            ],
            'yAxis' => [
                'title' => ['text' => 'Количество заказов']
            ],
            'series' => [
                ['name' => 'Заказы', 'data' => $model->orderInMonth],
            ]
        ]
    ]);

    ?>
<?php else:?>
    <div class="alert alert-warning text-center" role="alert"><strong>During this period, no data!</strong></div>
<?php endif;?>

