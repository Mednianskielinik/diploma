<?php
/* @var $this yii\web\View */
/* @var $dataProvider \yii\data\ActiveDataProvider */
/* @var $model app\models\Sales */

use yii\grid\GridView;
use yii\grid\SerialColumn;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use app\assets\SalesAsset;
use app\models\Sales;
use kartik\select2\Select2;
use yii\grid\ActionColumn;
use rmrevin\yii\fontawesome\FA;
use yii\widgets\Pjax;

SalesAsset::register($this);

$this->title = 'Sales Periods';
if (isset($request)) {
print_r($request);
}
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
<div class="container-fluid">
    <div class="panel panel-default">
        <div class="panel-heading">Sales Periods</div>
        <div class="panel-body">
            <div class="container-fluid margin-top-20">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-xs-12">
                        <?= Html::a('Add',
                            [
                                'sales/create-sales',
                            ],
                            [
                                'id' => 'addSales',
                                'class' => 'btn btn-warning btn_width_95',
                            ]
                        ); ?>
                    </div>
                </div>
            </div>

            <div class="container-fluid margin-top-5">
                <div class="row">
                    <div class="col-xs-12 col-md-12 col-lg-12">
                        <?php Pjax::begin(['timeout' => 7000,
                            'id' => 'salesGridPjax',
                        ]); ?>
                        <?= GridView::widget(['dataProvider' => $dataProvider,
                            'tableOptions' => [
                                'class' => 'table table-striped table-bordered table-middle-vertical table-long-content grid-view-header'
                            ],
                            'columns' => [
                                [
                                    'headerOptions' => [
                                        'style' => ['width' => '50px'],
                                        'class' => 'text-center'
                                    ],
                                    'contentOptions' => [
                                        'style' => ['width' => '50px'],
                                        'class' => 'text-center'
                                    ],
                                    'class' => SerialColumn::class,
                                ],
                                [
                                    'enableSorting' => false,
                                    'attribute' => 'name',
                                ],
                                [
                                    'enableSorting' => false,
                                    'headerOptions' => ['class' => 'text-center'],
                                    'contentOptions' => ['class' => 'text-center'],
                                    'attribute' => 'count_of_purchase',
                                ],
                                [
                                    'enableSorting' => false,
                                    'headerOptions' => ['class' => 'text-center'],
                                    'contentOptions' => ['class' => 'text-center'],
                                    'attribute' => 'sale',
                                ],
                                [
                                    'enableSorting' => false,
                                    'headerOptions' => ['class' => 'text-center'],
                                    'attribute' => 'color',
                                    'content'   => function ($model) {
                                        return "<div class='cell-color' style='background-color: " . $model->color . ";'></div>";
                                    },
                                ],
                            ],
                        ]); ?>
                        <?php Pjax::end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->render('@app/views/sales/partial/modal', [
    'model' => new Sales(),
]); ?>
<?//= $this->render('@app/components/modalDelete/modalDelete'); ?>
