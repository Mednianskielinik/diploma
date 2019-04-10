<?php
/* @var $this yii\web\View */
/* @var $dataProvider \yii\data\ActiveDataProvider */
/* @var $model app\models\Menu */

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use app\assets\MenuAsset;
use app\models\Menu;
use yii\widgets\Pjax;
use rmrevin\yii\fontawesome\FAS;

MenuAsset::register($this);

$this->title = 'Sales Periods';
$icon = FAS::icon('edit', ['class' => 'fa-fw', ]);
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
    <div class="row">
        <div class="col-lg-12 col-md-12 col-xs-12 center-block">
            <?= Html::a('Добавить',
                [
                    'menu/create',
                ],
                [
                    'id' => 'addMenu',
                    'class' => 'btn btn-warning btn_width_95',
                ]
            ); ?>
        </div>
    </div>
    <div class="row">
        <div class="inner-page padd">
            <div class="shopping">
                <div class="container">
                    <div class="shopping-content">
                        <div class="row">
                            <?php Pjax::begin(['timeout' => 7000,
                                'id' => 'menuGridPjax',
                            ]); ?>
                                <?php if (!empty($dataProvider)):?>
                                    <?php foreach ($dataProvider->getModels() as $item):?>
                                        <div class="col-md-3 col-sm-6">
                                            <div class="shopping-item">
                                                <?php if(Yii::$app->user->id == 1) :?>
                                                    <div class="update add-to-cart"><a href="<?= \yii\helpers\Url::to(['menu/delete-menu', 'id' => $item->id])?>">
                                                            <i class="fas fa-trash"></i> Удалить</a>
                                                        <?= Html::a( $icon.'Изменить',
                                                            [
                                                                'menu/update-menu',
                                                                'id' => $item->id,
                                                            ],
                                                            [
                                                                'data-pjax' => 0,
                                                                'class' => 'update',
                                                            ]
                                                        ); ?> </div>
                                                <?php else:?>
                                                    <div class="add-to-cart"><a href="<?= \yii\helpers\Url::to(['menu/add-to-cart', 'id' => $item->id])?>"><i class="fas fa-shopping-basket"></i> Добавить в корзину</a></div>
                                                <?php endif;?>
                                            <img class="img-responsive" src="../img/<?=$item->image?>" alt="" />
                                            <div class="product"><h4><?=$item->name?></h4></div>
                                            <div class="item-price"><?=$item->cost?> BYN</div>
                                            <div class="item-weight"><?=$item->weight?> грамм</div>
                                            <div class="components"><?=$item->components?></div>
                                           </div>
                                        </div>
                                    <?php endforeach;?>
                                <?php endif; ?>
                            <?php Pjax::end(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->render('@app/views/menu/partial/modal', [
    'model' => new Menu(),
]); ?>
