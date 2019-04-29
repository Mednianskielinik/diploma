<?php
/* @var $this yii\web\View */
/* @var $dataProvider \yii\data\ActiveDataProvider */
/* @var $model app\models\Sales */

use macgyer\yii2materializecss\widgets\grid\GridView;
use macgyer\yii2materializecss\widgets\grid\ActionColumn;
use yii\grid\SerialColumn;
use yii\helpers\Html;
use app\assets\SalesAsset;
use app\models\Sales;
use rmrevin\yii\fontawesome\FAS;
use yii\widgets\Pjax;

SalesAsset::register($this);

$this->title = 'Скидочные этапы';
?>

<div class="container">
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="container-fluid margin-top-20">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-xs-12">
                        <?= $this->render('@app/views/sales/partial/modal', [
                            'model' => new Sales(),
                        ]); ?>
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
                            'summary' => false,
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
                                    'contentOptions' => ['class' => 'text-center'],
                                    'attribute' => 'color',
                                    'content'   => function ($model) {
                                        return "<div class='cell-color' style='background-color: " . $model->color . ";'></div>";
                                    },
                                ],
                                [
                                    'class'          => ActionColumn::class,
                                    'template'       => '{delete}',
                                    'headerOptions'  => ['class' => 'text-center'],
                                    'contentOptions' => ['class' => 'text-center'],
                                    'header'         => 'Действия',
                                    'buttons'        => [
                                        'delete' => function ($url, $model) {
                                            $icon = FAS::icon('trash', ['class' => 'fa-fw']);

                                            return Html::a($icon . ' Удалить',
                                                ['sales/delete-sales', 'id' => $model->id],
                                                [
                                                    'data-pjax' => 0,
                                                    'data-confirm' => Sales::getDeleteMessage($model->name)
                                                ]
                                            );
                                        },
                                    ]
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
<?= $this->render('@app/components/modalDelete/modalDelete'); ?>
