<?php
/* @var $this yii\web\View */
/* @var $modelSettings app\models\BlackListSettings */
/* @var $dataProvider \yii\data\ActiveDataProvider */
/* @var $model app\models\BlackList */

use yii\grid\GridView;
use yii\grid\SerialColumn;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use app\assets\SalesAsset;
use app\models\BlackList;
use yii\helpers\Url;
use rmrevin\yii\fontawesome\FAS;
use yii\widgets\Pjax;

SalesAsset::register($this);

$this->title = 'Черный список';
?>

<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">Настройки</div>
        <div class="panel-body">
            <div class="container-fluid margin-top-20">
                <div class="row">
                    <?php $form = ActiveForm::begin([
                        'action' => [
                            'black-list/update-settings'
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
                                <?= $form->field($modelSettings, 'count_of_day')->textInput(['value'=> $modelSettings->countOfDay]); ?>
                            </div>
                            <div class="col-lg-12 col-md-12 col-xs-12">
                                <?= $form->field($modelSettings, 'fine')->textInput(['value'=> $modelSettings->newFine]); ?>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <?= Html::submitInput('Изменить', [
                            'class' => 'btn btn-warning',
                        ]) ?>
                    </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid margin-top-5">
        <div class="row">
            <div class="col-xs-12 col-md-12 col-lg-12">
                <?php Pjax::begin(['timeout' => 7000,
                    'id' => 'blackListGridPjax',
                ]); ?>
                <?= GridView::widget(['dataProvider' => $dataProvider,
                    'summary' => false,
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
                            'label' => 'Пользователь',
                            'headerOptions' => ['class' => 'text-center'],
                            'contentOptions' => ['class' => 'text-center'],
                            'value' => function ($model) {
                               return $model->user->user_name.' '.$model->user->user_second_name;
                            }
                        ],
                        [
                            'enableSorting' => false,
                            'headerOptions' => ['class' => 'text-center'],
                            'contentOptions' => ['class' => 'text-center'],
                            'attribute' => 'date_of_block',
                        ],
                        [
                            'label' => 'Осталось дней в черном списке',
                            'headerOptions' => ['class' => 'text-center'],
                            'contentOptions' => ['class' => 'text-center'],
                            'value' => function ($model) {
                                return BlackList::userCountDayInBlackList($model->user_id);
                            }
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
                                    return Html::a(FAS::icon('address-book', ['class' => 'fa-fw',]) . ' Убрать из черного списка', Url::to(['black-list/remove', 'id' => $model->id]),
                                        [
                                            'data-pjax' => 0,
                                        ]
                                    );
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
