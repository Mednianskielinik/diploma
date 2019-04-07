<?php
/* @var $this yii\web\View */
/* @var $dataProvider \yii\data\ActiveDataProvider */
/* @var $model app\models\Menu */
/* @var $sum string */

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use app\assets\MenuAsset;
use app\models\Menu;
use yii\widgets\Pjax;

MenuAsset::register($this);

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
    <div class="row">
        <div class="inner-page padd">
            <div class="shopping">
                <div class="container">
                    <div class="shopping-content">
                        <div class="row">
                            <?php Pjax::begin(['timeout' => 7000,
                                'id' => 'menuGridPjax',
                            ]); ?>
                            <?php if (!empty(\Yii::$app->cart)):?>
                                <?php foreach (\Yii::$app->cart->getPositions() as $item):?>
                                    <div class="col-md-3 col-sm-6">
                                        <a class="shopping-item">
                                            <img class="img-responsive" src="../img/<?=$item->image?>" alt="" />
                                            <h4 class="pull-left"><?=$item->name?></h4>
                                            <span class="item-price pull-right"><?=$item->cost?></span>
                                            <a href="<?= \yii\helpers\Url::to(['menu/minus-from-cart', 'id' => $item->id])?>"><div class="clearfix">Минус</div></a>
                                            <a href="<?= \yii\helpers\Url::to(['menu/plus-from-cart', 'id' => $item->id])?>"><div class="clearfix">Плюс</div></a>
                                            <div class="item-hover br-red hidden-xs"><?= $item->getQuantity()?></div>
                                            <a href="<?= \yii\helpers\Url::to(['menu/delete-from-cart', 'id' => $item->id])?>" class="link hidden-xs add-to-cart" data-id="<?=$item->id?>" >Удалить</a>
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
    <hr>
    Итого: <?= $sum ?> <a href="<?= \yii\helpers\Url::to(['site/confirm-order'])?>" class="btn btn-success">Подтвердить заказ</a>
    </div>
</div>

