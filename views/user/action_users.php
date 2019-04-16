<?php
/* @var $this yii\web\View */
/* @var $dataProvider \yii\data\ActiveDataProvider */
/* @var $searchModel app\models\User */

use yii\grid\GridView;
use yii\grid\SerialColumn;
use app\models\BlackList;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use app\assets\SalesAsset;
use app\models\Sales;
use yii\grid\ActionColumn;
use rmrevin\yii\fontawesome\FAS;
use yii\helpers\Url;
use yii\widgets\Pjax;

SalesAsset::register($this);

$this->title = 'Черный список';
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
    <div class="container-fluid margin-top-5">
        <div class="row">
            <div class="col-xs-12 col-md-12 col-lg-12">
                <?php Pjax::begin(['timeout' => 7000,
                    'id' => 'blackListGridPjax',
                ]); ?>
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'tableOptions' => [
                        'class' => 'table table-striped table-bordered table-middle-vertical table-long-content grid-view-header'
                    ],
                    'columns' => [
                        ['headerOptions' => [
                            'style' => ['width' => '50px'],
                            'class' => 'text-center'
                        ],
                            'contentOptions' => ['style' => ['width' => '50px'],
                                'class' => 'text-center'
                            ],
                            'class' => SerialColumn::class,
                        ],
                        [
                            'attribute' => 'login',
                        ],
                        [
                            'label' => 'Имя',
                            'headerOptions' => ['class' => 'text-center'],
                            'contentOptions' => ['class' => 'text-center'],
                            'value' => function ($model) {
                                return $model->user_name.' '.$model->user_second_name;
                            }
                        ],
                        [
                            'headerOptions' => ['class' => 'text-center'],
                            'contentOptions' => ['class' => 'text-center'],
                            'attribute' => 'address',
                        ],
                        [
                            'headerOptions' => ['class' => 'text-center'],
                            'contentOptions' => ['class' => 'text-center'],
                            'attribute' => 'phone_number',
                        ],
                        [
                            'class'          => \yii\grid\ActionColumn::class,
                            'template'       => '{delete}',
                            'headerOptions'  => [
                                'class' => 'text-center'
                            ],
                            'contentOptions' => [
                                'class' => 'text-center'
                            ],
                            'header'         => 'Действия',
                            'buttons'        => [
                                'delete' => function ($url, $model) {
                                   if(BlackList::isUserInBlackList($model->id)) {
                                       return Html::a(FAS::icon('address-book', ['class' => 'fa-fw',]) . ' Обновить срок нахождения в чером списке', Url::to(['black-list/add', 'id' => $model->id]),
                                           [
                                               'data-pjax' => 0,
                                           ]
                                       );
                                   } else {
                                       return Html::a(FAS::icon('address-book', ['class' => 'fa-fw',]) . ' Добавить в черный список', Url::to(['black-list/add', 'id' => $model->id]),
                                           [
                                               'data-pjax' => 0,
                                           ]
                                       );
                                   }
                                }
                            ]
                        ]

                    ],
                ]); ?>
                <?php Pjax::end(); ?>
            </div>
        </div>
    </div>
</div>
